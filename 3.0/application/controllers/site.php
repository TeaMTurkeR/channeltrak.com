<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Channelmodel');
        $this->load->model('Usermodel');
        $this->load->model('Songmodel');
        $this->load->model('Favoritemodel');
    }

	public function index() {
		$maxDate = date('Y-m-d H:i:s', strtotime('-100 days'));
		$orderBy = 'song_uploaded';

		$config = array();
        $config['base_url'] = base_url().'index.php';
        $config['total_rows'] = $this->Songmodel->countSongs();
        $config['per_page'] = 50;
        $config['uri_segment'] = 1;
        $config['num_links'] = 2;

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

        $page = ($this->uri->segment(1)) ? $this->uri->segment(1) : 0;

        $data['rows'] = $this->Songmodel->getSongs($maxDate, $orderBy, $config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();
        $this->load->view('latest', $data);
	}

	public function popular() {
		$maxDate = date('Y-m-d H:i:s', strtotime('-7 days'));
		$orderBy = 'song_favorites';
		$limit = 10;
		$offset = 0;
        $data['rows'] = $this->Songmodel->getSongs($maxDate, $orderBy, $limit, $offset);
        $this->load->view('popular', $data);
	}

	public function channels() {
        $data['rows'] = $this->Channelmodel->getChannels('1');
        $this->load->view('channels', $data);
	}

	public function staffpicks() {
		$userId = '1';

		$config = array();
        $config['base_url'] = base_url().'index.php/site/favorites';
        $config['total_rows'] = $this->Favoritemodel->countFavorties($userId);
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

        $data['rows'] = $this->Songmodel->getFavorites($userId, $config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('latest', $data);
	}

	public function favorites() {
		if ($this->session->userdata('user_id')) {

			$userId = $this->session->userdata('user_id');

			$config = array();
	        $config['base_url'] = base_url().'index.php/site/favorites';
	        $config['total_rows'] = $this->Favoritemodel->countFavorties($userId);
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

	        $data['rows'] = $this->Songmodel->getFavorites($userId, $config['per_page'], $page);
	        $data['links'] = $this->pagination->create_links();

	        $this->load->view('latest', $data);

	    } else {
	    	$this->load->view('login');
	    }
	}

	public function settings() {
		if ($this->session->userdata('user_id')) {
			$userId = $this->session->userdata('user_id');
	        $data['row'] = $this->Usermodel->getUser($userId);
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
		$data['submitted'] = $this->Channelmodel->getChannels('0');
		$data['approved'] = $this->Channelmodel->getChannels('1');
		$this->load->view('admin', $data);
	}
}

?>