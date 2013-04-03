<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Channelmodel');
        $this->load->model('Songmodel');
    }

	public function index() {
		$limit = 20;
        $data['rows'] = $this->Songmodel->getSongs($limit);
        $this->load->view('home', $data);
	}

	public function join() {
		$this->load->view('join');
	}

	public function login() {
		$this->load->view('login');
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