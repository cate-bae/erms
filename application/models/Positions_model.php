<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Positions_model extends CI_Model {

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
                    ->from('position')
                    ->where('name', $name)
                    ->get();

        return $query->num_rows() > 0;
    }

    public function create($data)
    {
        $this->db->insert('position', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('position', $data);
    }

    public function get($where, $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('position')
                    ->where_arr($where)
                    ->get()
                    ->row();
    }

    public function all()
    {
        return $this->db->select('*')
                    ->from('position')
                    ->get()
                    ->result();
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('position');
    }

    public function has_employees($id)
    {
        $query = $this->db->select('id')
                    ->from('users')
                    ->where('position_id', $id)
                    ->limit(1)
                    ->get();

        return $query->num_rows() > 0;
    }
}
?>