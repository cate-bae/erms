<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Tcpdf;
use PhpOffice\PhpSpreadsheet\Helper\Html as HtmlHelper;

class Print_pds extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
        $this->load->model(['Employees_model', 'Account_model']);
        
	}

	public function index($user_id = 0)
	{
        $spreadsheet = IOFactory::load('assets\excel\PDS2017_template.xlsx');

        $wizard = new HtmlHelper();

        $html1 = "<font face='Wingdings 2' size='14'>£</font> Female    <font face='Wingdings 2' size='14'>R</font> Male";
        $richText = $wizard->toRichTextObject($html1);

        $spreadsheet->getActiveSheet()
        ->setCellValue('D10', $richText);
        
$html2 = '<p>
<font style="">
    100&deg;C is a hot temperature
</font>
<br>
<font color="#0080ff">
    10&deg;F is cold
</font>
</p>';
$richText = $wizard->toRichTextObject($html2);

$spreadsheet->getActiveSheet()
->setCellValue('D11', $richText);

        // $worksheet = $spreadsheet->getActiveSheet();
        // dd($worksheet->getCell('D10'));
        // $worksheet->getCell('D10')->setValue('John');
        // $worksheet->getCell('A2')->setValue('Smith');
        
        // $writer->save('assets\excel\PDS_Revised20171.xlsx');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="richtext.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        
        exit();
    }

    public function test()
    {
        $spreadsheet = IOFactory::load('assets\excel\PDS2017_template.xlsx');

        $worksheet = $spreadsheet->getActiveSheet(0);
        $worksheet->setCellValue('D10', 'Firstname');

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="test.xlsx"');
        header('Cache-Control: max-age=0');
		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save( 'php://output' );
        exit;
    }

    public function pdf()
    {        
        $spreadsheet = IOFactory::load('assets\excel\PDS2017_template.xlsx');

        $worksheet = $spreadsheet->getActiveSheet(0);
        $worksheet->setCellValue('D10', 'Firstname');


        IOFactory::registerWriter('Pdf', Tcpdf::class);

        // Redirect output to a client’s web browser (PDF)
        // header('Content-Type: application/pdf');
        // header('Content-Disposition: attachment;filename="01simple.pdf"');
        // header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Pdf');
        $writer->writeAllSheets();
        $writer->save('php://output');
        exit;
    }


}
