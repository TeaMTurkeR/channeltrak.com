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
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $loggedIn = $this->User_model->loginUser($name, $password);
        
        if($loggedIn) {
            redirect('/', 'refresh');
        } else {
            print 'invalid';
        } 
    }

    public function favorite() {
        if (isset($_POST['songId']) && isset($_POST['newCount']) && isset($_POST['favorite'])) { 
            
            $favorite = $this->input->post('favorite');

            if($favorite == 'true') {

                $userId = $this->session->userdata('user_id');
                $songId = $this->input->post('songId');
                $newCount = $this->input->post('newCount');


                $data = array(
                   'song_favorites' => $newCount
                );

                $this->Song_model->updateSong($songId, $data);

                $data = array(
                    'user_id' => $userId,
                    'song_id' => $songId
                );
                $this->Favorite_model->addFavorite($data);
            } else {

                $userId = $this->session->userdata('user_id');
                $songId = $this->input->post('songId');
                $newCount = $this->input->post('newCount');


                $data = array(
                   'song_favorites' => $newCount
                );
                $this->Song_model->updateSong($songId, $data);
                $this->Favorite_model->removeFavorite($songId);
            } 

        } else {
            print 'not working';
        }
    }

}

?>