<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

	public function register() {
        $password = $this->input->post('password');
        $confirmPassword = $this->input->post('confirm-password');

        if ( $password == $confirmPassword ) {
            $data = array(
            	'user_name' => $this->input->post('name'),
                'user_email' => $this->input->post('email'),
                'user_password' => sha1($password),
                'user_registered' => date('Y-m-d H:i:s')
            );
        	$this->Usermodel->registerUser($data);
        	redirect('/', 'refresh');
        } else {
            print 'passwords do not match...bro';
        }
    }

    public function login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $loggedIn = $this->User_model->loginUser($email, $password);
        
        if($loggedIn) {
            redirect('/', 'refresh');
        } else {
            print 'invalid';
        } 
    }

}

?>