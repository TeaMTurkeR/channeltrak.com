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

        $data['songs'] = $this->Song_model->getSongs($where, $order, $limit, $this->offset);
        $this->load->view('main', $data);

	}

	public function directory() {
    	$this->load->model('Channel_model');
    	$status = '1';
        $data['channels'] = $this->Channel_model->getChannels($status);
        $data['title'] = 'Directory';
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




}

?>