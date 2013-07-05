<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Favorite_model');
    }

	public function register() {
        $submittedPassword = $this->input->post('password');
        $confirmPassword = $this->input->post('confirm');
        $email = $this->input->post('email');
        
        if ( $submittedPassword == $confirmPassword ) {
            
            $password = sha1($this->input->post('password'));
            $name = $this->input->post('name');
            
            if ( $this->User_model->checkUsername($name) == false ) {

                $data = array(
                	'user_name' => $name,
                    'user_email' => $email,
                    'user_password' => $password,
                    'user_registered' => date('Y-m-d H:i:s')
                );

            	$this->User_model->registerUser($data);
                $this->User_model->loginUser($name, $password);

            	redirect('/', 'refresh');

            } else {
                $data['title'] = 'Join';
                $data['subtitle'] = 'Create a ChannelTrak account';
                $data['error'] = 'That username is taken...';
                $data['username'] = $name;
                $data['email'] = $email;
                $this->load->view('join', $data);
            }

        } else {
            $data['title'] = 'Join';
            $data['subtitle'] = 'Create a ChannelTrak account';
            $data['error'] = 'Passwords don\'t match...';
            $data['username'] = $name;
            $data['email'] = $email;
            $this->load->view('join', $data);
        }
    }

    public function login() {
        $name = $this->input->post('name');
        $password = sha1($this->input->post('password'));
        $loggedIn = $this->User_model->loginUser($name, $password);
        if ($this->User_model->checkUsername($name)) {

            if($loggedIn) {

                redirect('/', 'refresh');

            } else {

                $data['title'] = 'Login';
                $data['subtitle'] = 'Sign into your account';
                $data['error'] = 'That\'s the wrong password...';
                $data['username'] = $name;
                $this->load->view('login', $data);

            } 

        } else {

            $data['title'] = 'Login';
            $data['subtitle'] = 'Sign into your account';
            $data['error'] = 'That username doesn\'t exist...';
            $this->load->view('login', $data);

        }
    }

    public function updateSettings () {
        $currentName = $this->session->userdata('user_name');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        
        if ( $currentName == $name ) {

            $data = array(
                'user_email' => $email
            );

            $this->User_model->updateUser($this->session->userdata('user_id'), $data);
            redirect('settings', 'refresh');

        } else { 

            if ( $this->User_model->checkUsername($name) == false ) {

                $data = array(
                    'user_name' => $name,
                    'user_email' => $email
                );

                $this->User_model->updateUser($this->session->userdata('user_id'), $data);
                redirect('settings', 'refresh');

            } else {
                print 'That username is taken...';
            }

        }
    }

    public function updatePassword () {

        $current = $this->input->post('current');
        $new = $this->input->post('new');
        $confirm = $this->input->post('confirm');
        $userId = $this->session->userdata('user_id');

        if ( $new == $confirm ) {

            if ( $this->User_model->checkPassword($userId, sha1($current)) ) { //Check if correct password

                $this->User_model->updatePassword($userId, sha1($new));
                redirect('/index.php/settings', 'refresh');

            } else {
                print 'That is not your password...';
            }

        } else {
            print 'Passwords do not match...';
        }



    }

    public function favorite() {
        if (isset($_POST['newCount']) && isset($_POST['songId']) && isset($_POST['favorite'])) { 
            
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