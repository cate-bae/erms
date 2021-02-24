<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Helper\Html as HtmlHelper;


class Export_pds extends CI_Controller 
{
    private $file_name = 'PDS';

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
        $this->load->model(['Employees_model']);
        
	}

	public function index($user_id = 0)
	{
        $this->user_id = empty($user_id) ? (int) get_user_data()['id'] : $user_id;
        
        $spreadsheet = IOFactory::load('assets/excel/PDS2017_template.xlsx');

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

        $this->set_page_2($spreadsheet);

        $this->set_page_3($spreadsheet);

        $this->set_page_4($spreadsheet);

    }

    private function set_page_1($spreadsheet)
    {
        $spreadsheet->setActiveSheetIndex(0);
        $worksheet = $spreadsheet->getActiveSheet();

        $this->set_personal_info($worksheet);
        $this->set_family($worksheet);
        $this->set_education($worksheet);
    }

    private function set_page_2($spreadsheet)
    {
        $spreadsheet->setActiveSheetIndex(1);
        $worksheet = $spreadsheet->getActiveSheet();

        $this->set_civil_service($worksheet);
        $this->set_work_experience($worksheet);
    }

    private function set_page_3($spreadsheet)
    {
        $spreadsheet->setActiveSheetIndex(2);
        $worksheet = $spreadsheet->getActiveSheet();

        $this->set_voluntary_work($worksheet);
        $this->set_trainings($worksheet);
        $this->set_other_info($worksheet);
    }

    private function set_page_4($spreadsheet)
    {
        $spreadsheet->setActiveSheetIndex(3);
        $worksheet = $spreadsheet->getActiveSheet();

        $this->set_answers($worksheet);
        $this->set_references($worksheet);
        $this->set_agreement($worksheet);
    }

    private function set_personal_info($worksheet)
    {
        $info = $this->Employees_model->get_personal($this->user_id);
        $this->file_name = 'PDS_' . issetor($info['personal']->first_name) .'_'. issetor($info['personal']->last_name);

        $worksheet->setCellValue('D10', strtoupper(issetor($info['personal']->last_name)));
        $worksheet->setCellValue('D11', strtoupper(issetor($info['personal']->fist_name)));
        $worksheet->setCellValue('L11', strtoupper("NAME EXTENSION (JR., SR)\n".issetor($info['personal']->ext_name)));
        $worksheet->setCellValue('D12', strtoupper(issetor($info['personal']->middle_name)));

        $worksheet->setCellValue('D13', strtoupper(date('m/d/Y', strtotime(issetor($info['personal']->birth_day)))));
        $worksheet->setCellValue('D15', strtoupper(issetor($info['personal']->birth_place)));
        
        $sex = issetor($info['personal']->sex);
        $sexHtml = '';
        if ($sex == 'Male')
        {
            $sexHtml = "<font face='Wingdings 2' size='14'>R</font>&nbsp;<font face='Arial Narrow' size='10'>Male</font> &nbsp;&nbsp;&nbsp;&nbsp; <font face='Wingdings 2' size='14'>£</font>&nbsp;<font face='Arial Narrow' size='10'>Female</font>";
        }
        else if ($sex == "Female")
        {
            $sexHtml = "<font face='Wingdings 2' size='14'>£</font>&nbsp;<font face='Arial Narrow' size='10'>Male</font> &nbsp;&nbsp;&nbsp;&nbsp; <font face='Wingdings 2' size='14'>R</font>&nbsp;<font face='Arial Narrow' size='10'>Female</font>";
        }
        $wizard = new HtmlHelper();
        $sexText = $wizard->toRichTextObject($sexHtml);
        // $worksheet->setCellValue('D16', strtoupper(issetor($info['personal']->sex)));
        $worksheet->setCellValue('D16', $sexText);

        $worksheet->setCellValue('D17', strtoupper(issetor($info['personal']->civil_status)));
        if (issetor($info['personal']->civil_status) == 'Other/s')
        {
            $worksheet->setCellValue('D17', strtoupper(issetor($info['personal']->civil_status).': '.issetor($info['personal']->civil_others)));
            // $worksheet->setCellValue('E20', strtoupper(issetor($info['personal']->civil_others)));
        }
        $worksheet->setCellValue('D22', strtoupper(issetor($info['personal']->height)));
        $worksheet->setCellValue('D24', strtoupper(issetor($info['personal']->weight)));
        $worksheet->setCellValue('D25', strtoupper(issetor($info['personal']->blood_type)));

        $worksheet->setCellValue('D27', strtoupper(issetor($info['personal']->gsis)));
        $worksheet->setCellValue('D29', strtoupper(issetor($info['personal']->pagibig)));
        $worksheet->setCellValue('D31', strtoupper(issetor($info['personal']->philhealth)));
        $worksheet->setCellValue('D32', strtoupper(issetor($info['personal']->sss)));
        $worksheet->setCellValue('D33', strtoupper(issetor($info['personal']->tin)));
        $worksheet->setCellValue('D34', strtoupper(issetor($info['personal']->agency_employee_no)));

        $phHtml        = "<font face='Wingdings 2' size='14'>£</font>&nbsp;<font face='Arial Narrow' size='10'>Filipino</font>";
        $dualHtml      = "<font face='Wingdings 2' size='14'>£</font>&nbsp;<font face='Arial Narrow' size='10'>Dual Citizenship</font>";
        $phCheckHtml   = "<font face='Wingdings 2' size='14'>R</font>&nbsp;<font face='Arial Narrow' size='10'>Filipino</font>";
        $dualCheckHtml = "<font face='Wingdings 2' size='14'>R</font>&nbsp;<font face='Arial Narrow' size='10'>Dual Citizenship</font>";
        
        $wizard        = new HtmlHelper();
        $phText        = $wizard->toRichTextObject($phHtml);
        $dualText      = $wizard->toRichTextObject($dualHtml);
        $phCheckText   = $wizard->toRichTextObject($phCheckHtml);
        $dualCheckText = $wizard->toRichTextObject($dualCheckHtml);
        
        $worksheet->setCellValue('J13', issetor($info['personal']->citizenship) == 'Filipino' ? $phCheckText : $phText);
        $worksheet->setCellValue('L13', issetor($info['personal']->citizenship) == 'Dual Citizenship' ? $dualCheckText : $dualText);

        $noneDualHtml   = "<font face='Wingdings 2' size='14'>£</font>&nbsp;<font face='Arial Narrow' size='10'>by birth</font><font face='Wingdings 2' size='14'>£</font>&nbsp;<font face='Arial Narrow' size='10'>by naturalization</font>";

        if (issetor($info['personal']->dual_citizenship) == 'by birth')
        {
            $dualHtml        = "<font face='Wingdings 2' size='14'>R</font>&nbsp;<font face='Arial Narrow' size='10'>by birth</font><font face='Wingdings 2' size='14'>£</font>&nbsp;<font face='Arial Narrow' size='10'>by naturalization</font>";
        }
        elseif (issetor($info['personal']->dual_citizenship) == 'by naturalization')
        {
            $dualHtml      = "<font face='Wingdings 2' size='14'>£</font>&nbsp;<font face='Arial Narrow' size='10'>by birth</font><font face='Wingdings 2' size='14'>R</font>&nbsp;<font face='Arial Narrow' size='10'>by naturalization</font>";
        }
        else
        {
            $dualHtml   = "<font face='Wingdings 2' size='14'>£</font>&nbsp;<font face='Arial Narrow' size='10'>by birth</font><font face='Wingdings 2' size='14'>£</font>&nbsp;<font face='Arial Narrow' size='10'>by naturalization</font>";
        }
        $dualText = $wizard->toRichTextObject($dualHtml);
        $worksheet->setCellValue('L14', $dualText);
        
        $worksheet->setCellValue('J16', strtoupper(issetor($info['personal']->country)));

        $worksheet->setCellValue('I17', strtoupper(issetor($info['address'][0]->house_no)));
        $worksheet->setCellValue('L17', strtoupper(issetor($info['address'][0]->street)));
        $worksheet->setCellValue('I19', strtoupper(issetor($info['address'][0]->subdivision)));
        $worksheet->setCellValue('L19', strtoupper(issetor($info['address'][0]->barangay)));
        $worksheet->setCellValue('I22', strtoupper(issetor($info['address'][0]->municipality)));
        $worksheet->setCellValue('L22', strtoupper(issetor($info['address'][0]->province)));
        $worksheet->setCellValue('I24', strtoupper(issetor($info['address'][0]->zip)));

        $worksheet->setCellValue('I25', strtoupper(issetor($info['address'][1]->house_no)));
        $worksheet->setCellValue('L25', strtoupper(issetor($info['address'][1]->street)));
        $worksheet->setCellValue('I27', strtoupper(issetor($info['address'][1]->subdivision)));
        $worksheet->setCellValue('L27', strtoupper(issetor($info['address'][1]->barangay)));
        $worksheet->setCellValue('I29', strtoupper(issetor($info['address'][1]->municipality)));
        $worksheet->setCellValue('L29', strtoupper(issetor($info['address'][1]->province)));
        $worksheet->setCellValue('I31', strtoupper(issetor($info['address'][1]->zip)));

        $worksheet->setCellValue('I32', strtoupper(issetor($info['personal']->telephone)));
        $worksheet->setCellValue('I33', strtoupper(issetor($info['personal']->mobile)));
        $worksheet->setCellValue('I34', strtoupper(issetor($info['personal']->email)));
    }

    private function set_family($worksheet)
    {
        $info = $this->Employees_model->get_family($this->user_id);
        
        $worksheet->setCellValue('D36', strtoupper(issetor($info['spouse']->surname)));
        $worksheet->setCellValue('D37', strtoupper(issetor($info['spouse']->first_name)));
        $worksheet->setCellValue('G37', strtoupper("NAME EXTENSION (JR., SR)\n".issetor($info['spouse']->ext_name)));
        $worksheet->setCellValue('D38', strtoupper(issetor($info['spouse']->middle_name)));
        $worksheet->setCellValue('D39', strtoupper(issetor($info['spouse']->occupation)));
        $worksheet->setCellValue('D40', strtoupper(issetor($info['spouse']->business)));
        $worksheet->setCellValue('D41', strtoupper(issetor($info['spouse']->business_address)));
        $worksheet->setCellValue('D42', strtoupper(issetor($info['spouse']->telephone)));

        $worksheet->setCellValue('D43', strtoupper(issetor($info['parents'][0]->surname)));
        $worksheet->setCellValue('D44', strtoupper(issetor($info['parents'][0]->first_name)));
        $worksheet->setCellValue('G44', strtoupper("NAME EXTENSION (JR., SR)\n".issetor($info['parents'][0]->ext_name)));
        $worksheet->setCellValue('D45', strtoupper(issetor($info['parents'][0]->middle_name)));

        $worksheet->setCellValue('D46', strtoupper(issetor($info['parents'][1]->maiden_name)));
        $worksheet->setCellValue('D47', strtoupper(issetor($info['parents'][1]->surname)));
        $worksheet->setCellValue('D48', strtoupper(issetor($info['parents'][1]->first_name)));
        $worksheet->setCellValue('D49', strtoupper(issetor($info['parents'][1]->middle_name)));

        $row = 37;
        foreach ($info['children'] as $child)
        {
            $worksheet->setCellValue('I'.$row, strtoupper(issetor($child->name)));
            $worksheet->setCellValue('M'.$row, strtoupper(date('m/d/Y', strtotime(issetor($child->birth_day)))));

            $row++;
            if ($row > 48) break;
        }
    }

    private function set_education($worksheet)
    {
        $info = $this->Employees_model->get_education($this->user_id);

        if (empty($info)) return;

        $info = set_key_obj($info, 'level');

        $worksheet->setCellValue('D54', strtoupper(issetor($info['Elementary']->school)));
        $worksheet->setCellValue('G54', strtoupper(issetor($info['Elementary']->course)));
        $worksheet->setCellValue('J54', strtoupper(issetor($info['Elementary']->from)));
        $worksheet->setCellValue('K54', strtoupper(issetor($info['Elementary']->to)));
        $worksheet->setCellValue('L54', strtoupper(issetor($info['Elementary']->units)));
        $worksheet->setCellValue('M54', strtoupper(issetor($info['Elementary']->year)));
        $worksheet->setCellValue('N54', strtoupper(issetor($info['Elementary']->honors)));

        $worksheet->setCellValue('D55', strtoupper(issetor($info['Secondary']->school)));
        $worksheet->setCellValue('G55', strtoupper(issetor($info['Secondary']->course)));
        $worksheet->setCellValue('J55', strtoupper(issetor($info['Secondary']->from)));
        $worksheet->setCellValue('K55', strtoupper(issetor($info['Secondary']->to)));
        $worksheet->setCellValue('L55', strtoupper(issetor($info['Secondary']->units)));
        $worksheet->setCellValue('M55', strtoupper(issetor($info['Secondary']->year)));
        $worksheet->setCellValue('N55', strtoupper(issetor($info['Secondary']->honors)));

        $worksheet->setCellValue('D56', strtoupper(issetor($info['Vocational/Trade Course']->school)));
        $worksheet->setCellValue('G56', strtoupper(issetor($info['Vocational/Trade Course']->course)));
        $worksheet->setCellValue('J56', strtoupper(issetor($info['Vocational/Trade Course']->from)));
        $worksheet->setCellValue('K56', strtoupper(issetor($info['Vocational/Trade Course']->to)));
        $worksheet->setCellValue('L56', strtoupper(issetor($info['Vocational/Trade Course']->units)));
        $worksheet->setCellValue('M56', strtoupper(issetor($info['Vocational/Trade Course']->year)));
        $worksheet->setCellValue('N56', strtoupper(issetor($info['Vocational/Trade Course']->honors)));

        $worksheet->setCellValue('D57', strtoupper(issetor($info['College']->school)));
        $worksheet->setCellValue('G57', strtoupper(issetor($info['College']->course)));
        $worksheet->setCellValue('J57', strtoupper(issetor($info['College']->from)));
        $worksheet->setCellValue('K57', strtoupper(issetor($info['College']->to)));
        $worksheet->setCellValue('L57', strtoupper(issetor($info['College']->units)));
        $worksheet->setCellValue('M57', strtoupper(issetor($info['College']->year)));
        $worksheet->setCellValue('N57', strtoupper(issetor($info['College']->honors)));

        $worksheet->setCellValue('D58', strtoupper(issetor($info['Graduate Studies']->school)));
        $worksheet->setCellValue('G58', strtoupper(issetor($info['Graduate Studies']->course)));
        $worksheet->setCellValue('J58', strtoupper(issetor($info['Graduate Studies']->from)));
        $worksheet->setCellValue('K58', strtoupper(issetor($info['Graduate Studies']->to)));
        $worksheet->setCellValue('L58', strtoupper(issetor($info['Graduate Studies']->units)));
        $worksheet->setCellValue('M58', strtoupper(issetor($info['Graduate Studies']->year)));
        $worksheet->setCellValue('N58', strtoupper(issetor($info['Graduate Studies']->honors)));
    }

    private function set_civil_service($worksheet)
    {
        $info = $this->Employees_model->get_civil_service($this->user_id);
        
        $row = 5;
        foreach ($info as $value)
        {
            $worksheet->setCellValue('A'.$row, strtoupper(issetor($value->title)));
            $worksheet->setCellValue('F'.$row, strtoupper(issetor($value->rating)));
            $worksheet->setCellValue('G'.$row, strtoupper(issetor($value->date)));
            $worksheet->setCellValue('I'.$row, strtoupper(issetor($value->place)));
            $worksheet->setCellValue('L'.$row, strtoupper(issetor($value->license)));
            $worksheet->setCellValue('M'.$row, strtoupper(issetor($value->validity)));

            $row++;
            if ($row > 11) break;
        }
    }

    private function set_work_experience($worksheet)
    {
        $info = $this->Employees_model->get_work_experience($this->user_id);
        
        $row = 18;
        foreach ($info as $value)
        {
            $worksheet->setCellValue('A'.$row, strtoupper(issetor($value->from)));
            $worksheet->setCellValue('C'.$row, strtoupper(issetor($value->to)));
            $worksheet->setCellValue('D'.$row, strtoupper(issetor($value->position)));
            $worksheet->setCellValue('G'.$row, strtoupper(issetor($value->department)));
            $worksheet->setCellValue('J'.$row, strtoupper(issetor($value->salary)));
            $worksheet->setCellValue('K'.$row, strtoupper(issetor($value->salary_grade)));
            $worksheet->setCellValue('L'.$row, strtoupper(issetor($value->status)));
            $worksheet->setCellValue('M'.$row, strtoupper(issetor($value->govt) == 'Yes' ? 'Y' : 'N'));

            $row++;
            if ($row > 45) break;
        }
    }

    private function set_voluntary_work($worksheet)
    {
        $info = $this->Employees_model->get_voluntary_work($this->user_id);
        
        $row = 6;
        foreach ($info as $value)
        {
            $worksheet->setCellValue('A'.$row, strtoupper(issetor($value->name)));
            $worksheet->setCellValue('E'.$row, strtoupper(issetor($value->from)));
            $worksheet->setCellValue('F'.$row, strtoupper(issetor($value->to)));
            $worksheet->setCellValue('G'.$row, strtoupper(issetor($value->hours)));
            $worksheet->setCellValue('H'.$row, strtoupper(issetor($value->position)));

            $row++;
            if ($row > 12) break;
        }
    }

    private function set_trainings($worksheet)
    {
        $info = $this->Employees_model->get_trainings($this->user_id);
        
        $row = 19;
        foreach ($info as $value)
        {
            $worksheet->setCellValue('A'.$row, strtoupper(issetor($value->title)));
            $worksheet->setCellValue('E'.$row, strtoupper(issetor($value->from)));
            $worksheet->setCellValue('F'.$row, strtoupper(issetor($value->to)));
            $worksheet->setCellValue('G'.$row, strtoupper(issetor($value->hours)));
            $worksheet->setCellValue('H'.$row, strtoupper(issetor($value->type)));
            $worksheet->setCellValue('I'.$row, strtoupper(issetor($value->sponsor)));

            $row++;
            if ($row > 35) break;
        }
    }

    private function set_other_info($worksheet)
    {
        $info = $this->Employees_model->get_other_info($this->user_id);
        
        $row = 39;
        foreach ($info['skills'] as $value)
        {
            $worksheet->setCellValue('A'.$row, strtoupper(issetor($value->skill)));

            $row++;
            if ($row > 45) break;
        }
        
        $row = 39;
        foreach ($info['recognitions'] as $value)
        {
            $worksheet->setCellValue('C'.$row, strtoupper(issetor($value->name)));

            $row++;
            if ($row > 45) break;
        }
        
        $row = 39;
        foreach ($info['memberships'] as $value)
        {
            $worksheet->setCellValue('I'.$row, strtoupper(issetor($value->name)));

            $row++;
            if ($row > 45) break;
        }
    }

    private function set_answers($worksheet)
    {
        $info = $this->Employees_model->get_questions($this->user_id);

        $yesHtml      = "<font face='Wingdings 2' size='14'>£</font>&nbsp;<font face='Arial Narrow' size='10'>Yes</font>";
        $noHtml       = "<font face='Wingdings 2' size='14'>£</font>&nbsp;<font face='Arial Narrow' size='10'>No</font>";
        $yesCheckHtml = "<font face='Wingdings 2' size='14'>R</font>&nbsp;<font face='Arial Narrow' size='10'>Yes</font>";
        $noCheckHtml  = "<font face='Wingdings 2' size='14'>R</font>&nbsp;<font face='Arial Narrow' size='10'>No</font>";
        
        $wizard       = new HtmlHelper();
        $yesText      = $wizard->toRichTextObject($yesHtml);
        $noText       = $wizard->toRichTextObject($noHtml);
        $yesCheckText = $wizard->toRichTextObject($yesCheckHtml);
        $noCheckText  = $wizard->toRichTextObject($noCheckHtml);
        
        $worksheet->setCellValue('H6', issetor($info->third_degree) == 'Yes' ? $yesCheckText : $yesText);
        $worksheet->setCellValue('J6', issetor($info->third_degree) == 'Yes' ? $noText : $noCheckText);
        
        $worksheet->setCellValue('H8', issetor($info->fourth_degree) == 'Yes' ? $yesCheckText : $yesText);
        $worksheet->setCellValue('J8', issetor($info->fourth_degree) == 'Yes' ? $noText : $noCheckText);
        if (issetor($info->fourth_degree) == 'Yes') 
        {
            $worksheet->setCellValue('H11', strtoupper(issetor($info->fourth_degree_details)));
        }

        $worksheet->setCellValue('H13', issetor($info->offence_guilty) == 'Yes' ? $yesCheckText : $yesText);
        $worksheet->setCellValue('J13', issetor($info->offence_guilty) == 'Yes' ? $noText : $noCheckText);
        if (issetor($info->offence_guilty) == 'Yes')
        {
            $worksheet->setCellValue('H15', strtoupper(issetor($info->offence_guilty_details)));
        }
        
        $worksheet->setCellValue('H17', issetor($info->criminally_charged) == 'Yes' ? $yesCheckText : $yesText);
        $worksheet->setCellValue('J17', issetor($info->criminally_charged) == 'Yes' ? $noText : $noCheckText);
        if (issetor($info->criminally_charged) == 'Yes')
        {
            $worksheet->setCellValue('K20', strtoupper(issetor($info->criminally_charged_date)));
            $worksheet->setCellValue('K21', strtoupper(issetor($info->criminally_charged_status)));
        }

        $worksheet->setCellValue('H23', issetor($info->convicted_crime) == 'Yes' ? $yesCheckText : $yesText);
        $worksheet->setCellValue('J23', issetor($info->convicted_crime) == 'Yes' ? $noText : $noCheckText);
        if (issetor($info->convicted_crime) == 'Yes')
        {
            $worksheet->setCellValue('H25', strtoupper(issetor($info->convicted_crime_details)));
        }

        $worksheet->setCellValue('H27', issetor($info->separated_service) == 'Yes' ? $yesCheckText : $yesText);
        $worksheet->setCellValue('J27', issetor($info->separated_service) == 'Yes' ? $noText : $noCheckText);
        if (issetor($info->separated_service) == 'Yes')
        {
            $worksheet->setCellValue('H29', strtoupper(issetor($info->separated_service_details)));
        }

        $worksheet->setCellValue('H31', issetor($info->election_candidate) == 'Yes' ? $yesCheckText : $yesText);
        $worksheet->setCellValue('J31', issetor($info->election_candidate) == 'Yes' ? $noText : $noCheckText);
        if (issetor($info->election_candidate) == 'Yes')
        {
            $worksheet->setCellValue('K32', strtoupper(issetor($info->election_candidate_details)));
        }

        $worksheet->setCellValue('H33', issetor($info->resigned_govt) == 'Yes' ? $yesCheckText : $yesText);
        $worksheet->setCellValue('J33', issetor($info->resigned_govt) == 'Yes' ? $noText : $noCheckText);
        if (issetor($info->resigned_govt) == 'Yes')
        {
            $worksheet->setCellValue('K35', strtoupper(issetor($info->resigned_govt_details)));
        }

        $worksheet->setCellValue('H37', issetor($info->immigrant) == 'Yes' ? $yesCheckText : $yesText);
        $worksheet->setCellValue('J37', issetor($info->immigrant) == 'Yes' ? $noText : $noCheckText);
        if (issetor($info->immigrant) == 'Yes')
        {
            $worksheet->setCellValue('H39', strtoupper(issetor($info->immigrant_details)));
        }
        
        $worksheet->setCellValue('H42', issetor($info->indigent) == 'Yes' ? $yesCheckText : $yesText);
        $worksheet->setCellValue('J42', issetor($info->indigent) == 'Yes' ? $noText : $noCheckText);
        if (issetor($info->indigent) == 'Yes')
        {
            $worksheet->setCellValue('L44', strtoupper(issetor($info->indigency)));
        }
        
        $worksheet->setCellValue('H45', issetor($info->disabled) == 'Yes' ? $yesCheckText : $yesText);
        $worksheet->setCellValue('J45', issetor($info->disabled) == 'Yes' ? $noText : $noCheckText);
        if (issetor($info->disabled) == 'Yes')
        {
            $worksheet->setCellValue('L46', strtoupper(issetor($info->disabled_id)));
        }
        
        $worksheet->setCellValue('H47', issetor($info->solo_parent) == 'Yes' ? $yesCheckText : $yesText);
        $worksheet->setCellValue('J47', issetor($info->solo_parent) == 'Yes' ? $noText : $noCheckText);
        if (issetor($info->solo_parent) == 'Yes')
        {
            $worksheet->setCellValue('L48', strtoupper(issetor($info->solo_parent_id)));
        }
    }

    private function set_references($worksheet)
    {
        $info = $this->Employees_model->get_references($this->user_id);
        
        $row = 52;
        foreach ($info as $value)
        {
            $worksheet->setCellValue('A'.$row, strtoupper(issetor($value->name)));
            $worksheet->setCellValue('F'.$row, strtoupper(issetor($value->address)));
            $worksheet->setCellValue('G'.$row, strtoupper(issetor($value->telephone)));

            $row++;
            if ($row > 54) break;
        }
    }

    private function set_agreement($worksheet)
    {
        $info = $this->Employees_model->get_agreement($this->user_id);
        
        $worksheet->setCellValue('D61', strtoupper(issetor($info->govt_issued_id)));
        $worksheet->setCellValue('D62', strtoupper(issetor($info->govt_issued_id_no)));
        $worksheet->setCellValue('D64', strtoupper(issetor($info->govt_issued_id_date)).'/'.strtoupper(issetor($info->govt_issued_id_place)));
    }
}
