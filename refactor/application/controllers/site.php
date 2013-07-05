<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct() {
        parent::__construct();
    }

    public $order = 'song_uploaded'; //DEFAULT ORDER
    public $limit = 20; //DEFAULT LIMIT
    public $offset = 0; //DEFAULT OFFSET

    public function index() {
    	redirect('popular');
	}

	public function latest() {
    	
    	$where = array(
       		'song_id >' => '0' //GET ALL SONGS
        );

        $data['pagination'] = 'latest';
        $data['title'] = 'Latest';
        $data['subtitle'] = 'The newest songs posted to YouTube';

        if (!isset($_POST['offset'])) {
            $data['songs'] = $this->Song_model->getSongs($where, $this->order, $this->limit, $this->offset);
            $this->load->view('main', $data);
        } else {
            $offset = $_POST['offset'];
            $data['songs'] = $this->Song_model->getSongs($where, $this->order, $this->limit, $offset);
            $this->load->view('includes/loop', $data);
        }
	}

	public function popular() {

		$where = array(
       		'song_uploaded >' => date('Y-m-d H:i:s', strtotime('-100 days')) //GET SONGS FROM LAST WEEK
        );

        $order = 'song_favorites';
        $limit = '10';

        $data['rank'] = TRUE;
        $data['title'] = 'Popular';
        $data['subtitle'] = 'The most popular songs right now';

        $data['songs'] = $this->Song_model->getSongs($where, $order, $limit, $this->offset);
        $this->load->view('main', $data);

	}

	public function directory() {
    	$this->load->model('Channel_model');
    	$status = '1';
        $data['channels'] = $this->Channel_model->getChannels($status);
        $data['title'] = 'Directory';
        $data['subtitle'] = 'The best music channels on YouTube';

        $this->load->view('directory', $data);

    }

	public function channel($slug) { 
        
        $this->load->model('Channel_model');

		$where = array(
       		'song_channel_slug' => $slug //GET CHANNEL BY SLUG
        );

		$data['pagination'] = 'channel/' . $slug;

        if (!isset($_POST['offset'])) {
            $data['channel'] = $this->Channel_model->getChannel('channel_slug', $slug);
            $data['songs'] = $this->Song_model->getSongs($where, $this->order, $this->limit, $this->offset);
            $data['title'] = $data['channel']->channel_name;
            $this->load->view('main', $data);
        } else {
            $offset = $_POST['offset'];
            $data['songs'] = $this->Song_model->getSongs($where, $this->order, $this->limit, $offset);
            $this->load->view('includes/loop', $data);
        }
    }

    public function song($slug) {

    	$where = array(
       		'song_slug' => $slug //GET CHANNEL BY SLUG
        );

        $data['song'] = $this->Song_model->getSong($where);
        $data['title'] = $data['song']->song_title;
        $this->load->view('song', $data);

    }

    public function join() {
        $data['title'] = 'Join';
        $data['subtitle'] = 'Create a ChannelTrak account';

        $this->load->view('join', $data);
    }

    public function login() {
        $data['title'] = 'Login';
        $data['subtitle'] = 'Sign into your account';

        $this->load->view('login', $data);
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect($this->input->get('last_url'));
    }

    public function favorites() {
        if ($this->session->userdata('logged_in')) {

            $userId = $this->session->userdata('user_id');

            $data['pagination'] = 'favorites';
            $data['title'] = 'Favorites';
            $data['subtitle'] = 'Your favorites songs on ChannelTrak';

            if (!isset($_POST['offset'])) {
                $data['songs'] = $this->Song_model->getFavorites($userId, $this->limit, $this->offset);
                $this->load->view('main', $data);
            } else {
                $offset = $_POST['offset'];
                $data['songs'] = $this->Song_model->getFavorites($userId, $this->limit, $this->offset);
                $this->load->view('includes/loop', $data);
            }

        } else {
            redirect('login');
        }
    }

    public function settings() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('User_model');
            $userId = $this->session->userdata('user_id');

            $data['user'] = $this->User_model->getUser($userId);
            $data['title'] = 'Settings';
            $data['subtitle'] = 'Your account settings';

            $this->load->view('settings', $data);
        } else {
            redirect('login');
        }
    }

    public function submit() {
        $data['title'] = 'Submit';
        $data['subtitle'] = 'Submit a new Youtube channel';

        $this->load->view('submit', $data);
    }

    public function admin() {
        if ($this->session->userdata('logged_in') && $this->session->userdata('user_name') == 'Admin') {

            $this->load->model('Channel_model');
            $data['approved'] = $this->Channel_model->getChannels('1');
            $data['unapproved'] = $this->Channel_model->getChannels('0');
            $data['title'] = 'Dashboard';
            $this->load->view('admin/dashboard', $data);

        } else {
            redirect('latest');
        }
    }

    public function edit($slug) {
        if ($this->session->userdata('logged_in') && $this->session->userdata('user_name') == 'Admin') {
            $this->load->model('Channel_model');

            $data['channel'] = $this->Channel_model->getChannel('channel_slug', $slug);

            $where = array(
                'song_channel_slug' => $data['channel']->channel_slug //GET CHANNEL BY SLUG
            );

            $data['songs'] = $this->Song_model->getSongs($where, 'song_favorites', '100000', $this->offset);
            $data['title'] = 'Edit: '.$data['channel']->channel_name;
            $this->load->view('admin/edit', $data);
        } else {
            redirect('latest');
        }
    }

}

?>