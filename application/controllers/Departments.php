<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Departments_model');
	}

	public function index()
	{
		if ( ! in_array(get_user_type(), [-1, 0])) // super, admin
		{
			show_404();
		}

		$data['page_title'] = 'Departments';
		$data['nav_active'] = 'departments';
		$data['page_js'] = [
			base_url('assets/plugins/jquery-datatable/jquery.dataTables.js'),
			base_url('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'),
			base_url('assets/js/pages/tables.js'),
			base_url('assets/js/departments/list.js')
		];

		$page_data['list'] = $this->Departments_model->all();

		$data['body'] = $this->load->view('departments/list', $page_data, true);
		$this->load->view('index', $data);
	}

	public function add()
	{		
		if ( ! in_array(get_user_type(), [-1, 0])) 
		{
			json_response(FALSE, 'User must not create departments.');
		}

		if (has_empty_post(['name'])) 
		{	
			json_response(FALSE, 'Fill in the empty fields');
		}

		$data = parse_data($_POST, ['name']);

		if($this->Departments_model->is_name_exists($data['name']))
		{
			json_response(FALSE, 'Department name already exists.');
		}

		try 
		{
			$this->db->trans_start();
			
			$this->Departments_model->create($data);

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
			json_response(FALSE, 'User should not update department');
		}

		if (has_empty_post(['name'])) 
		{	
			json_response(FALSE, 'Fill in the empty fields');
		}
		
		$data = parse_data($_POST, ['name']);

		if($this->Departments_model->is_name_exists($data['name'], $id))
		{
			json_response(FALSE, 'Department name already exists.');
		}

		$this->Departments_model->update($data, $id);
		
		json_response(TRUE, 'Updated successfully');
	}

	public function delete($id)
	{
		if ( ! in_array(get_user_type(), [-1, 0])) 
		{	
			json_response(FALSE, 'User must not delete department');
		}

		if ($this->Departments_model->has_employees($id))
		{
			json_response(FALSE, 'Cannot delete department. There are employees under this department.');
		}

        $this->Departments_model->delete($id);
		json_response(TRUE, 'Deleted successfully');
	}

}

