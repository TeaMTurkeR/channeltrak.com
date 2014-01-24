<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Traks extends CI_Controller {

    public function index() {

        if (isset($_GET['order']) && $_GET['order'] == 'latest' && !isset($_GET['channel'])) { // GET LATEST

            if (isset($_GET['offset'])) {
                
                $offset = $_GET['offset'];

            } else {

                $offset = 0;

            }

            $data = $this->Trak_model->get(array('id >' => 0), $offset);

            echo json_encode($data);

        } else if (isset($_GET['order']) && $_GET['order'] == 'latest' && isset($_GET['channel'])) { // GET CHANNEL

            if (isset($_GET['offset'])) {
                
                $offset = $_GET['offset'];

            } else {

                $offset = 0;

            }

            $id = $_GET['channel'];

            if (is_numeric($id)) {
            
                $data = $this->Trak_model->get(array('channel_id' => $id), $offset);
            
            } else {

                $channel = $this->Channel_model->get(array('slug' => $id));
                $data = $this->Trak_model->get(array('channel_id' => $channel->id), $offset);

            }

            echo json_encode($data);

        } else {

            echo 'Welcome to the Channeltrak API';

        }

    }

	public function get($id) {

        if (is_numeric($id)) {

            $data = $this->Trak_model->get(array('id' => $id), 0);

        } else if ($id == 'random') {

            $data = $this->Trak_model->random();

        } else {

            $data = $this->Trak_model->get(array('slug' => $id), 0);

        }

    	echo json_encode($data);

    }

}