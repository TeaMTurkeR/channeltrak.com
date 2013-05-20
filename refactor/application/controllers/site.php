<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct() {
        parent::__construct();
    }

    public $order = 'song_uploaded'; //DEFAULT ORDER
    public $limit = 20; //DEFAULT LIMIT
    public $offset = 0; //DEFAULT OFFSET

    public function index() {
    	redirect('index.php/latest');
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
        $data['subtitle'] = 'The most popular songs this week';

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

		$where = array(
       		'song_channel_slug' => $slug //GET CHANNEL BY SLUG
        );

		$data['pagination'] = 'channel/' . $slug;
		$data['title'] = ucwords(str_replace('-', ' ', $slug));

        if (!isset($_POST['offset'])) {
            $data['songs'] = $this->Song_model->getSongs($where, $this->order, $this->limit, $this->offset);
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

        $data['songs'] = $this->Song_model->getSongs($where, $this->order, $this->limit, $this->offset);
        $this->load->view('song', $data);

    }

    public function join() {
        $this->load->view('join');
    }

    public function login() {
        $this->load->view('login');
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect($this->input->get('last_url'));
    }

    public function settings() {
        if ($this->session->userdata('user_id')) {
            $userId = $this->session->userdata('user_id');
            $data['row'] = $this->User_model->getUser($userId);
            $data['title'] = 'Settings';
            $this->load->view('settings', $data);
        } else {
            $this->load->view('login');
        }
    }

    public function submit() {
        $this->load->view('submit');
    }

    public function admin() {
        $data['submitted'] = $this->Channel_model->getChannels('0');
        $data['approved'] = $this->Channel_model->getChannels('1');
        $data['title'] = 'Admin';
        $this->load->view('admin', $data);
    }




}

?>