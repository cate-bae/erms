<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_model extends CI_Model {

    public function __construct()
    {
		parent::__construct();
    }

    public function is_name_exists($name, $id = NULL)
    {
        if ($id) {
            $this->db->where('id !=', $id);
        }
        $query = $this->db->select('name')
                    ->from('department')
                    ->where('name', $name)
                    ->get();

        return $query->num_rows() > 0;
    }

    public function biometrics_exists($biometrics_id, $id)
    {
        $query = $this->db->select('biometrics_id')
                    ->from('users')
                    ->where('biometrics_id', $biometrics_id)
                    ->where('id !=', $id)
                    ->get();

        return $query->num_rows() > 0;
    }

    public function save($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function save_multiple($table, $data)
    {
        if (empty($data)) return;

        return $this->db->insert_batch($table, $data);
    }

    public function update($table, $data, $where)
    {
        $this->db->where_arr($where);
        return $this->db->update($table, $data);
    }

    public function get($table, $where, $fields = '*')
    {
        return $this->db->select($fields)
                    ->from($table)
                    ->where_arr($where)
                    ->get()
                    ->row();
    }

    public function all()
    {
        return $this->db->select('u.*, d.name as department_name, p.name as position_name')
                    ->from('users u')
                    ->join('department d', 'u.department_id=d.id', 'LEFT')
                    ->join('position p', 'u.position_id=p.id', 'LEFT')
                    ->where('deleted', 0)
                    ->where('type!=', -1)
                    ->get()
                    ->result();
    }

    public function get_info($user_id)
    {
        return $this->db->select('u.*, d.name as department_name, p.name as position_name')
                    ->from('users u')
                    ->join('department d', 'u.department_id=d.id', 'LEFT')
                    ->join('position p', 'u.position_id=p.id', 'LEFT')
                    ->where('u.id', $user_id)
                    ->where('deleted', 0)
                    ->get()
                    ->row();
    }

    public function delete($table, $where = [])
    {
        if (empty($table) || empty($where))
        {
            return;
        }
        return $this->db->where_arr($where)->delete($table);
    }

    public function has_employees($id)
    {
        $query = $this->db->select('id')
                    ->from('users')
                    ->where('department_id', $id)
                    ->limit(1)
                    ->get();

        return $query->num_rows() > 0;
    }

    public function has_data($table, $where = [])
    {
        $query = $this->db->select('id')
                    ->from($table)
                    ->where_arr($where)
                    ->limit(1)
                    ->get();

        return $query->num_rows() > 0;
    }

    public function get_personal($user_id)
    {
        $personal = $this->db->select('p.*, u.first_name, u.last_name, u.ext_name, u.middle_name')
                    ->from('profile p')
                    ->join('users u', 'p.user_id=u.id', 'RIGHT')
                    ->where('u.id', $user_id)
                    ->get()
                    ->row();
                    
        $address = $this->db->select('*')
                    ->from('address')
                    ->where('user_id', $user_id)
                    ->get()
                    ->result();
        return [
            'personal' => $personal,
            'address'  => empty($address) ? [] : set_key_obj($address, 'type')
        ];
    }

    public function get_family($user_id)
    {
        $spouse = $this->db->select('*')
                    ->from('spouse')
                    ->where('user_id', $user_id)
                    ->get()
                    ->row();
        $parents = $this->db->select('*')
                    ->from('parent')
                    ->where('user_id', $user_id)
                    ->get()
                    ->result();
        $children = $this->db->select('*')
                    ->from('children')
                    ->where('user_id', $user_id)
                    ->get()
                    ->result();
        return [
            'spouse'   => $spouse,
            'parents'  => empty($parents) ? [] : set_key_obj($parents, 'type'),
            'children' => $children
        ];
    }

    public function get_education($user_id)
    {
        return $this->db->select('*')
                ->from('education')
                ->where('user_id', $user_id)
                ->get()
                ->result();
    }

    public function get_civil_service($user_id)
    {
        return $this->db->select('*, DATE_FORMAT(`date`, "%m/%d/%Y") as `date`')
                ->from('civil_service')
                ->where('user_id', $user_id)
                ->get()
                ->result();
    }

    public function get_work_experience($user_id)
    {
        return $this->db->select('*, DATE_FORMAT(`from`, "%m/%d/%Y") as `from`, DATE_FORMAT(`to`, "%m/%d/%Y") as `to`')
                ->from('work_experience')
                ->where('user_id', $user_id)
                ->order_by('UNIX_TIMESTAMP(`to`)', 'DESC')
                ->get()
                ->result();
    }
    public function get_voluntary_work($user_id)
    {
        return $this->db->select('*, DATE_FORMAT(`from`, "%m/%d/%Y") as `from`, DATE_FORMAT(`to`, "%m/%d/%Y") as `to`')
                ->from('voluntary_work')
                ->where('user_id', $user_id)
                ->get()
                ->result();
    }

    public function get_trainings($user_id)
    {
        return $this->db->select('*, DATE_FORMAT(`from`, "%m/%d/%Y") as `from`, DATE_FORMAT(`to`, "%m/%d/%Y") as `to`')
                ->from('trainings')
                ->where('user_id', $user_id)
                ->order_by('UNIX_TIMESTAMP(`to`)', 'DESC')
                ->get()
                ->result();
    }

    public function get_other_info($user_id)
    {
        $skills = $this->db->select('*')
                    ->from('skill')
                    ->where('user_id', $user_id)
                    ->get()
                    ->result();
        $recognitions = $this->db->select('*')
                    ->from('recognition')
                    ->where('user_id', $user_id)
                    ->get()
                    ->result();
        $memberships = $this->db->select('*')
                    ->from('membership')
                    ->where('user_id', $user_id)
                    ->get()
                    ->result();
        return [
            'skills'       => $skills,
            'recognitions' => $recognitions,
            'memberships'  => $memberships
        ];
    }

    public function get_questions($user_id)
    {
        return $this->db->select('*')
                ->from('questions')
                ->where('user_id', $user_id)
                ->get()
                ->row();
    }

    public function get_references($user_id)
    {
        return $this->db->select('*')
                ->from('references')
                ->where('user_id', $user_id)
                ->get()
                ->result();
    }

    public function get_agreement($user_id)
    {
        return $this->db->select('govt_issued_id, govt_issued_id_no, govt_issued_id_date, govt_issued_id_place')
                ->from('profile')
                ->where('user_id', $user_id)
                ->get()
                ->row();
    }

    public function get_general($user_id)
    {
        return $this->db->select('u.*, d.name as department_name, p.name as position_name')
                    ->from('users u')
                    ->join('department d', 'u.department_id=d.id', 'LEFT')
                    ->join('position p', 'u.position_id=p.id', 'LEFT')
                    ->where('u.id', $user_id)
                    ->where('deleted', 0)
                    ->get()
                    ->row();
    }

    public function get_benefits($user_id)
    {
        $query = $this->db->select('*')
                ->from('user_benefits')
                ->where('user_id', $user_id)
                ->group_by('benefit_id')
                ->get()
                ->result();

        return empty($query) ? [] : array_column($query, 'benefit_id');
    }

    public function get_employee_names()
    {
        
        return $this->db->select('id, first_name, last_name, middle_name, ext_name')
            ->from('users')
            ->where('deleted', 0)
            ->get()
            ->result();
    }

    public function get_attendance($user_id)
    {
        return $this->db->select('*')
                ->from('attendance')
                ->where('user_id', $user_id)
                ->order_by('date')
                ->get()
                ->result();
    }

    public function get_attendance_range($user_id, $from, $to)
    {
        return $this->db->select('*')
                ->from('attendance')
                ->where('user_id', $user_id)
                ->where("STR_TO_DATE(date,'%m/%d/%Y') BETWEEN STR_TO_DATE('{$from}','%m-%d-%Y') AND STR_TO_DATE('{$to}','%m-%d-%Y')")
                ->order_by('date')
                ->get()
                ->result();
    }

    public function get_leaves($user_id)
    {
        return $this->db->select('r.*, t.name as type_name')
                    ->from('leave_requests r')
                    ->join('leave_types t', 'r.type = t.id', 'LEFT')
                    ->where('r.user_id', $user_id)
                    ->order_by('create_time', 'DESC')
                    ->get()
                    ->result();
    }

    public function get_leave_info($user_id)
    {
        return $this->db->select('leave, leave_used')
                ->from('users')
                ->where('id', $user_id)
                ->get()
                ->row();
    }

    public function get_biometrics_id($user_id)
    {
        $query = $this->db->select('biometrics_id')
                ->from('users')
                ->where('id', $user_id)
                ->get()
                ->row();

        return empty($query) ? '' : $query->biometrics_id;
    }

    public function has_leave($user_id)
    {
        $leave_info = $this->get_leave_info($user_id);

        return ((double)$leave_info->leave - (double)$leave_info->leave_used) >= 1;
    }

    public function deduct_leave($user_id)
    {
        return $this->db->set('`leave`', '`leave`-1', FALSE)
                        ->where('id', $user_id)
                        ->update('users');
    }

    public function add_leave($user_id, $increment = '1.5')
    {
        return $this->db->set('`leave`', "`leave`+{$increment}", FALSE)
                        ->where('id', $user_id)
                        ->update('users');
    }

    private function get_last_leave_credit($user_id, $type = 0)
    {
        return $this->db->select('*')
                ->from('leave_credit')
                ->where('user_id', $user_id)
                ->where('type', $type)
                ->order_by('to', 'DESC')
                ->get()
                ->row();
    }

    private function generate_regular_leave($user_id, $regular_date)
    {
        if (strtotime(date('Y-m-d')) < strtotime($regular_date . ' +1 month'))
        {
            return 0;
        }

        $credit_log = $this->get_last_leave_credit($user_id);

        if ( ! empty($credit_log->to) && strtotime(date('Y-m-d')) <= strtotime($credit_log->to . ' +1 month'))
        {
            return 0;
        }
        
        $this->save('leave_credit', [
            'user_id' => $user_id,
            'type'    => 0,
            'from'    => date('Y-m-d', strtotime(date('Y-m-d') . ' -1 month')),
            'to'      => date('Y-m-d', strtotime(date('Y-m-d') . ' -1 day')),
            'leave'   => '1.5'
        ]);

        return 1.5;
    }

    private function generate_solo_leave($user_id, $regular_date)
    { 
        if (strtotime(date('Y-m-d')) < strtotime($regular_date . ' +1 year'))
        {
            return 0;
        }
        
        $question = $this->get('questions', ['user_id' => $user_id], 'solo_parent');
        if (empty($question) || $question->solo_parent != 'Yes')
        {
            return 0;
        }

        $credit_log = $this->get_last_leave_credit($user_id, 1);
        
        if ( ! empty($credit_log) && strtotime(date('Y-m-d')) <= strtotime($credit_log->to . ' +1 year'))
        {
            return 0;
        }

        $this->save('leave_credit', [
            'user_id' => $user_id,
            'type'    => 1,
            'from'    => date('Y-m-d', strtotime(date('Y-m-d') . ' -1 year')),
            'to'      => date('Y-m-d', strtotime(date('Y-m-d') . ' -1 day')),
            'leave'   => '7'
        ]);

        return 7;
    }

    public function generate_leave($user_id)
    {
        $user_info = $this->get('users', ['id' => $user_id], 'job_status, regular_date');
        
        if ($user_info->job_status != 1 || empty($user_info->regular_date))
        {
            return;
        }

        $regular_date = date('Y-m-d', strtotime($user_info->regular_date));

        try 
		{
            $add_leave_credit = $this->generate_regular_leave($user_id, $regular_date);
            $add_leave_credit += $this->generate_solo_leave($user_id, $regular_date);
            
            if ( ! empty($add_leave_credit))
            {
                $this->add_leave($user_id, $add_leave_credit);
            }
        }
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
    }
}
?>