<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller 
{
	public $fields = ['first_name', 'middle_name', 'surname', 'ext_name', 'username', 'password', 'type'];
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Account_model');
	}

	public function index()
	{
		$data['page_title'] = 'My Account';
		$data['page_js'] = [
			base_url('assets/js/account/profile.js')
		];

		$page_data['user'] = $this->Account_model->get(['id' => get_user_data()['id']]);
		if ( ! $page_data['user'])
		{
			$this->session->sess_destroy();
			redirect(base_url());
		}

		if ($page_data['user']->avatar && file_exists('./uploads/'. $page_data['user']->avatar)) 
		{
			$page_data['user']->avatar = base_url('./uploads/'. $page_data['user']->avatar);
		} 
		else 
		{
			$page_data['user']->avatar = get_default_avatar();
		}

		$data['body'] = $this->load->view('account/personal', $page_data, true);

		$this->load->view('index', $data);
	}

	public function create()
	{
		if ( ! in_array(get_user_type(), [-1, 0])) // super, admin
		{
			show_404();
		}

		$data['page_title'] = "Employee's Account";
		$data['nav_active'] = 'employees';
		$data['page_js'] = [
			base_url('assets/js/helpers.js'),
			base_url('assets/js/account/create.js'),
			base_url('assets/plugins/momentjs/moment.js'),
			base_url('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')
		];		
		$data['page_css'] = [
			base_url('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')
		];

		$this->load->model(['Departments_model', 'Positions_model']);
		
		$create_data = [
			'departments'       => $this->Departments_model->all(),
			'positions'         => $this->Positions_model->all(),
			'job_status'        => get_all_job_status(),
			'employment_status' => get_all_employment_status()
		];
		
		$data['body'] = $this->load->view('account/create', $create_data, true);
		$this->load->view('index', $data);
	}

	public function add()
	{		
		$user_type = $this->input->post('type');

		$fields = [
			'last_name', 
			'first_name', 
			'ext_name',
			'middle_name',
			'department_id',
			'position_id', 
			'date_employed',
			'job_status', 
			// 'emp_status', 
			'type', 
			'username', 
			'password', 
			'confirm'
		];
		if (has_empty_post($fields, ['ext_name', 'middle_name'])) 
		{	
			json_response(FALSE, 'Fill in the required fields');
		}

		$data = parse_data($_POST, $fields);

		if ( ! isset($data['password']))
		{
			json_response(FALSE, 'Please provide a password');
		}
		
		if (!isset($data['confirm']) || $data['password'] !== $data['confirm']) {
			json_response(FALSE, 'Password and retyped password doesn\'t match.');
		}
		
		unset($data['confirm']);

		if($this->Account_model->is_username_exists($data['username']))
		{
			json_response(FALSE, 'Username is already used. Please use another.');
		}

		try 
		{
			$this->db->trans_start();
			
			$user_id = $this->Account_model->create($data);

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, 'Created account successfully', $user_id);
	}

    public function update_account($user_id)
    {
		$id = (int) $user_id;
		$operator_id = get_user_data()['id'];
		if ( ! in_array(get_user_type(), [-1]) && $id != $operator_id) 
		{
			json_response(FALSE, 'You can not edit other user\'s account');
		}

		$user = $this->Account_model->get(['id' => $id], 'type');
		$user_type = $user->type;

		$exclude = [
			'password', 
			'confirm'
		];
		$fields = [
			'username', 
			'password', 
			'confirm'
		];
		
		if (in_array(get_user_type(), [-1]) && $id != $operator_id)
		{
			$fields[] = 'type';
		}

		if (has_empty_post($fields, $exclude)) 
		{	
			json_response(FALSE, 'Fill in the empty fields');
		}

		$data = parse_data($_POST, $fields);

		if($this->Account_model->is_username_exists($data['username'], $id))
		{
			json_response(FALSE, 'Username is already used. Please use another.');
		}

		if ( ! empty($data['password']) || ! empty($data['confirm']))
		{
			if (!isset($data['confirm']) || $data['password'] !== $data['confirm']) 
			{
				json_response(FALSE, 'Password and retyped password doesn\'t match.');
			}

			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		}
		else 
		{
			unset($data['password']);
		}

		unset($data['confirm']);

		$this->Account_model->update($data, $id);
        
		json_response(TRUE, 'Changes saved successfully');
	}

	public function delete($id)
	{
		if ($id == get_user_data()['id']) 
		{	
			json_response(FALSE, 'Cannot delete current user\'s account');
		}

		if ( ! in_array(get_user_type(), [-1])) 
		{
			json_response(FALSE, 'You do not have the privilege to delete account');
		}

		$user = $this->Account_model->get(['id' => $id], 'avatar, type');
		
		if ($user && $user->avatar && file_exists('./uploads/'. $user->avatar)) 
		{
			unlink('./uploads/'. $user->avatar);
		}

		try 
		{
			$this->db->trans_start();
			
			$this->Account_model->delete($id);

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
		json_response(TRUE, 'Deleted successfully');
	}
}

