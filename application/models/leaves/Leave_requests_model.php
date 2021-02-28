<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave_requests_model extends CI_Model {

    public function __construct()
    {
		parent::__construct();
    }

    public function create($data)
    {
        $this->db->insert('leave_requests', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('leave_requests', $data);
    }

    public function get($where, $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('leave_requests')
                    ->where_arr($where)
                    ->get()
                    ->row();
    }

    public function all()
    {
        return $this->db->select('r.*, CONCAT(u.last_name, ", ", u.first_name, " ", u.middle_name, " ", u.ext_name) as employee_name')
                    ->from('leave_requests r')
                    ->join('users u', 'r.user_id = u.id')
                    ->where('u.deleted', 0)
                    ->order_by('create_time', 'DESC')
                    ->get()
                    ->result();
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('leave_requests');
    }
}
?>