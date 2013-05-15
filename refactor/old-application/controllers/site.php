<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Channel_model');
        $this->load->model('User_model');
        $this->load->model('Song_model');
        $this->load->model('Favorite_model');
    }
    
    public $limit = 20;

	public function index() {
		$maxDate = date('Y-m-d H:i:s', strtotime('-10000 days'));
		$orderBy = 'song_uploaded';
        if (isset($_POST['offset'])) {
            $offset = $_POST['offset'];
            $data['songs'] = $this->Song_model->getSongs($maxDate, $orderBy, $this->limit, $offset);
            $this->load->view('includes/loop', $data);
        } else {
            $offset = 0;
            $data['splash'] = true;
            $data['songs'] = $this->Song_model->getSongs($maxDate, $orderBy, $this->limit, $offset);
            $this->load->view('home', $data);
        }
	}

	public function latest() {
		$maxDate = date('Y-m-d H:i:s', strtotime('-10000 days'));
        $orderBy = 'song_uploaded';
        if (isset($_POST['offset'])) {
            $offset = $_POST['offset'];
            $data['songs'] = $this->Song_model->getSongs($maxDate, $orderBy, $this->limit, $offset);
            $this->load->view('includes/loop', $data);
        } else {
            $offset = 0;
            $data['songs'] = $this->Song_model->getSongs($maxDate, $orderBy, $this->limit, $offset);
            $this->load->view('base', $data);
        }
	}

	public function popular() {
		$maxDate = date('Y-m-d H:i:s', strtotime('-7 days'));
		$orderBy = 'song_favorites';
		$limit = 10;
		$offset = 0;
        $data['rows'] = $this->Song_model->getSongs($maxDate, $orderBy, $limit, $offset);
        $data['title'] = 'Popular';
        $this->load->view('popular', $data);
	}

	public function channels() {
        $data['rows'] = $this->Channel_model->getChannels('1');
        $data['title'] = 'Channels';
        $this->load->view('channels', $data);
	}

	// public function staffpicks() {
	// 	$userId = '1';

	// 	$config = array();
 //        $config['base_url'] = base_url().'site/favorites';
 //        $config['total_rows'] = $this->Favorite_model->countFavorties($userId);
 //        $config['per_page'] = 50;
 //        $config['uri_segment'] = 3;

 //        $config['full_tag_open'] = '<div id="pagination">';
 //        $config['full_tag_close'] = '</div>';

 //        $config['first_link'] = 'First';
 //        $config['last_link'] = 'Last';

 //        $config['num_tag_open'] = '';
 //        $config['num_tag_close'] = '';

 //        $config['prev_tag_open'] = '';

 //        $config['cur_tag_open'] = '<b>';
 //        $config['cur_tag_close'] = '</b>';

 //        $config['prev_link'] = false;
 //        $config['next_link'] = false;

 //        $this->pagination->initialize($config);

 //        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

 //        $data['rows'] = $this->Song_model->getFavorites($userId, $config['per_page'], $page);
 //        $data['title'] = 'Staff Picks';
 //        $data['links'] = $this->pagination->create_links();

 //        $this->load->view('base', $data);
	// }

	public function favorites($offset) {
		if ($this->session->userdata('user_id')) {

			$userId = $this->session->userdata('user_id');

			$config = array();
	        $config['base_url'] = base_url().'site/favorites';
	        $config['total_rows'] = $this->Favorite_model->countFavorties($userId);
	        $config['per_page'] = 50;
	        $config['uri_segment'] = 3;

	        $config['full_tag_open'] = '<div id="pagination">';
	        $config['full_tag_close'] = '</div>';

	        $config['first_link'] = 'First';
	        $config['last_link'] = 'Last';

	        $config['num_tag_open'] = '';
	        $config['num_tag_close'] = '';

	        $config['prev_tag_open'] = '';

	        $config['cur_tag_open'] = '<b>';
	        $config['cur_tag_close'] = '</b>';

	        $config['prev_link'] = false;
	        $config['next_link'] = false;

	        $this->pagination->initialize($config);

	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	        $data['rows'] = $this->Song_model->getFavorites($userId, $config['per_page'], $page);
	        $data['title'] = 'Favorites';
	        $data['links'] = $this->pagination->create_links();

	        $this->load->view('base', $data);

	    } else {
	    	$this->load->view('login');
	    }
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