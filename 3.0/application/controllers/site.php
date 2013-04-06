<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Channelmodel');
        $this->load->model('Usermodel');
        $this->load->model('Songmodel');
    }

	public function index() {
		$maxDate = date('Y-m-d H:i:s', strtotime('-100 days'));
		$orderBy = 'song_uploaded';
		$limit = 20;
        $data['rows'] = $this->Songmodel->getSongs($maxDate, $orderBy, $limit);
        $this->load->view('latest', $data);
	}

	public function popular() {
		$maxDate = date('Y-m-d H:i:s', strtotime('-7 days'));
		$orderBy = 'song_favorites';
		$limit = 10;
        $data['rows'] = $this->Songmodel->getSongs($maxDate, $orderBy, $limit);
        $this->load->view('popular', $data);
	}

	public function staffpicks() {
		$userId = '1';
        $data['rows'] = $this->Songmodel->getFavorites($userId);
        $this->load->view('latest', $data);
	}

	public function favorites() {
		if ($this->session->userdata('user_id')) {
			$userId = $this->session->userdata('user_id');
	        $data['rows'] = $this->Songmodel->getFavorites($userId);
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