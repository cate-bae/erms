<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Positions extends CI_Controller 
{

	public function __construct()
	{
        parent::__construct();
		is_logged_in();
		$this->page_js = [
			base_url('assets/plugins/jquery-datatable/jquery.dataTables.js'),
			base_url('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'),
			base_url('assets/js/pages/tables.js')
		];
		$this->load->model('Positions_model');
	}

	public function index()
	{
		$data['page_title'] = 'Positions';
		$data['nav_active'] = 'positions';
		
		$data['page_js'] = $this->page_js;
		$data['page_js'][] = base_url('assets/js/positions/list.js');

		$page_data['list'] = $this->Positions_model->all();

		$data['body'] = $this->load->view('positions/list', $page_data, true);
		$this->load->view('index', $data);
	}

	public function add()
	{		
		if ( ! in_array(get_user_type(), [-1, 0])) 
		{
			json_response(FALSE, 'User must not create positions.');
		}

		if (has_empty_post(['name'])) 
		{	
			json_response(FALSE, 'Fill in the empty fields');
		}

		$data = parse_data($_POST, ['name']);

		if($this->Positions_model->is_name_exists($data['name']))
		{
			json_response(FALSE, 'Position name already exists.');
		}

		try 
		{
			$this->db->trans_start();
			
			$this->Positions_model->create($data);

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
			json_response(FALSE, 'User should not update Position');
		}

		if (has_empty_post(['name'])) 
		{	
			json_response(FALSE, 'Fill in the empty fields');
		}
		
		$data = parse_data($_POST, ['name']);

		if($this->Positions_model->is_name_exists($data['name'], $id))
		{
			json_response(FALSE, 'Position name already exists.');
		}

		$this->Positions_model->update($data, $id);
		
		json_response(TRUE, 'Updated successfully');
	}

	public function delete($id)
	{
		if ( ! in_array(get_user_type(), [-1, 0])) 
		{	
			json_response(FALSE, 'User must not delete Position');
		}

		if ($this->Positions_model->has_employees($id))
		{
			json_response(FALSE, 'Cannot delete Position. There are employees under this Position.');
		}

        $this->Positions_model->delete($id);
		json_response(TRUE, 'Deleted successfully');
	}
}
