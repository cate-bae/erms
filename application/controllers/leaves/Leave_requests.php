<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave_requests extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('leaves/Leave_requests_model', 'Leave_requests_model');
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
			base_url('assets/js/leaves/requests.js')
		];

		$page_data['list'] = $this->Leave_requests_model->all();

		$data['body'] = $this->load->view('leaves/requests', $page_data, true);
		$this->load->view('index', $data);
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
		
		$data = parse_data($_POST, ['status', 'remarks']);

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

