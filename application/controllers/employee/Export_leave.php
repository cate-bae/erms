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
    }

    private function set_personal_info($worksheet)
    {
        $info = $this->Employees_model->get_general($this->user_id);
        $this->file_name = 'Leave_' . issetor($info->first_name) .'_'. issetor($info->last_name);

        $worksheet->setCellValue('D10', strtoupper(issetor($info->last_name)));
        $worksheet->setCellValue('I10', strtoupper(issetor($info->first_name) . ' ' . issetor($info->ext_name)));
        $worksheet->setCellValue('K10', strtoupper(issetor($info->middle_name)));

        $worksheet->setCellValue('B12', strtoupper(date('m/d/Y', strtotime(issetor($this->leave->create_time)))));
        $worksheet->setCellValue('D12', strtoupper(issetor($info->position_name)));

        $worksheet->setCellValue('D27', strtoupper(issetor($this->leave->date)));
        $worksheet->setCellValue('C28', strtoupper(issetor($this->leave->reason)));
    }

}
