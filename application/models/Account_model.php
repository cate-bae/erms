<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

    public function __construct()
    {
		parent::__construct();
    }

    public function is_username_exists($username, $id = NULL)
    {
        if ($id) {
            $this->db->where('id !=', $id);
        }
        $query = $this->db->select('username')
                    ->from('users')
                    ->where('username', $username)
                    ->get();

        return $query->num_rows() > 0;
    }

    public function create($data)
    {
		// encrypt password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function get($where, $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('users')
                    ->where_arr($where)
                    ->get()
                    ->row();
    }

    public function get_info($where, $fields = 'p.*, o.name as position')
    {
        return $this->db->select($fields)
                    ->from('users u')
                    ->join('profile p', 'u.id = p.user_id', 'left')
                    ->join('position o', 'u.position_id = o.id', 'left')
                    ->where_arr($where)
                    ->get()
                    ->row();
    }

    public function all($where = [])
    {
        return $this->db->select('id, first_name, last_name, username, type, avatar')
                    ->from('users')
                    ->where('type!=', -1) // exclude super admin
                    ->where('id!=', get_user_data()['id'])
                    ->where_arr($where)
                    ->get()
                    ->result();
    }

    public function users($where = [], $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('users')
                    ->where_arr($where)
                    ->get()
                    ->result();
    }

    public function has_profile_data($id)
    {
        $query = $this->db->select('id')
                    ->from('profile')
                    ->where('user_id', $id)
                    ->limit(1)
                    ->get();

        return $query->num_rows() > 0;
    }

    public function delete($user_id)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('users', ['deleted' => 1]);
    }
}
?>