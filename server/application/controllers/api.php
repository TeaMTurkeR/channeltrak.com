<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class API extends CI_Controller {


    public function channels() { // Array of channels

    	$data['channels'] = $this->Channel_model->get(array('approved' => '1'));

    	echo json_encode($data);

    }

    public function channel($key) { // Individual channel

        if (is_numeric($key)) {

            $data['channel'] = $this->Channel_model->get(array('id' => $key));
            $data['traks'] = $this->Trak_model->get(array('channel_id' => $key));

        } else {

            $data['channel'] = $this->Channel_model->get(array('slug' => $key));
    	    $data['traks'] = $this->Trak_model->get(array('channel_id' => $data['channel']->id));

        }

    	echo json_encode($data);

    }

    public function trak($key) { // Individual trak

        if ($key == 'random') {

            $data['trak'] = $this->Trak_model->random();

        } elseif (is_numeric($key)) {

            $data['trak'] = $this->Trak_model->get(array('id' => $key));

        } else {

            $data['trak'] = $this->Trak_model->get(array('slug' => $key));

        }

    	echo json_encode($data);

    }

    public function traks() {

        $data['traks'] = $this->Trak_model->get(array('id >' => '0'));

        echo json_encode($data);

    }

    public function latest() {

        $data['traks'] = $this->Trak_model->latest();

        echo json_encode($data);

    }

    public function popular() {

        $data['traks'] = $this->Trak_model->popular();

        echo json_encode($data);

    }

}