<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Traks extends CI_Controller {

    public function index() {

        redirect('latest');

    }

	public function trak($key) {

        if ($key == 'random') {

            $data['trak'] = $this->Trak_model->random();

        } elseif (is_numeric($key)) {

            $data['trak'] = $this->Trak_model->get(array('id' => $key));

        } else {

            $data['trak'] = $this->Trak_model->get(array('slug' => $key));

        }

    	$this->load->view('frontend/trak', $data);

    }

    public function latest() {

    	$data['title'] = 'Latest';
        $data['traks'] = $this->Trak_model->get(array('id >' => '0'));

        $this->load->view('frontend/traklist', $data);

    }

    public function popular() {

        $data['title'] = 'Popular';
        $data['traks'] = $this->Trak_model->popular();

        $this->load->view('frontend/traklist', $data);

    }
}