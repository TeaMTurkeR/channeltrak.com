<?php

class User_model extends CI_Model {

    public function create($data) {

        $this->db->insert('users', $data);

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    } 

    public function get($array) {

        $this->db->where($array);
        $query = $this->db->get('users');

        if ($query->num_rows() > 1) {

            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;

        } else {

            $row = $query->row();

            return $row;

        }
        
    }

    public function update($id, $data) {

        $this->db->where('id', $id);
        $this->db->update('users', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
    } 

    public function delete($id) {

        $this->db->where('id', $id);
        $this->db->delete('mytable');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }

    public function login($email, $password) {

        $this->db->where('email', $email);

        $this->db->where('password', $password);

        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {

            $row = $query->row();

            $cookie = array(
                'id' => $row->id,
                'email' => $row->email,
                'logged_in' => true
            );

            $this->session->set_userdata($cookie);

            return true;

        } else {

            return false;

        }

    }

    public function restricted() {

        if ($this->session->userdata('logged_in')) {

            return true;

        } else {

            show_404();

        }

    }

}

?>