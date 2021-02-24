<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Attendance_model');
	}

	public function index()
	{
		if ( ! in_array(get_user_type(), [-1, 0])) // super, admin
		{
			show_404();
		}

		$data['page_title'] = 'Attendance';
		$data['nav_active'] = 'attendance';
		$data['page_js'] = [
			base_url('assets/plugins/jquery-datatable/jquery.dataTables.js'),
			base_url('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'),
			base_url('assets/js/pages/tables.js'),
			base_url('assets/js/attendance/list.js'),
			base_url('assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js')
		];

		$page_data['list'] = $this->Attendance_model->all();
		$this->load->model('Employees_model');
		$page_data['employees'] = $this->Employees_model->get_employee_names();

		$data['body'] = $this->load->view('attendance/list', $page_data, true);
		$this->load->view('index', $data);
	}

	public function add()
	{		
		if ( ! in_array(get_user_type(), [-1, 0])) 
		{
			json_response(FALSE, 'User can not create attendance.');
		}

		$fields = [
			'user_id',
			'date',
			'time_in',
			'break',
			'resume',
			'time_out'
		];
		if (has_empty_post($fields)) 
		{	
			json_response(FALSE, 'Fill in the empty fields');
		}

		$data = parse_data($_POST, $fields);
		$data['day'] = date('l', strtotime($data['date']));

		if($this->Attendance_model->is_exists(['user_id' => $data['user_id'], 'date' => $data['date']]))
		{
			json_response(FALSE, 'Employee attendance date already exists.');
		}

		try 
		{
			$this->db->trans_start();
			
			$this->Attendance_model->create($data);

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
			json_response(FALSE, 'User cannot not update attendance');
		}

		$id = (int) $this->input->post('id');
		$fields = [
			'user_id',
			'date',
			'time_in',
			'break',
			'resume',
			'time_out'
		];
		if (has_empty_post($fields) || empty($id)) 
		{	
			json_response(FALSE, 'Fill in the empty fields');
		}
		
		$data = parse_data($_POST, $fields);
		$data['day'] = date('l', strtotime($data['date']));

		if($this->Attendance_model->is_exists(['user_id' => $data['user_id'], 'date' => $data['date'], 'id!=' => $id]))
		{
			json_response(FALSE, 'Employee attendance date already exists.');
		}

		$this->Attendance_model->update($data, $id);
		
		json_response(TRUE, 'Updated successfully');
	}

	public function delete($id)
	{
		if ( ! in_array(get_user_type(), [-1, 0])) 
		{	
			json_response(FALSE, 'User can not delete attendance');
		}

		$this->Attendance_model->delete($id);
		
		json_response(TRUE, 'Deleted successfully');
	}

	public function upload_employee_attendance($user_id)
	{
		$upload_file = upload_file('xlsx|xls');
		
		if (file_exists('./uploads/' . $upload_file))
		{
			unlink('./uploads/' . $upload_file);
		};
	}

}

