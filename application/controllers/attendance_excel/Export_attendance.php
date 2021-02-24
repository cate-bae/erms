<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class Export_attendance extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
        $this->load->model(['Employees_model']);
        
    }

    private function set_header($worksheet, $info)
    {
        $worksheet->mergeCells('A1:F1');
        $worksheet->setCellValue('A1', 'EMPLOYEE ATTENDANCE');

        $worksheet->setCellValue('A2', 'Employee Name:');
        $worksheet->mergeCells('B2:F2');
        $worksheet->setCellValue('B2', strtoupper($info->first_name . ' ' . $info->last_name));

        $worksheet->setCellValue('A3', 'Biometrics ID:');
        $worksheet->mergeCells('B3:C3');
        $worksheet->setCellValue('B3', $info->biometrics_id);
        $worksheet->setCellValue('D3', 'Department:');
        $worksheet->mergeCells('E3:F3');
        $worksheet->setCellValue('E3', $info->department_name);

        $worksheet->setCellValue('A4', 'Date');
        $worksheet->setCellValue('B4', 'Day');
        $worksheet->setCellValue('C4', 'Time In');
        $worksheet->setCellValue('D4', 'Break');
        $worksheet->setCellValue('E4', 'Resume');
        $worksheet->setCellValue('F4', 'Time Out');

        $style = [
            'alignment' => ['horizontal' => 'center'],
            'font'      => ['bold' => true, 'size' => 12]
        ];

        $worksheet->getStyle("A1")->applyFromArray($style);
        $worksheet->getStyle("A4:F4")->applyFromArray($style);
        
        $text_bold = ['font' => ['bold' => true]];

        $worksheet->getStyle("A2")->applyFromArray($text_bold);
        $worksheet->getStyle("A3")->applyFromArray($text_bold);
        $worksheet->getStyle("D3")->applyFromArray($text_bold);

        foreach (range('A', 'F') as $columnID)
        {
            $worksheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }

    private function download_file($spreadsheet, $file_name = 'Employee Attendance')
    {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$file_name.'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function employee_template($user_id = 0)
    {
        if (empty($user_id))
        {
            $user_id = get_user_data()['id'];
        }

        $info = $this->Employees_model->get_info($user_id);

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0);
        $worksheet = $spreadsheet->getActiveSheet();

        $this->set_header($worksheet, $info);

        $worksheet->setCellValue('A5', date('m/d/Y'));
        $worksheet->setCellValue('B5', date('l'));
        $worksheet->setCellValue('C5', '08:00 AM');
        $worksheet->setCellValue('D5', '12:00 PM');
        $worksheet->setCellValue('E5', '01:00 PM');
        $worksheet->setCellValue('F5', '05:00 PM');

        $this->download_file($spreadsheet, 'Employee Attendance Template');
    }
    

    public function employee_attendance($user_id = 0, $from, $to)
    {
        if (empty($user_id))
        {
            $user_id = get_user_data()['id'];
        }

        if (empty($from) || empty($to))
        {
            json_response(FALSE, 'Please provide period of attendance.');
        }

        if (strtotime($from) > strtotime($to))
        {
            json_response(FALSE, 'Invalid period of attendance provided');
        }

        $info = $this->Employees_model->get_info($user_id);
        $data = $this->Employees_model->get_attendance_range($user_id, $from, $to);

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0);
        $worksheet = $spreadsheet->getActiveSheet();

        $this->set_header($worksheet, $info);

        $row = 5;
        foreach ($data as $attendance)
        {
            $worksheet->setCellValue("A{$row}", $attendance->date);
            $worksheet->setCellValue("B{$row}", $attendance->day);
            $worksheet->setCellValue("C{$row}", strtoupper($attendance->time_in));
            $worksheet->setCellValue("D{$row}", strtoupper($attendance->break));
            $worksheet->setCellValue("E{$row}", strtoupper($attendance->resume));
            $worksheet->setCellValue("F{$row}", strtoupper($attendance->time_out));

            $row++;
        }

        $this->download_file($spreadsheet, 'Employee Attendance ('.$info->biometrics_id.')');
    }

    private function set_header_all($worksheet)
    {
        $worksheet->mergeCells('A1:H1');
        $worksheet->setCellValue('A1', 'ATTENDANCE');

        $worksheet->setCellValue('A2', 'Biometrics ID');
        $worksheet->setCellValue('B2', 'Employee Name');
        $worksheet->setCellValue('C2', 'Date');
        $worksheet->setCellValue('D2', 'Day');
        $worksheet->setCellValue('E2', 'Time In');
        $worksheet->setCellValue('F2', 'Break');
        $worksheet->setCellValue('G2', 'Resume');
        $worksheet->setCellValue('H2', 'Time Out');

        $style = [
            'alignment' => ['horizontal' => 'center'],
            'font'      => ['bold' => true, 'size' => 12]
        ];

        $worksheet->getStyle("A1")->applyFromArray($style);
        $worksheet->getStyle("A2:H2")->applyFromArray($style);

        foreach (range('A', 'H') as $columnID)
        {
            $worksheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }

    public function attendance_template()
    {
        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0);
        $worksheet = $spreadsheet->getActiveSheet();

        $this->set_header_all($worksheet);        

        $worksheet->setCellValue('A3', '101');
        $worksheet->setCellValue('B3', 'John Doe');
        $worksheet->setCellValue('C3', date('m/d/Y'));
        $worksheet->setCellValue('D3', date('l'));
        $worksheet->setCellValue('E3', '08:00 AM');
        $worksheet->setCellValue('F3', '12:00 PM');
        $worksheet->setCellValue('G3', '01:00 PM');
        $worksheet->setCellValue('H3', '05:00 PM');

        $this->download_file($spreadsheet, 'Attendance Template');
    }

    public function attendance($from, $to)
    {
        if (empty($from) || empty($to))
        {
            json_response(FALSE, 'Please provide period of attendance.');
        }

        if (strtotime($from) > strtotime($to))
        {
            json_response(FALSE, 'Invalid period of attendance provided');
        }
        
        $this->load->model(['Attendance_model']);
        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0);
        $worksheet = $spreadsheet->getActiveSheet();

        $this->set_header_all($worksheet); 
        
        $attendances = $this->Attendance_model->all_range($from, $to);

        $row = 3;
        foreach ($attendances as $attendance)
        {
            $worksheet->setCellValue('A'.$row, $attendance->biometrics_id);
            $worksheet->setCellValue('B'.$row, strtoupper($attendance->employee_name));
            $worksheet->setCellValue('C'.$row, $attendance->date);
            $worksheet->setCellValue('D'.$row, date('l', strtotime($attendance->date)));
            $worksheet->setCellValue('E'.$row, strtoupper($attendance->time_in));
            $worksheet->setCellValue('F'.$row, strtoupper($attendance->break));
            $worksheet->setCellValue('G'.$row, strtoupper($attendance->resume));
            $worksheet->setCellValue('H'.$row, strtoupper($attendance->time_out));
            $row++;
        }

        $this->download_file($spreadsheet, 'Attendance Template');
    }
    
    public function validate()
    {
        $from = $this->input->post('from');
        $to   = $this->input->post('to');

        if (empty($from) || empty($to))
        {
            json_response(FALSE, 'Please provide dates.');
        }

        if (strtotime($from) > strtotime($to))
        {
            json_response(FALSE, 'Invalid date provided');
        }
        
        json_response(TRUE);
    }
}