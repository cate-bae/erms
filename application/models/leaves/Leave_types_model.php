<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave_types_model extends CI_Model {

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
                    ->from('leave_types')
                    ->where('name', $name)
                    ->get();

        return $query->num_rows() > 0;
    }

    public function create($data)
    {
        $this->db->insert('leave_types', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('leave_types', $data);
    }

    public function get($where, $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('leave_types')
                    ->where_arr($where)
                    ->get()
                    ->row();
    }

    public function all()
    {
        return $this->db->select('*')
                    ->from('leave_types')
                    ->get()
                    ->result();
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('leave_types');
    }

    public function has_leave_requests($id)
    {
        $query = $this->db->select('id')
                    ->from('leaves')
                    ->where('type', $id)
                    ->limit(1)
                    ->get();

        return $query->num_rows() > 0;
    }
}
?>