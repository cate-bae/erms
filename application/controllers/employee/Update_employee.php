<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_employee extends CI_Controller 
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

	public function biometrics($user_id)
	{
		$user_id = (int) $user_id;
		$this->validate($user_id);
		
		$biometrics_id = $this->input->post('biometrics_id');
		if (empty($biometrics_id))
		{
			json_response(FALSE, 'Fill in the required fields', ['fields' => 'biometrics_id']);
		}

		if ($this->Employees_model->biometrics_exists($biometrics_id, $user_id))
		{
			json_response(FALSE, 'Biometrics ID already used by other employee.');
		}
		
		$this->Employees_model->update('users', ['biometrics_id' => $biometrics_id], ['id' => $user_id]);

        json_response(TRUE, 'Saved successfully', $user_id);
	}

    public function personal($user_id)
    {		
		$user_id = (int) $user_id;
        $this->validate($user_id);
	
        $required_fields = [
			'birth_day',
			'birth_place',
			'sex',
			'blood_type',
			'civil_status',
			'height',
			'weight',
			'citizenship'
		];

		$empty_fields = has_empty_post($required_fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}

		$fields = [
			'civil_others',
			'dual_citizenship',
			'country',
			'gsis',
			'pagibig',
			'philhealth',
			'sss',
			'tin',
			'agency_employee_no',
			'telephone',
			'mobile',
			'email',
			'govt_issued_id',
			'govt_issued_id_no',
			'govt_issued_id_date',
			'govt_issued_id_place'
		];
		
		$data = parse_data($_POST, array_merge($required_fields, $fields));

		$error_fields = [];
		if ($data['civil_status'] == 'Other/s' && empty($data['civil_others'])) 
		{
			$error_fields[] = 'civil_others';
		}
		
		if ($data['citizenship'] == 'Dual Citizenship' && empty($data['country'])) 
		{
			$error_fields[] = 'country';
		}
		
		if ( ! empty($error_fields))
		{
			json_response(FALSE, 'Fill in the required fields', ['fields' => $error_fields]);
        }

		try 
		{
            $this->db->trans_start();
            
			$data['birth_day'] = date('Y-m-d', strtotime($data['birth_day']));
            $this->save_data('profile', $data, ['user_id' => $user_id]);

            $this->address($user_id);

			$this->db->trans_complete();
        }
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}

        json_response(TRUE, 'Changes saved successfully', $user_id);
	}
	
	public function save_name($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$fields = [
			'last_name',
			'first_name',
			'ext_name',
			'middle_name',
		];
		if (has_empty_post($fields, ['ext_name', 'middle_name'])) 
		{	
			json_response(FALSE, 'Fill in the required fields');
		}
		$data = parse_data($_POST, $fields);
		
		$this->Employees_model->update('users', $data, ['id' => $user_id]);

        json_response(TRUE, 'Changes saved successfully', $user_id);
	}
	
	public function designation($user_id)
	{
		if (! in_array(get_user_type(), [-1, 0])) 
		{	
			json_response(FALSE, 'Cannot update employee data.');
        }
        
		$user_id = (int) $user_id;
		$fields = [
			'department_id',
			'position_id', 
			'date_employed',
			'job_status', 
			'emp_status'
		];
		if (has_empty_post($fields)) 
		{	
			json_response(FALSE, 'Fill in the required fields');
		}
		$data = parse_data($_POST, $fields);
		
		$user_data = $this->Employees_model->get('users', ['id' => $user_id], $fields = 'job_status');

		if ((int) $data['job_status'] == 1)
		{
			$regular_date = $this->input->post('regular_date');
			if (empty($regular_date)) 
			{
				json_response(FALSE, 'Fill in the required fields');
			}
			$data['regular_date'] = date('m/d/Y', strtotime($regular_date));
		}

		$this->Employees_model->update('users', $data, ['id' => $user_id]);

        json_response(TRUE, 'Changes saved successfully', $user_id);
	}

	public function address($user_id)
	{
		$fields = [
			'house_no',
			'street',
			'subdivision',
			'barangay',
			'municipality',
			'province',
			'zip'
		];

		$data = parse_data($_POST, $fields);
		
		$data = array_group_by_index($data);

		foreach ($data as $type => $value) 
		{
			$value['user_id'] = $user_id;
			$value['type']    = $type;
            $this->save_data('address', $value, ['user_id' => $user_id, 'type' => $type]);
		}
	}
	
	public function spouse($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$spouse_fields = [
			'spouse_surname',
			'spouse_first_name',
			'spouse_ext_name',
			'spouse_middle_name',
			'spouse_occupation',
			'spouse_business',
			'spouse_business_address',
			'spouse_telephone'
		];
		$spouse = parse_data($_POST, $spouse_fields);
		
		$spouse_value = [];
		foreach ($spouse as $key => $value)
		{
			$spouse_value[str_replace('spouse_', '', $key)] = trim($value);
		}
		$this->save_data('spouse', $spouse_value, ['user_id' => $user_id]);

        json_response(TRUE, 'Spouse info saved successfully', $user_id);
	}

	public function father($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$father_fields = [
			'father_surname',
			'father_first_name',
			'father_ext_name',
			'father_middle_name'
		];
		$father = parse_data($_POST, $father_fields);

		$father_value = [
			'type'    => 0
		];
		foreach ($father as $key => $value)
		{
			$father_value[str_replace('father_', '', $key)] = trim($value);
		}

		$this->save_data('parent', $father_value, ['user_id' => $user_id, 'type' => 0]);

        json_response(TRUE, 'Father\'s info saved successfully', $user_id);
	}

	public function mother($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$mother_fields = [
			'mother_maiden_name',
			'mother_surname',
			'mother_first_name',
			'mother_middle_name'
		];
		$mother = parse_data($_POST, $mother_fields);
		
		$mother_value = [
			'type'    => 1
		];
		foreach ($mother as $key => $value)
		{
			$mother_value[str_replace('mother_', '', $key)] = trim($value);
		}

		$this->save_data('parent', $mother_value, ['user_id' => $user_id, 'type' => 1]);
		
        json_response(TRUE, 'Mother\'s info saved successfully', $user_id);
	}

	public function add_child($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		
		$child_fields = [
			'name',
			'birth_day'
		];
		$empty_fields = has_empty_post($child_fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}

		$child = parse_data($_POST, $child_fields);
		$child['user_id'] = $user_id;
		$child['birth_day'] = date('Y-m-d', strtotime($child['birth_day']));

		$this->Employees_model->save('children', $child);
		
        json_response(TRUE, 'Child\'s info saved successfully', $user_id);
	}

	public function child($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$child_fields = [
			'id',
			'name',
			'birth_day'
		];
		$empty_fields = has_empty_post($child_fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$child = parse_data($_POST, $child_fields);
		$child_id = $child['id'];
		unset($child['id']);
		$child['birth_day'] = date('Y-m-d', strtotime($child['birth_day']));

		$this->save_data('children', $child, ['user_id' => $user_id, 'id' => $child_id]);
		
        json_response(TRUE, 'Child\'s info saved successfully', $user_id);
	}
    
    private function save_data($table, $data, $where)
    {
        if ( $this->Employees_model->has_data($table, $where))
        {
            $this->Employees_model->update($table, $data, $where);
        }
        else
        {
            $data['user_id'] = $where['user_id'];
            $this->Employees_model->save($table, $data);
        }
    }

    private function validate($user_id)
    {
        if (( ! in_array(get_user_type(), [-1, 0]) && $user_id != get_user_data()['id']) || empty($user_id)) 
		{	
			json_response(FALSE, 'Cannot update employee data.');
        }
        
		$user_info = $this->Account_model->get(['id' => $user_id]);
		if (empty($user_info)) 
		{
			json_response(FALSE, 'Employee doesn\'t exist.');
        }
    }

	public function add_education($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		
		$fields = [
			'level',
			'school',
			'course',
			'from',
			'to',
			'units',
			'year',
			'honors'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$education = parse_data($_POST, $fields);
	
		$education['user_id'] = $user_id;
		$education['from']    = $education['from'];
		$education['to']      = $education['to'];
	
		$this->Employees_model->save('education', $education);

        json_response(TRUE, 'Education saved successfully', $user_id);
	}

	public function education($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$fields = [
			'id',
			'level',
			'school',
			'course',
			'from',
			'to',
			'units',
			'year',
			'honors'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$education = parse_data($_POST, $fields);
	
		$id = $education['id'];
		unset($education['id']);
		$education['from'] = $education['from'];
		$education['to'] = $education['to'];

		$this->Employees_model->update('education', $education, ['user_id' => $user_id, 'id' => $id]);
		
        json_response(TRUE, 'Education saved successfully', $user_id);
	}

	public function add_civil_service($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		
		$fields = [
			'title',
			'rating',
			'date',
			'place',
			'license',
			'validity'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$data['user_id'] = $user_id;
		$data['date'] = date('Y-m-d', strtotime($data['date']));
	
		$this->Employees_model->save('civil_service', $data);
		
        json_response(TRUE, 'Civil service saved successfully', $user_id);
	}

	public function civil_service($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$fields = [
			'id',
			'title',
			'rating',
			'date',
			'place',
			'license',
			'validity'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$id = $data['id'];
		unset($data['id']);
		$data['date'] = date('Y-m-d', strtotime($data['date']));

		$this->Employees_model->update('civil_service', $data, ['user_id' => $user_id, 'id' => $id]);
		
        json_response(TRUE, 'Civil service saved successfully', $user_id);
	}

	public function add_work_experience($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		
		$fields = [
			'from',
			'to',
			'position',
			'department',
			'salary',
			'salary_grade',
			'status',
			'govt'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$data['user_id'] = $user_id;
		$data['from']    = date('Y-m-d', strtotime($data['from']));
		$data['to']      = date('Y-m-d', strtotime($data['to']));
	
		$this->Employees_model->save('work_experience', $data);
		
        json_response(TRUE, 'Work experience saved successfully', $user_id);
	}

	public function work_experience($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$fields = [
			'id',
			'from',
			'to',
			'position',
			'department',
			'salary',
			'salary_grade',
			'status',
			'govt'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$id = $data['id'];
		unset($data['id']);
		$data['from'] = date('Y-m-d', strtotime($data['from']));
		$data['to']   = date('Y-m-d', strtotime($data['to']));

		$this->Employees_model->update('work_experience', $data, ['user_id' => $user_id, 'id' => $id]);
		
        json_response(TRUE, 'Work experience saved successfully', $user_id);
	}

	public function add_voluntary_work($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		
		$fields = [
			'name',
			'from',
			'to',
			'hours',
			'position'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$data['user_id'] = $user_id;
		$data['from']    = date('Y-m-d', strtotime($data['from']));
		$data['to']      = date('Y-m-d', strtotime($data['to']));
	
		$this->Employees_model->save('voluntary_work', $data);
		
        json_response(TRUE, 'Voluntary work saved successfully', $user_id);
	}

	public function voluntary_work($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$fields = [
			'id',
			'name',
			'from',
			'to',
			'hours',
			'position'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$id = $data['id'];
		unset($data['id']);
		$data['from'] = date('Y-m-d', strtotime($data['from']));
		$data['to']   = date('Y-m-d', strtotime($data['to']));

		$this->Employees_model->update('voluntary_work', $data, ['user_id' => $user_id, 'id' => $id]);
		
        json_response(TRUE, 'Voluntary work saved successfully', $user_id);
	}

	public function add_training($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		
		$fields = [
			'title',
			'from',
			'to',
			'hours',
			'type',
			'sponsor'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$data['user_id'] = $user_id;
		$data['from']    = date('Y-m-d', strtotime($data['from']));
		$data['to']      = date('Y-m-d', strtotime($data['to']));
	
		$this->Employees_model->save('trainings', $data);
		
        json_response(TRUE, 'Training saved successfully', $user_id);
	}

	public function training($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$fields = [
			'id',
			'title',
			'from',
			'to',
			'hours',
			'type',
			'sponsor'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$id = $data['id'];
		unset($data['id']);
		$data['from'] = date('Y-m-d', strtotime($data['from']));
		$data['to']   = date('Y-m-d', strtotime($data['to']));

		$this->Employees_model->update('trainings', $data, ['user_id' => $user_id, 'id' => $id]);
		
        json_response(TRUE, 'Training saved successfully', $user_id);
	}
	
	public function questions($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$fields = [
			'third_degree',
			'fourth_degree',
			'fourth_degree_details',
			'offence_guilty',
			'offence_guilty_details',
			'criminally_charged',
			'criminally_charged_date',
			'criminally_charged_status',
			'convicted_crime',
			'convicted_crime_details',
			'separated_service',
			'separated_service_details',
			'election_candidate',
			'election_candidate_details',
			'resigned_govt',
			'resigned_govt_details',
			'immigrant',
			'immigrant_details',
			'indigent',
			'indigency',
			'disabled',
			'disabled_id',
			'solo_parent',
			'solo_parent_id'
		];

		$data = parse_data($_POST, $fields);

		$errors = [];
		if ($data['fourth_degree'] == 'Yes')
		{
			if (empty($data['fourth_degree_details']))
			{
				$errors[] = 'fourth_degree_details';
			}
		}

		if ($data['offence_guilty'] == 'Yes')
		{
			if (empty($data['offence_guilty_details']))
			{
				$errors[] = 'offence_guilty_details';
			}
		}

		if ($data['criminally_charged'] == 'Yes')
		{
			if (empty($data['criminally_charged_date']))
			{
				$errors[] = 'criminally_charged_date';
			}
			if (empty($data['criminally_charged_status']))
			{
				$errors[] = 'criminally_charged_status';
			}
		}

		if ($data['convicted_crime'] == 'Yes')
		{
			if (empty($data['convicted_crime_details']))
			{
				$errors[] = 'convicted_crime_details';
			}
		}

		if ($data['separated_service'] == 'Yes')
		{
			if (empty($data['separated_service_details']))
			{
				$errors[] = 'separated_service_details';
			}
		}

		if ($data['election_candidate'] == 'Yes')
		{
			if (empty($data['election_candidate_details']))
			{
				$errors[] = 'separated_service_details';
			}
		}

		if ($data['resigned_govt'] == 'Yes')
		{
			if (empty($data['resigned_govt_details']))
			{
				$errors[] = 'resigned_govt_details';
			}
		}

		if ($data['immigrant'] == 'Yes')
		{
			if (empty($data['immigrant_details']))
			{
				$errors[] = 'immigrant_details';
			}
		}

		if ($data['indigent'] == 'Yes')
		{
			if (empty($data['indigency']))
			{
				$errors[] = 'indigency';
			}
		}

		if ($data['disabled'] == 'Yes')
		{
			if (empty($data['disable_id']))
			{
				$errors[] = 'disabled_id';
			}
		}

		if ($data['solo_parent'] == 'Yes')
		{
			if (empty($data['solo_parent_id']))
			{
				$errors[] = 'solo_parent_id';
			}
		}

		if ( ! empty($errors))
		{
			json_response(FALSE, 'Fill in the empty fields', [ 'page' => 7, 'fields' => $errors]);
			return;
		}

		$this->save_data('questions', $data, ['user_id' => $user_id]);

        json_response(TRUE, 'Information saved successfully', $user_id);
	}

	public function add_reference($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		
		$fields = [
			'name',
			'address',
			'telephone'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$data['user_id'] = $user_id;
	
		$this->Employees_model->save('references', $data);
		
        json_response(TRUE, 'Reference saved successfully', $user_id);
	}

	public function reference($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$fields = [
			'id',
			'name',
			'address',
			'telephone'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$id = $data['id'];
		unset($data['id']);

		$this->Employees_model->update('references', $data, ['user_id' => $user_id, 'id' => $id]);
		
        json_response(TRUE, 'Reference saved successfully', $user_id);
	}

	public function add_skill($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		
		$fields = [
			'skill'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$data['user_id'] = $user_id;
	
		$this->Employees_model->save('skill', $data);
		
        json_response(TRUE, 'Special Skill/Hobby saved successfully', $user_id);
	}

	public function skill($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$fields = [
			'id',
			'skill'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$id = $data['id'];
		unset($data['id']);

		$this->Employees_model->update('skill', $data, ['user_id' => $user_id, 'id' => $id]);
		
        json_response(TRUE, 'Special Skill/Hobby saved successfully', $user_id);
	}

	public function add_recognition($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		
		$fields = [
			'name'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$data['user_id'] = $user_id;
	
		$this->Employees_model->save('recognition', $data);
		
        json_response(TRUE, 'Non-academic Distinctions/Recognition saved successfully', $user_id);
	}

	public function recognition($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$fields = [
			'id',
			'name'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$id = $data['id'];
		unset($data['id']);

		$this->Employees_model->update('recognition', $data, ['user_id' => $user_id, 'id' => $id]);
		
        json_response(TRUE, 'Non-academic Distinctions/Recognition saved successfully', $user_id);
	}

	public function add_membership($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		
		$fields = [
			'name'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$data['user_id'] = $user_id;
	
		$this->Employees_model->save('membership', $data);
		
        json_response(TRUE, 'Membership in Association/Organization saved successfully', $user_id);
	}

	public function membership($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$fields = [
			'id',
			'name'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);
	
		$id = $data['id'];
		unset($data['id']);

		$this->Employees_model->update('membership', $data, ['user_id' => $user_id, 'id' => $id]);
		
        json_response(TRUE, 'Membership in Association/Organization saved successfully', $user_id);
	}

    public function agreement($user_id)
    {		
		$user_id = (int) $user_id;
        $this->validate($user_id);
	
		$fields = [
			'govt_issued_id',
			'govt_issued_id_no',
			'govt_issued_id_date',
			'govt_issued_id_place'
		];

		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);

		try 
		{
			
            $this->save_data('profile', $data, ['user_id' => $user_id]);

        }
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}

        json_response(TRUE, 'Changes saved successfully', $user_id);
	}

	public function add_benefit($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$fields = [
			'benefit_id'
		];
		
		$data = parse_data($_POST, $fields);

		if (empty($data))
		{
			$this->Employees_model->delete('user_benefits', ['user_id' => $user_id]);
			json_response(TRUE, 'Saved successfully', $user_id);
		}
		
		$current_benefits = $this->Employees_model->get_benefits($user_id);
		
		$insert_data = [];
		foreach ($data['benefit_id'] as $benefit_id) 
		{
			if ( ! in_array($benefit_id, $current_benefits))
			{
				$insert_data[] = [
					'user_id'    => $user_id,
					'benefit_id' => $benefit_id
				];
			}
		}

		$remove_data = [];
		foreach ($current_benefits as $benefit_id) 
		{
			if ( ! in_array($benefit_id, $data['benefit_id']))
			{
				$remove_data[] = $benefit_id;
			}
		}
		
		if ( ! empty($remove_data))
		{
			$this->Employees_model->delete('user_benefits', ['user_id' => $user_id, 'benefit_id' => $remove_data]);
		}

		if ( ! empty($insert_data))
		{
			$this->Employees_model->save_multiple('user_benefits', $insert_data);
		}
		
        json_response(TRUE, 'Saved successfully', $user_id);
	}

	public function add_leave($user_id)
	{
		$user_id = (int) $user_id;
        $this->validate($user_id);
		$fields = [
			'date',
			'type',
			'reason'
		];
		
		$empty_fields = has_empty_post($fields);
		if ($empty_fields) 
		{	
			json_response(FALSE, 'Fill in the required fields', ['fields' => $empty_fields]);
		}
		
		$data = parse_data($_POST, $fields);

		if (strtotime($data['date']) < time())
		{
			json_response(FALSE, 'Date entered is already passed.');
		}

		$data['user_id'] = $user_id;

		$use_leave_credit = $this->input->post('use_leave_credit');
		if ($use_leave_credit)
		{
			if ( ! $this->Employees_model->has_leave($user_id))
			{
				json_response(FALSE, 'Employee doesn\'t have enough leave credit.');
			}
			$data['paid'] = 1;
		}

		try
		{
            $this->db->trans_start();
				
			$this->Employees_model->save('leave_requests', $data);

			if ($use_leave_credit)
			{
				$this->Employees_model->deduct_leave($user_id);
			}

			$this->db->trans_complete();
        }
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, 'Saved successfully', $user_id);
	}

	public function account_disable($user_id)
	{
		$user_id = (int) $user_id;
		$this->validate($user_id);

		$disabled = $this->input->post('disabled');

		if ( ! in_array($disabled, [0, 1]))
		{
			json_response(FALSE, 'Invalid data', $user_id);
		}
		
		$data = [];
		$data['disabled'] = $disabled;
		
		$this->Employees_model->update('users', $data, ['id' => $user_id]);
		
        json_response(TRUE, 'Saved successfully', $user_id);
	}

	public function save_picture($user_id)
	{
		$user_id = (int) $user_id;
		$this->validate($user_id);
		
		
		if (empty($this->input->post('file')))
		{
			json_response(FALSE, 'Please select file.');
		}
		
		$user = $this->Employees_model->get('users', ['id' => $user_id], 'avatar');

		if ($user->avatar && file_exists('./uploads/'. $user->avatar)) 
		{
			unlink('./uploads/'. $user->avatar);
		}

		$data = [];
		$data['avatar'] = $this->upload_avatar($this->input->post('file'));

		$this->save_data('users', $data, ['id' => $user_id]);

        json_response(TRUE, 'Profile picture saved successfully', $user_id);
	}
	
	private function upload_avatar($file) 
	{
		$split = explode( '/', $file );
		$file_ext = explode( ';', $split[1] )[0];
		$filename = md5(uniqid().time()) . '.' . $file_ext; 
		$filepath = './uploads/';
		$img = file_put_contents($filepath.$filename, base64_decode(explode(',',$file)[1]));
		return $filename;
	}
}

