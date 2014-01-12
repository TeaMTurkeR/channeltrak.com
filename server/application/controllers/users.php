<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    public function dashboard() {

        $this->User_model->restricted();

        $data['title'] = 'Dashboard';
        $data['approved'] = $this->Channel_model->channels(array('approved' => 1));
        $data['unapproved'] = $this->Channel_model->channels(array('approved' => 0));

        $this->load->view('admin/dashboard', $data);

    }

    public function join() {

        $data['title'] = 'Join';

        $this->load->view('admin/join', $data);

    }

    public function login() {

        $data['title'] = 'Login';

        $this->load->view('admin/login', $data);

    }

    public function create() {

        $this->User_model->restricted();

    	$email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        
        $data = array(
            'email' => $email,
            'password' => $password,
            'created' => date('Y-m-d H:i:s'),
            'updated' => date('Y-m-d H:i:s')
        );

        if ($this->User_model->create($data)) {

        	if ($this->User_model->login($email, $password)) {

            	redirect('dashboard');

            } else {
                print_r('yolo');
            }

        } else {
            print_r('nolo');
        }

    }

    public function update() {

        $this->User_model->restricted();               

        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));

        $data = array(
            'email' => $email,
            'password' => $password,
            'created' => date('Y-m-d H:i:s'),
            'updated' => date('Y-m-d H:i:s')
        );

        if ($this->User_model->update($id, $data)) {

            $data['success'] = 'Saved';
            $data['title'] = 'Settings';
            $data['user'] = $this->User_model->get(array('id' => $this->session->userdata('id')));

            $this->load->view('admin/settings', $data);

        } else {

            $data['error'] = 'There was some kind of error...';
            $data['title'] = 'Settings';
            $data['user'] = $this->User_model->get(array('id' => $this->session->userdata('id')));

            $this->load->view('admin/settings', $data);

        }

    }

    public function validate() {

        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $valid = $this->User_model->login($email, $password);

        if ($valid) {

            redirect('dashboard', 'refresh');

        } else {

            $data['title'] = 'Login';
            $data['error'] = 'That isn\'t correct...';
            $this->load->view('admin/login', $data);

        } 

    }

    public function logout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        
        redirect('login', 'refresh');
    }

}