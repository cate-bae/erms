<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model(['Employees_model', 'Account_model']);
	}

	public function index()
	{
		if ( ! in_array(get_user_type(), [-1, 0])) // super, admin
		{
			show_404();
		}

		$data['page_title'] = 'Employees';
		$data['nav_active'] = 'employees';
		$data['page_js'] = [
			base_url('assets/plugins/jquery-datatable/jquery.dataTables.js'),
			base_url('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'),
			base_url('assets/js/pages/tables.js'),
			base_url('assets/js/employees/list.js')
		];

		$page_data['list'] = $this->Employees_model->all();
		$page_data['job_status'] = get_all_job_status();
		$page_data['employment_status'] = get_all_employment_status();


		$data['body'] = $this->load->view('employees/list', $page_data, true);
		$this->load->view('index', $data);
	}

	public function create($user_id = 0)
	{
		if ( ! in_array(get_user_type(), [-1, 0])) // super, admin
		{
			$user_id = (int) get_user_data()['id'];
		}
		if (empty($user_id))
		{
			show_404();
		}

		$data['page_title'] = $user_id != (int) get_user_data()['id'] ? "Employee's Personal Data" : "Please Fill Up Your Personal Data";

		$data['nav_active'] = 'employees';
		$data['page_js'] = [
			base_url('assets/js/helpers.js'),
			base_url('assets/js/employees/create.js'),
			base_url('assets/js/pages/jquery-steps/jquery.steps.js'),
			base_url('assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js')
		];

		$create_data = [
			'user_id'       => $user_id
		];
		$create_data['create'] = [
			'personal'      => $this->load->view('employees/create/personal', NULL, true),
			'family'        => $this->load->view('employees/create/family', NULL, true),
			'education'     => $this->load->view('employees/create/education', NULL, true),
			'civil_service' => $this->load->view('employees/create/civil_service', NULL, true),
			'experience'    => $this->load->view('employees/create/work_experience', NULL, true),
			'voluntary'     => $this->load->view('employees/create/voluntary_work', NULL, true),
			'training'      => $this->load->view('employees/create/trainings', NULL, true),
			'other_info'    => $this->load->view('employees/create/other_info', NULL, true),
			'questions'     => $this->load->view('employees/create/questions', NULL, true),
			'references'    => $this->load->view('employees/create/references', NULL, true),
			'agreement'     => $this->load->view('employees/create/agreement', NULL, true)
		];
		$data['body'] = $this->load->view('employees/create', $create_data, true);
		$this->load->view('index', $data);
	}

	public function view($user_id = 0, $view = 'general')
	{
		if (empty($user_id))
		{
			$user_id = (int) get_user_data()['id'];
		}
		if ( ! in_array(get_user_type(), [-1, 0]) && $user_id != (int) get_user_data()['id']) // super, admin
		{
			show_404();
		}

		if ( ! in_array(get_user_type(), [-1, 0]) && $user_id == (int) get_user_data()['id'] && ! $this->Account_model->has_profile_data($user_id))
		{
			redirect(base_url() . 'Employees/create');
		}

		$data['page_title'] = 'Profile';
		if ( ! in_array(get_user_type(), [-1, 0]))
		{
			$data['page_title'] = get_page_title($view);
		}

		$data['nav_active'] = $user_id == (int) get_user_data()['id'] ? 'my_profile' : 'employees';

		$data['page_js'] = [
			base_url('assets/plugins/jquery-datatable/jquery.dataTables.js'),
			base_url('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'),
			base_url('assets/js/pages/tables.js'),
			base_url("assets/js/employees/view/{$view}.js"),
			base_url('assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js')
		];

		$page_data['employee'] = $this->Employees_model->get_info($user_id);
		if ( ! $page_data['employee'])
		{
			show_404();
		}

		if ($page_data['employee']->avatar && file_exists('./uploads/'. $page_data['employee']->avatar)) 
		{
			$page_data['employee']->avatar = base_url('./uploads/'. $page_data['employee']->avatar);
		} 
		else 
		{
			$page_data['employee']->avatar = get_default_avatar();
		}

		$page_data['user_id'] = $user_id;
		$page_data['view_active'] = $view;

		$view_data = [
			'user_id'    => $user_id,
			'info'       => $this->get_information($user_id, $view),
			'page_title' => get_page_title($view)
		];

		if ($view == 'attendance')
		{
			$view_data['biometrics_id'] = $this->Employees_model->get_biometrics_id($user_id);
		}

		$page_data['view_page'] = $this->load->view('employees/view/'.$view, $view_data, true);

		$data['body'] = $this->load->view('employees/view', $page_data, true);

		$data['sub_nav_active'] = $view;
		$this->load->view('index', $data);
	}

	public function add()
	{
		$user_id = (int) $this->input->post('user_id');
		if (empty($user_id)) 
		{
			json_response(FALSE, 'Please create employee\'s account first.');
		}

		$user_info = $this->Account_model->get(['id' => $user_id]);
		if (empty($user_info)) 
		{
			json_response(FALSE, 'Please create employee\'s account first.');
		}
		$profile_info = $this->Employees_model->get('profile', ['user_id' => $user_id]);
		if ( ! empty($profile_info)) 
		{
			json_response(FALSE, 'Employee already have personal data. <p>If you intend to update, please go to employee\'s profile. </p>');
		}

		try 
		{
			$this->db->trans_begin();

			$this->user_id = $user_id;

			$this->save_profile();

			$this->save_address();

			$this->save_family();

			$this->save_education();

			$this->save_civil_service();

			$this->save_experience();

			$this->save_voluntary_work();

			$this->save_training();

			$this->save_answers();

			$this->save_reference();

			$this->db->trans_commit();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, 'Personal data saved successfully', $user_id);
	}

	public function save_profile()
	{
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

		if (has_empty_post($required_fields)) 
		{	
			json_response(FALSE, 'Fill in the required fields');
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
			json_response(FALSE, 'Fill in the required fields', [ 'page' => 0, 'fields' => $error_fields]);
		}

		$data['user_id'] = $this->user_id;

		$data['birth_day'] = date('Y-m-d', strtotime($data['birth_day']));
		$this->Employees_model->save('profile', $data);
	}

	public function save_address()
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
		
		$insert = array_group_by_index($data);

		$user_id = $this->user_id;
		$insert_data = [];
		foreach ($insert as $type => $value) 
		{
			$value['user_id'] = $user_id;
			$value['type'] = $type;
			$insert_data[] = $value;
		}

		$this->Employees_model->save_multiple('address', $insert_data);
	}

	public function save_family()
	{
		$user_id = $this->user_id;
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
		
		if (array_has_value($spouse))
		{
			$spouse_value = [
				'user_id' => $user_id
			];
			foreach ($spouse as $key => $value)
			{
				$spouse_value[str_replace('spouse_', '', $key)] = trim($value);
			}
			$this->Employees_model->save('spouse', $spouse_value);
		}

		/** FATHER */
		$father_fields = [
			'father_surname',
			'father_first_name',
			'father_ext_name',
			'father_middle_name'
		];
		$father = parse_data($_POST, $father_fields);

		if (array_has_value($father))
		{
			$father_value = [
				'user_id' => $user_id,
				'type'    => 0
			];
			foreach ($father as $key => $value)
			{
				$father_value[str_replace('father_', '', $key)] = trim($value);
			}

			$this->Employees_model->save('parent', $father_value);
		}

		/** MOTHER */
		$mother_fields = [
			'mother_maiden_name',
			'mother_surname',
			'mother_first_name',
			'mother_middle_name'
		];
		$mother = parse_data($_POST, $mother_fields);
		
		if (array_has_value($mother))
		{
			$mother_value = [
				'user_id' => $user_id,
				'type'    => 1
			];
			foreach ($mother as $key => $value)
			{
				$mother_value[str_replace('mother_', '', $key)] = trim($value);
			}

			$this->Employees_model->save('parent', $mother_value);
		}

		/** CHILDREN */
		$children_fields = [
			'children_name',
			'children_birth_day'
		];

		$children = parse_data($_POST, $children_fields);
		$children = array_group_by_index($children);

		$insert_data = [];
		
		foreach ($children as $index => $child) 
		{
			if ( ! array_has_value($child)) continue;

			$insert = [
				'user_id' => $user_id
			];
			foreach ($child as $key => $value)
			{
				$insert[str_replace('children_', '', $key)] = $value;
			}
			$insert_data[] = $insert;
		}

		$this->Employees_model->save_multiple('children', $insert_data);
	}

	public function save_education()
	{
		$fields = [
			'edu_level',
			'edu_school',
			'edu_course',
			'edu_from',
			'edu_to',
			'edu_units',
			'edu_year',
			'edu_honors'
		];
		
		$data = parse_data($_POST, $fields);

		$educations = array_group_by_index($data);

		$user_id = $this->user_id;
		$insert_data = [];
		foreach ($educations as $index => $education) 
		{
			if ( ! array_has_value($education)) continue;
			
			$insert = [
				'user_id' => $user_id
			];

			foreach ($education as $key => $value)
			{
				$insert[str_replace('edu_', '', $key)] = $value;
			}
			$insert_data[] = $insert;
		}
		$this->Employees_model->save_multiple('education', $insert_data);
	}

	public function save_civil_service()
	{
		$fields = [
			'civil_title',
			'civil_rating',
			'civil_date',
			'civil_place',
			'civil_license',
			'civil_validity'
		];

		$data = parse_data($_POST, $fields);

		$services = array_group_by_index($data);

		$user_id = $this->user_id;
		$insert_data = [];
		foreach ($services as $index => $service) 
		{
			if ( ! array_has_value($service)) continue;

			$insert = [
				'user_id' => $user_id
			];

			foreach ($service as $key => $value)
			{
				$insert[str_replace('civil_', '', $key)] = $value;
			}
			$insert_data[] = $insert;
		}
		$this->Employees_model->save_multiple('civil_service', $insert_data);
	}

	public function save_experience()
	{
		$fields = [
			'experience_from',
			'experience_to',
			'experience_position',
			'experience_department',
			'experience_salary',
			'experience_salary_grade',
			'experience_status',
			'experience_govt'
		];
		
		$data = parse_data($_POST, $fields);

		$experiences = array_group_by_index($data);

		$user_id = $this->user_id;
		$insert_data = [];
		foreach ($experiences as $index => $experience) 
		{
			if ( ! array_has_value($experience)) continue;

			$insert = [
				'user_id' => $user_id
			];

			foreach ($experience as $key => $value)
			{
				$insert[str_replace('experience_', '', $key)] = $value;
			}
			$insert_data[] = $insert;
		}
		$this->Employees_model->save_multiple('work_experience', $insert_data);
	}

	public function save_voluntary_work()
	{
		$fields = [
			'voluntary_name',
			'voluntary_from',
			'voluntary_to',
			'voluntary_hours',
			'voluntary_position'
		];
		
		$data = parse_data($_POST, $fields);

		$works = array_group_by_index($data);

		$user_id = $this->user_id;
		$insert_data = [];
		foreach ($works as $index => $work) 
		{
			if ( ! array_has_value($work)) continue;

			$insert = [
				'user_id' => $user_id
			];

			foreach ($work as $key => $value)
			{
				$insert[str_replace('voluntary_', '', $key)] = $value;
			}
			$insert_data[] = $insert;
		}
		
		$this->Employees_model->save_multiple('voluntary_work', $insert_data);
	}

	public function save_training()
	{
		$fields = [
			'training_title',
			'training_from',
			'training_to',
			'training_hours',
			'training_type',
			'training_sponsor'
		];
		
		$data = parse_data($_POST, $fields);

		$trainings = array_group_by_index($data);

		$user_id = $this->user_id;
		$insert_data = [];
		foreach ($trainings as $index => $training) 
		{
			if ( ! array_has_value($training)) continue;

			$insert = [
				'user_id' => $user_id
			];

			foreach ($training as $key => $value)
			{
				$insert[str_replace('training_', '', $key)] = $value;
			}
			$insert_data[] = $insert;
		}

		$this->Employees_model->save_multiple('trainings', $insert_data);
	}

	public function save_other_info()
	{
		$fields = [
			'skill'
		];
		
		$data = parse_data($_POST, $fields);

		$user_id = $this->user_id;
		$insert_data = [];
		foreach ($data as $skill) 
		{
			if ( ! trim($skill)) continue;

			$insert = [
				'user_id' => $user_id,
				'skill'   => $skill
			];

			$insert_data[] = $insert;
		}

		$this->Employees_model->save_multiple('skill', $insert_data);

		
		$fields = [
			'recognition'
		];
		
		$data = parse_data($_POST, $fields);

		$user_id = $this->user_id;
		$insert_data = [];
		foreach ($data as $recognition) 
		{
			if ( ! trim($recognition)) continue;

			$insert = [
				'user_id' => $user_id,
				'name'   => $recognition
			];

			$insert_data[] = $insert;
		}

		$this->Employees_model->save_multiple('recognition', $insert_data);

		
		$fields = [
			'membership'
		];
		
		$data = parse_data($_POST, $fields);

		$user_id = $this->user_id;
		$insert_data = [];
		foreach ($data as $membership) 
		{
			if ( ! trim($membership)) continue;

			$insert = [
				'user_id' => $user_id,
				'name'   => $membership
			];

			$insert_data[] = $insert;
		}

		$this->Employees_model->save_multiple('membership', $insert_data);
	}

	public function save_answers()
	{
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

		$this->Employees_model->save('questions', $data);
	}

	public function save_reference()
	{
		$fields = [
			'reference_name',
			'reference_address',
			'reference_telephone'
		];

		$data = parse_data($_POST, $fields);

		$references = array_group_by_index($data);

		$user_id = $this->user_id;
		$insert_data = [];
		foreach ($references as $index => $reference) 
		{
			if ( ! array_has_value($reference)) continue;

			$insert = [
				'user_id' => $user_id
			];

			foreach ($reference as $key => $value)
			{
				$insert[str_replace('reference_', '', $key)] = $value;
			}
			$insert_data[] = $insert;
		}

		$this->Employees_model->save_multiple('references', $insert_data);
	}

	public function get_information($user_id, $view)
	{
		switch ($view) {
			case 'general':
				$this->load->model(['Departments_model', 'Positions_model']);
				$data = $this->Employees_model->get_general($user_id);
				$data->departments = $this->Departments_model->all();
				$data->positions = $this->Positions_model->all();
				return $data;

			case 'personal':
				return $this->Employees_model->get_personal($user_id);
			
			case 'family':
				return $this->Employees_model->get_family($user_id);
			
			case 'education':
				return $this->Employees_model->get_education($user_id);

			case 'civil_service':
				return $this->Employees_model->get_civil_service($user_id);

			case 'work_experience':
				return $this->Employees_model->get_work_experience($user_id);

			case 'voluntary_work':
				return $this->Employees_model->get_voluntary_work($user_id);

			case 'trainings':
				return $this->Employees_model->get_trainings($user_id);

			case 'other_info':
				return $this->Employees_model->get_other_info($user_id);

			case 'questions':
			case 'edit_questions':
				return $this->Employees_model->get_questions($user_id);

			case 'references':
				return $this->Employees_model->get_references($user_id);

			case 'agreement':
				return $this->Employees_model->get_agreement($user_id);

			case 'benefits':
				$this->load->model(['Benefits_model']);
				$benefits = $this->Benefits_model->all();
				return [
					'can_have_benefits' => $this->Employees_model->get('users', ['id' => $user_id], 'job_status')->job_status == 1,
					'user_benefits'     => $this->Employees_model->get_benefits($user_id),
					'benefits'          => empty($benefits) ? [] : set_key_obj($benefits, 'id')
				];

			case 'attendance':
				$data = $this->Employees_model->get_attendance($user_id);
				return $data;

			case 'leaves':
				// $this->load->model('leaves/Leave_types_model', 'Leave_types_model');
				$this->Employees_model->generate_leave($user_id);
				$data = [
					'leaves'     => $this->Employees_model->get_leaves($user_id),
					'leave_info' => $this->Employees_model->get_leave_info($user_id),
					'general'    => $this->Employees_model->get_general($user_id)
				];
				return $data;
	
			default:
				return [];
		}
	}

}

