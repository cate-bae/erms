<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave_types extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('leaves/Leave_types_model', 'Leave_types_model');
	}

	public function index()
	{
		if ( ! in_array(get_user_type(), [-1, 0])) // super, admin
		{
			show_404();
		}

		$data['page_title'] = 'Leave Types';
		$data['nav_active'] = 'leaves';
		$data['sub_nav_active'] = 'leave_types';
		$data['page_js'] = [
			base_url('assets/plugins/jquery-datatable/jquery.dataTables.js'),
			base_url('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'),
			base_url('assets/js/pages/tables.js'),
			base_url('assets/js/leaves/types.js')
		];

		$page_data['list'] = $this->Leave_types_model->all();

		$data['body'] = $this->load->view('leaves/types', $page_data, true);
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

		if($this->Leave_types_model->is_name_exists($data['name']))
		{
			json_response(FALSE, 'Leave type name already exists.');
		}

		try 
		{
			$this->db->trans_start();
			
			$this->Leave_types_model->create($data);

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

		if($this->Leave_types_model->is_name_exists($data['name'], $id))
		{
			json_response(FALSE, 'Leave type name already exists.');
		}

		$this->Leave_types_model->update($data, $id);
		
		json_response(TRUE, 'Updated successfully');
	}

	public function delete($id)
	{
		if ( ! in_array(get_user_type(), [-1, 0])) 
		{	
			json_response(FALSE, 'User cannot not delete leave type');
		}

		if ($this->Leave_types_model->has_leave_requests($id))
		{
			json_response(FALSE, 'Cannot delete leave type. There are leave requests under this leave type.');
		}

        $this->Leave_types_model->delete($id);
		json_response(TRUE, 'Deleted successfully');
	}

}

