<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Helper\Html as HtmlHelper;


class Export_leave extends CI_Controller 
{
    private $file_name = 'Leave';

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
        $this->load->model(['Employees_model', 'leaves/Leave_requests_model']);
        
	}

	public function index($leave_id = 0)
	{
        $this->leave = $this->Leave_requests_model->get(['id' => $leave_id]);
        $this->user_id = $this->leave->user_id;
        
        $spreadsheet = IOFactory::load('assets/excel/Leave_form.xlsx');

        $this->set_values($spreadsheet);

        $spreadsheet->setActiveSheetIndex(0);

        $writer = new Xlsx($spreadsheet);

        // redirect output to client browser

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$this->file_name.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');

        exit;
    }

    private function set_values($spreadsheet)
    {
        $this->set_page_1($spreadsheet);
    }

    private function set_page_1($spreadsheet)
    {
        $spreadsheet->setActiveSheetIndex(0);
        $worksheet = $spreadsheet->getActiveSheet();

        $this->set_personal_info($worksheet);
        $this->set_leave_info($worksheet);
    }

    private function set_personal_info($worksheet)
    {
        $info = $this->Employees_model->get_general($this->user_id);
        $this->file_name = 'Leave_' . issetor($info->first_name) .'_'. issetor($info->last_name);

        $worksheet->setCellValue('D10', strtoupper(issetor($info->last_name)));
        $worksheet->setCellValue('I10', strtoupper(issetor($info->first_name) . ' ' . issetor($info->ext_name)));
        $worksheet->setCellValue('K10', strtoupper(issetor($info->middle_name)));

        $worksheet->setCellValue('D12', strtoupper(issetor($info->position_name)));

    }

    private function set_leave_info($worksheet)
    {
        $leave = $this->leave;
        $worksheet->setCellValue('B10', strtoupper($leave->agency));
        $worksheet->setCellValue('B12', strtoupper(date('m/d/Y', strtotime($leave->date_filing))));
        $worksheet->setCellValue('K12', $leave->salary);

        if ($leave->type == 0)
        {
            $worksheet->setCellValue('B15', 'þ');
			if ($leave->type_vacation == 'To seek employment') 
			{
                $worksheet->setCellValue('C16', 'þ');
			}
			else if ($leave->type_vacation == 'Others (Specify)') 
			{
                $worksheet->setCellValue('C17', 'þ');
                $worksheet->setCellValue('D18', $leave->type_vacation_others);
			}

			if ($leave->location == 'Within the Philippines') 
			{
                $worksheet->setCellValue('I16', 'þ');
			}
			else if ($leave->location == 'Abroad (Specify)') 
			{
                $worksheet->setCellValue('I17', 'þ');
                $worksheet->setCellValue('D18', $leave->location_abroad);
			}
        }
        else if ($leave->type == 1)
        {
            $worksheet->setCellValue('B19', 'þ');
            if ($leave->location_sick == 1)
            {
                $worksheet->setCellValue('I20', 'þ');
                $worksheet->setCellValue('J22', $leave->location_sick_hospital);
            }
        }
        else if ($leave->type == 2)
        {
            $worksheet->setCellValue('B20', 'þ');
        }
        else if ($leave->type == 3)
        {
            $worksheet->setCellValue('B21', 'þ');
            if ($leave->type_others == 'CTO')
            {
                $worksheet->setCellValue('E21', 'þ');
            }
            else if ($leave->type_others == 'SPL')
            {
                $worksheet->setCellValue('E22', 'þ');
            }
            else if ($leave->type_others == 'Solo Parent')
            {
                $worksheet->setCellValue('E23', 'þ');
            }
        }

        $worksheet->setCellValue('B26', $leave->days);
        $worksheet->setCellValue('D27', $leave->date_from . ' - ' . $leave->date_to);
        $worksheet->setCellValue('C28', $leave->purpose);

        if ($leave->commutation == 'Requested')
        {
            $worksheet->setCellValue('I26', 'þ');
        }
        else if ($leave->commutation == 'Not Requested')
        {
            $worksheet->setCellValue('K26', 'þ');
        }

        $worksheet->setCellValue('C35', $leave->leave_credits_as_of);
        $worksheet->setCellValue('B39', $leave->vacation);
        $worksheet->setCellValue('C39', $leave->sick);
        $worksheet->setCellValue('D39', $leave->cto);
        $worksheet->setCellValue('E39', $leave->spl);
        $worksheet->setCellValue('F39', $leave->solo_parent);

        if ($leave->recommendation == 'Approval')
        {
            $worksheet->setCellValue('I37', 'þ');
            $worksheet->setCellValue('B49', $leave->days_with_pay);
            $worksheet->setCellValue('B50', $leave->days_without_pay);
        }
        else if ($leave->recommendation == 'Disapproval')
        {
            $worksheet->setCellValue('I39', 'þ');
            $worksheet->setCellValue('J40', $leave->disapproval_reason);
            $worksheet->setCellValue('I49', $leave->disapproved_reason);
        }

        $employees = set_key_obj($this->Employees_model->get_leave_employees([$leave->dept_head_id, $leave->authorized_officer_id]), 'id');
        if ($leave != '')
        {
            if (isset($employees[$leave->dept_head_id]))
            {
                $worksheet->setCellValue('I44', get_name($employees[$leave->dept_head_id]));
                $worksheet->setCellValue('I45', $employees[$leave->dept_head_id]->position_name);
            }
            if (isset($employees[$leave->authorized_officer_id]))
            {
                $worksheet->setCellValue('D53', get_name($employees[$leave->authorized_officer_id]));
                $worksheet->setCellValue('E54', $employees[$leave->authorized_officer_id]->position_name);
            }
        }
    }

}
