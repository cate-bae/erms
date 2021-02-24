<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_model extends CI_Model {

    public function __construct()
    {
		parent::__construct();
    }

    public function is_exists($where)
    {
        $query = $this->db->select('id')
                    ->from('attendance')
                    ->where_arr($where)
                    ->limit(1)
                    ->get();

        return $query->num_rows() > 0;
    }

    public function create($data)
    {
        $this->db->insert('attendance', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('attendance', $data);
    }

    public function update_where($data, $where)
    {
        $this->db->where_arr($where);
        return $this->db->update('attendance', $data);
    }

    public function get($where, $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('attendance')
                    ->where_arr($where)
                    ->get()
                    ->row();
    }

    public function all()
    {
        $query = $this->db->select('a.*, u.last_name, u.first_name, u.middle_name, u.ext_name, u.biometrics_id')
                    ->from('attendance a')
                    ->join('users u', 'a.user_id = u.id')
                    ->where('u.deleted', 0)
                    ->order_by('UNIX_TIMESTAMP(date)')
                    ->get()
                    ->result();

        if (empty($query)) return [];

        foreach ($query as $key => $employee)
        {
            $query[$key]->employee_name = $employee->first_name.' '. $employee->middle_name.' '. $employee->last_name.' '.$employee->ext_name;
        }
        return $query;
    }
    
    public function all_range($from, $to)
    {
        $query = $this->db->select('a.*, u.last_name, u.first_name, u.middle_name, u.ext_name, u.biometrics_id')
                    ->from('attendance a')
                    ->join('users u', 'a.user_id = u.id')
                    ->where('u.deleted', 0)
                    ->where("STR_TO_DATE(date,'%m/%d/%Y') BETWEEN STR_TO_DATE('{$from}','%m-%d-%Y') AND STR_TO_DATE('{$to}','%m-%d-%Y')")
                    ->order_by("UNIX_TIMESTAMP(STR_TO_DATE(date,'%m/%d/%Y'))")
                    ->get()
                    ->result();

        if (empty($query)) return [];

        foreach ($query as $key => $employee)
        {
            $query[$key]->employee_name = $employee->first_name.' '. $employee->middle_name.' '. $employee->last_name.' '.$employee->ext_name;
        }
        return $query;
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('attendance');
    }
}
?>