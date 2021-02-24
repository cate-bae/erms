<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Upload_attendance extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
        $this->load->model(['Employees_model']);
        
    }

    public function employee_attendance($user_id)
    {
        $user_data = $this->Employees_model->get('users', ['id' => $user_id], 'biometrics_id');
        if (empty((int) $user_data->biometrics_id))
        {
            json_response(TRUE, 'Please provide employee\'s biometrics id before uploading.');
        }

        $file = upload_file('xlsx');

        $spreadsheet = IOFactory::load('uploads/'.$file);;

        $spreadsheet->setActiveSheetIndex(0);

        $worksheet = $spreadsheet->getActiveSheet();

        $biometrics_id = trim($worksheet->getCell('B3')->getValue());

		if (empty($worksheet))
		{
			$this->response_header_incorrect();
		}

		if ( ! $this->is_header_correct($worksheet, [
            'A' => 'Date',
            'B' => 'Day',
            'C' => 'Time In',
            'D' => 'Break',
            'E' => 'Resume',
            'F' => 'Time Out'
        ]))
		{
			$this->response_header_incorrect();
		}

        $data = $this->get_attendance_data($worksheet);

        if (empty($data))
        {
            json_response(FALSE, 'No attendance to save');
        }
		
        unlink('uploads/'.$file);

        $user_data = $this->Employees_model->get('users', ['id' => $user_id], 'biometrics_id');
        if ($user_data->biometrics_id != $biometrics_id)
        {
            json_response(FALSE, $biometrics_id.' is not employees biometrics id.');
        }
        
        $this->save_attendance($user_id, $data);

        json_response(TRUE, 'Saved successfully');
    }

    private function save_attendance($user_id, $data)
    {
        $insert_data = [];
        $update_data = [];
        foreach ($data as $value)
        {
            if (empty($value['A']))
            {
                continue;
            }

            if ( ! empty($this->Employees_model->get('attendance', ['user_id' => $user_id, 'date' => trim($value['A'])])))
            {
                $update_data = [
                    'day'      => trim(issetor($value['B'])),
                    'time_in'  => trim(issetor($value['C'])),
                    'break'    => trim(issetor($value['D'])),
                    'resume'   => trim(issetor($value['E'])),
                    'time_out' => trim(issetor($value['F']))
                ];
                $this->Employees_model->update('attendance', $update_data, [
                    'user_id' => $user_id,
                    'date'    => trim(issetor($value['A']))
                ]);
                continue;
            }

            $insert_data[] = [
                'user_id'  => $user_id,
                'date'     => trim(issetor($value['A'])),
                'day'      => trim(issetor($value['B'])),
                'time_in'  => trim(issetor($value['C'])),
                'break'    => trim(issetor($value['D'])),
                'resume'   => trim(issetor($value['E'])),
                'time_out' => trim(issetor($value['F']))
            ];
        }
        
        $this->Employees_model->save_multiple('attendance', $insert_data);
    }

    private function get_attendance_data($worksheet)
    {
		$highestRow = $worksheet->getHighestRow();
        for ($row = 5; $row <= $highestRow; $row++)
		{
            $row_value = [];
            
            foreach (range('A', 'F') as $column)
            {
                $value = $worksheet->getCell($column.''.$row)->getValue();
                if ( ! empty(trim($value)))
                {
                    $row_value[$column] = trim($value);
                }
            }
            if ( ! empty($row_value))
            {
                $data[] = $row_value;
            }
        }
        return $data;
    }

    private function is_header_correct($worksheet, $headers = [])
    {
        foreach (range('A', 'F') as $column)
        {
            if ($headers[$column] != $worksheet->getCell($column.'4')->getValue())
            {
                return FALSE;
            }
        }

        return TRUE;
    }

    private function response_header_incorrect()
    {
        json_response(FALSE, 'Incorrect headers');
    }
}