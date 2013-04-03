<?php

class Usermodel extends CI_Model {

	function registerUser($data) {
        $this->db->insert('users', $data);
        return;
    } 

    function loginUser($email, $password) {
        $this->db->select('user_id, user_name');
        $this->db->from('users');
        $this->db->where('user_email', $email);
        $this->db->where('user_password', sha1($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1) {
            $row = $query->row();
            $session_array = array(
                'user_id' => $row->user_id,
                'user_name' => $row->user_name,
                'logged_in' => true
            );
            $this->session->set_userdata($session_array);
            return true;
        } else {
            return false;
        }
    }

}

?>