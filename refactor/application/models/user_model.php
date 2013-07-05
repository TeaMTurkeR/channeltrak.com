<?php

class User_model extends CI_Model {

    public function getUser($userId) {
        $query = $this->db->get_where('users', array('user_id' => $userId));
        if($query->num_rows() == 1) {
            $row = $query->row();
            return $row;
        }
    }

	public function registerUser($data) {
        $this->db->insert('users', $data);
        return;
    } 

    public function loginUser($name, $password) {
        $this->db->select('user_id, user_name');
        $this->db->from('users');
        $this->db->where('user_name', $name);
        $this->db->where('user_password', $password);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1) {
            $row = $query->row();
            $data = array(
                'user_id' => $row->user_id,
                'user_name' => $row->user_name,
                'logged_in' => true
            );
            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($userId, $data) {
        $this->db->where('user_id', $userId);
        $this->db->update('users', $data);

        $this->db->select('user_id, user_name');
        $this->db->from('users');
        $this->db->where('user_id', $userId);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1) {
            $row = $query->row();
            $data = array(
                'user_id' => $row->user_id,
                'user_name' => $row->user_name,
                'logged_in' => true
            );
            $this->session->set_userdata($data);
        } 
    }

    public function checkPassword($userId, $password) {
        $this->db->where('user_id', $userId);
        $this->db->where('user_password', $password);
        $query = $this->db->get('users');
        if($query->num_rows() !== 0){
            return true;
        } else {
            return false;
        }
    }

    public function checkUsername($username) {
        $this->db->where('user_name', $username);
        $query = $this->db->get('users');
        if($query->num_rows() !== 0){
            return true;
        } else {
            return false;
        }
    }

}

?>