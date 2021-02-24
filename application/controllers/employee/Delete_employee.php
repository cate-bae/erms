<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete_employee extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model(['Employees_model', 'Account_model']);
	}

	public function index()
	{

	}

	public function child($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);

		$child_id = (int) $this->input->post('id');

		if (empty($child_id)) 
		{	
			json_response(FALSE, 'Incomplete parameters');
		}

		$this->Employees_model->delete('children', ['id' => $child_id, 'user_id' => $user_id]);
		
        json_response(TRUE, 'Deleted successfully', $user_id);
	}
    
    private function validate($user_id)
    {
        if (( ! in_array(get_user_type(), [-1, 0]) && $user_id != get_user_data()['id']) || empty($user_id)) 
		{	
			json_response(FALSE, 'Cannot delete employee data.');
        }
        
		$user_info = $this->Account_model->get(['id' => $user_id]);
		if (empty($user_info)) 
		{
			json_response(FALSE, 'Employee doesn\'t exist.');
        }
    }

	public function education($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);

		$id = (int) $this->input->post('id');

		if (empty($id)) 
		{	
			json_response(FALSE, 'Incomplete parameters');
		}

		$this->Employees_model->delete('education', ['id' => $id, 'user_id' => $user_id]);
		
        json_response(TRUE, 'Deleted successfully', $user_id);
	}

	public function civil_service($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);

		$id = (int) $this->input->post('id');

		if (empty($id)) 
		{	
			json_response(FALSE, 'Incomplete parameters');
		}

		$this->Employees_model->delete('civil_service', ['id' => $id, 'user_id' => $user_id]);
		
        json_response(TRUE, 'Deleted successfully', $user_id);
	}

	public function work_experience($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);

		$id = (int) $this->input->post('id');

		if (empty($id)) 
		{	
			json_response(FALSE, 'Incomplete parameters');
		}

		$this->Employees_model->delete('work_experience', ['id' => $id, 'user_id' => $user_id]);
		
        json_response(TRUE, 'Deleted successfully', $user_id);
	}

	public function voluntary_work($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);

		$id = (int) $this->input->post('id');

		if (empty($id)) 
		{	
			json_response(FALSE, 'Incomplete parameters');
		}

		$this->Employees_model->delete('voluntary_work', ['id' => $id, 'user_id' => $user_id]);
		
        json_response(TRUE, 'Deleted successfully', $user_id);
	}

	public function training($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);

		$id = (int) $this->input->post('id');

		if (empty($id)) 
		{	
			json_response(FALSE, 'Incomplete parameters');
		}

		$this->Employees_model->delete('trainings', ['id' => $id, 'user_id' => $user_id]);
		
        json_response(TRUE, 'Deleted successfully', $user_id);
	}

	public function reference($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);

		$id = (int) $this->input->post('id');

		if (empty($id)) 
		{	
			json_response(FALSE, 'Incomplete parameters');
		}

		$this->Employees_model->delete('references', ['id' => $id, 'user_id' => $user_id]);
		
        json_response(TRUE, 'Deleted successfully', $user_id);
	}

	public function skill($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);

		$id = (int) $this->input->post('id');

		if (empty($id)) 
		{	
			json_response(FALSE, 'Incomplete parameters');
		}

		$this->Employees_model->delete('skill', ['id' => $id, 'user_id' => $user_id]);
		
        json_response(TRUE, 'Deleted successfully', $user_id);
	}

	public function recognition($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);

		$id = (int) $this->input->post('id');

		if (empty($id)) 
		{	
			json_response(FALSE, 'Incomplete parameters');
		}

		$this->Employees_model->delete('recognition', ['id' => $id, 'user_id' => $user_id]);
		
        json_response(TRUE, 'Deleted successfully', $user_id);
	}

	public function membership($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);

		$id = (int) $this->input->post('id');

		if (empty($id)) 
		{	
			json_response(FALSE, 'Incomplete parameters');
		}

		$this->Employees_model->delete('membership', ['id' => $id, 'user_id' => $user_id]);
		
        json_response(TRUE, 'Deleted successfully', $user_id);
	}

	public function benefit($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);

		$id = (int) $this->input->post('id');

		if (empty($id)) 
		{	
			json_response(FALSE, 'Incomplete parameters');
		}

		$this->Employees_model->delete('user_benefits', ['id' => $id, 'user_id' => $user_id]);
		
        json_response(TRUE, 'Deleted successfully', $user_id);
	}

	public function leave($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);

		$id = (int) $this->input->post('id');

		if (empty($id)) 
		{	
			json_response(FALSE, 'Incomplete parameters');
		}

		$leave = $this->Employees_model->get('leave_requests', ['id' => $id, 'user_id' => $user_id], 'status');
		if (empty($leave))
		{
			json_response(FALSE, 'Leave request does not exits.');
		}

		if ($leave->status == 1)
		{
			json_response(FALSE, 'Cannot delete approved leave request.');
		}

		$this->Employees_model->delete('leave_requests', ['id' => $id, 'user_id' => $user_id]);
		
        json_response(TRUE, 'Deleted successfully', $user_id);
	}
}

