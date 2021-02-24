<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
     * 
	 */

    
	public function __construct(){
		parent::__construct();
    }
    
	public function index()
	{
		if ($this->session->userdata('logged_in')) 
		{
			redirect(base_url().'Log');
		}
		$data['page_js'] = [
			base_url('assets/js/login.js')
		];
		$this->load->view('login', $data);
    }
    
    public function sign_in()
    {
		if ( ! $this->input->post('username') && ! $this->input->post('password'))
		{
			json_response(FALSE, 'Fill in the empty fields');
		}
		
		$fields = ['username', 'password'];

		$data = parse_data($_POST, $fields);

		$this->load->model('Account_model');
		if( ! $this->Account_model->is_username_exists($data['username']))
		{
			json_response(FALSE, 'Couldn\'t find your account');
		}

		$user_data = $this->Account_model->get(['username' => $data['username'], 'deleted' => 0]);

		if (empty($user_data))
		{
			json_response(FALSE, 'Couldn\'t find your account');
		}

		if( ! password_verify($data['password'], $user_data->password))
		{			
			json_response(FALSE, 'Invalid password');
		}

		if ($user_data->disabled != 0)
		{
			json_response(FALSE, 'Your account was disabled');
		}

		$avatar = get_default_avatar();
		if ($user_data->avatar && file_exists('./uploads/'. $user_data->avatar)) 
		{
			$avatar = base_url('./uploads/'. $user_data->avatar);
		}

		$user_info = $this->Account_model->get_info(['u.id' => (int) $user_data->id]);

		$session_data = array(
			'id'               => (int) $user_data->id,
			'first_name'       => $user_data->first_name,
			'last_name'        => $user_data->last_name,
			'username'         => $user_data->username,
			'type'             => (int) $user_data->type,
			'avatar'           => $avatar
		);

		$this->session->set_userdata('logged_in', $session_data);
		
		json_response(TRUE, 'Logged in successfully', [
			'has_profile_data' => in_array((int) $user_data->type, [-1, 0]) || $this->Account_model->has_profile_data((int) $user_data->id)
		]);
	}

	public function sign_out() 
	{
        $this->session->sess_destroy();
		redirect(base_url());
	}

	public function register($set_type = FALSE)
	{
		$exclude = [];
		if ($set_type && $this->input->post('type') == 2) 
		{
			$exclude = ['shop_name'];
		}

		if (has_empty_post($exclude)) 
		{	
			json_response(FALSE, 'Fill in the empty fields');
		}

		$fields = ['first_name', 'last_name', 'contact_number', 'shop_name', 'address', 'email', 'username', 'password', 'confirm'];

		$data = parse_data($_POST, $fields);

		if ( ! isset($data['password']))
		{
			json_response(FALSE, 'Please provide a password');
		}
		
		if (!isset($data['confirm']) || $data['password'] !== $data['confirm']) 
		{
			json_response(FALSE, 'Password and retyped password doesn\'t match.');
		}
		
		unset($data['confirm']);

		$user_type = $this->input->post('type');
		$data['type'] = in_array($user_type, [1, 2]) ? $user_type : 2;

		$this->load->model('Account_model');

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
		
		$session_data = array(
			'id'         => (int) $user_id,
			'first_name' => $data['first_name'],
			'last_name'  => $data['last_name'],
			'email'      => $data['email'],
			'username'   => $data['username'],
			'type'       => $data['type'],
			'avatar' 	 => get_default_avatar()
		);

		$this->session->set_userdata('logged_in', $session_data);

        json_response(TRUE, 'Created account successfully');
	}
}
