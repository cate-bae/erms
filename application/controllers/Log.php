<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Attendance_model');
	}

	public function index()
	{
		$data['page_title'] = '';
		$data['nav_active'] = 'log';
		$data['page_js'] = [
			base_url('assets/js/attendance/log.js')
		];

		$user_id = get_user_data()['id'];

		$log = $this->Attendance_model->get(['user_id' => $user_id, 'date' => date('m/d/Y')]);
		if (empty($log))
		{
			$log_time = 'Time In';
		}
		else
		{
			$log_time = 'Break';
			if ( ! empty($log->break))
			{
				$log_time = 'Resume';
			}
			if ( ! empty($log->resume))
			{
				$log_time = 'Time out';
			}
			if (time() > strtotime(date('Y-m-d 17:00:00')))
			{
				$log_time = 'Time out';
			}
		}
		$page_data['log'] = $log;
		$page_data['log_time'] = $log_time;
		
		$data['body'] = $this->load->view('attendance/log', $page_data, true);
		$this->load->view('index', $data);
	}

	public function save_log()
	{
		$data = [
			'user_id' => get_user_data()['id'],
			'date'    => date('m/d/Y'),
			'day'     => date('l'),
			'time_in' => date('h:i a')
		];
		try 
		{
			$this->db->trans_start();
				
			$log = $this->Attendance_model->get(['user_id' => $data['user_id'], 'date' => $data['date']]);
			if( ! empty($log))
			{
				$log_time = 'break';
				if ( ! empty($log->break))
				{
					$log_time = 'resume';
				}
				if ( ! empty($log->resume))
				{
					$log_time = 'time_out';
				}
				if (time() > strtotime(date('Y-m-d 17:00:00')))
				{
					$log_time = 'time_out';
				}
				
				if ( ! in_array($log_time, ['break', 'resume', 'time_out']))
				{
					json_response(FALSE, 'Invalid log');
				}
				$this->Attendance_model->update_where([
					$log_time => date('h:i a')
				], ['user_id' => $data['user_id'], 'date' => $data['date']]);
			}
			else
			{
				$this->Attendance_model->create($data);
			}

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, 'Logged successfully');
	}

}

