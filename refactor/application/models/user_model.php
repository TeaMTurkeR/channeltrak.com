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

    public function loginUser($email, $password) {
        $this->db->select('user_id, user_name');
        $this->db->from('users');
        $this->db->where('user_email', $email);
        $this->db->where('user_password', sha1($password));
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

    public function countFavorties($userId) {
        $this->db->where('user_id', $userId);
        return $this->db->count_all('favorites');
    }

    public function addFavorite($data) {
        $this->db->insert('favorites', $data);
        if($this->db->affected_rows() > 0) {
            return true;
        }
    } 

    public function removeFavorite($songId) {
        $this->db->where('song_id', $songId);
        $this->db->delete('favorites');
        if($this->db->affected_rows() > 0) {
            return true;
        }
    } 

    public function checkFavorites($userId, $songId) {
        $this->db->where('user_id', $userId);
        $this->db->where('song_id', $songId);
        $query = $this->db->get('favorites');
        if($query->num_rows() !== 0){
            return true;
        }
    }

}

?>