<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave_requests extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('leaves/Leave_requests_model', 'Leave_requests_model');
		$this->load->model('Employees_model');
	}

	public function index()
	{
		if ( ! in_array(get_user_type(), [-1, 0])) // super, admin
		{
			show_404();
		}

		$data['page_title'] = 'Leave Requests';
		$data['nav_active'] = 'leaves';
		$data['sub_nav_active'] = 'leave_requests';
		$data['page_js'] = [
			base_url('assets/plugins/jquery-datatable/jquery.dataTables.js'),
			base_url('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'),
			base_url('assets/js/pages/tables.js'),
			base_url('assets/js/leaves/requests.js'),
			base_url('assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js')
		];

		$page_data['list'] = $this->Leave_requests_model->all();

		$page_data['employees'] = set_key_obj($this->Employees_model->all_names(), 'id');

		$data['body'] = $this->load->view('leaves/requests', $page_data, true);
		$this->load->view('index', $data);
	}

	public function info($id)
	{
		$data = $this->Leave_requests_model->get(['id' => $id]);

		if (empty($data))
		{
			json_response(FALSE, 'Leave request does not exist.');
		}

		$employees = [];
		if ($data->recommendation != '')
		{
			$employees = set_key_obj($this->Employees_model->get_leave_employees([$data->user_id, $data->dept_head_id, $data->authorized_officer_id]), 'id');
		}
		else 
		{
			$employees = set_key_obj($this->Employees_model->get_leave_employees([$data->user_id]), 'id');
		}
		json_response(TRUE, '', ['leave' => $data, 'employees' => $employees]);
	}

	public function add()
	{		
		if ( ! in_array(get_user_type(), [-1, 0])) 
		{
			json_response(FALSE, 'User cannot not create leaves.');
		}

		if (has_empty_post(['name'])) 
		{	
			json_response(FALSE, 'Fill in the required fields');
		}

		$data = parse_data($_POST, ['name', 'description']);

		if($this->Leave_requests_model->is_name_exists($data['name']))
		{
			json_response(FALSE, 'Leave type name already exists.');
		}

		try 
		{
			$this->db->trans_start();
			
			$this->Leave_requests_model->create($data);

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, 'Created successfully');
	}
	
    public function update()
    {
		$id = $this->input->post('id');

		if ( ! in_array(get_user_type(), [-1, 0])) 
		{
			json_response(FALSE, 'User cannot not update leave type');
		}

		if (has_empty_post(['name'])) 
		{	
			json_response(FALSE, 'Fill in the required fields');
		}
		
		$data = parse_data($_POST, ['name', 'description']);

		if($this->Leave_requests_model->is_name_exists($data['name'], $id))
		{
			json_response(FALSE, 'Leave type name already exists.');
		}

		$this->Leave_requests_model->update($data, $id);
		
		json_response(TRUE, 'Updated successfully');
	}
	
    public function action()
    {
		$id = $this->input->post('id');

		if ( ! in_array(get_user_type(), [-1, 0])) 
		{
			json_response(FALSE, 'User cannot not update leave type');
		}
		
		$leave = $this->Leave_requests_model->get(['id' => $id]);
		if (empty($leave))
		{
			json_response(FALSE, 'Leave request does not exist');
		}

		if ($leave->recommendation != '')
		{
			json_response(FALSE, 'There is already '.$leave->recommendation.' action. ');
		}

		$fields = [
			'recommendation',
			'dept_head_id',
			'authorized_officer_id'
		];

		if ($this->input->post('recommendation') == 'Approval')
		{
			$fields[] = 'days_with_pay';
			$fields[] = 'days_without_pay';
		}
		else
		{
			$fields[] = 'disapproval_reason';
			$fields[] = 'disapproved_reason';
		}

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);

		foreach ($data as $key => $field)
		{
			if ($field === '') 
			{
				json_response(FALSE, 'Fill in the required fields', ['fields' => [$key]]);
			}
		}

		$data['operator'] = $this->session->userdata('logged_in')['id'];

		$this->Leave_requests_model->update($data, $id);
		
		json_response(TRUE, 'Saved successfully');
	}

	public function delete($id)
	{
		if ( ! in_array(get_user_type(), [-1, 0])) 
		{	
			json_response(FALSE, 'User cannot not delete leave type');
		}
		
        $this->Leave_requests_model->delete($id);
		json_response(TRUE, 'Deleted successfully');
	}

}

