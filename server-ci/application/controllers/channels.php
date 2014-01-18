<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channels extends CI_Controller {

    public function index() { // Array of channels

        $data['channels'] = $this->Channel_model->channels(array('approved' => 1));

        $this->load->view('frontend/channels', $data);

    }

    public function channel($key) { // Individual channel

        if (is_numeric($key)) {

            $data['channel'] = $this->Channel_model->get(array('id' => $key));
            $data['traks'] = $this->Trak_model->get(array('channel_id' => $key));

        } else {

            $data['channel'] = $this->Channel_model->get(array('slug' => $key));
            $data['traks'] = $this->Trak_model->get(array('channel_id' => $data['channel']->id));

        }

        $data['title'] = $data['channel']->title;

        $this->load->view('frontend/traklist', $data);

    }    

    public function create() {

        $this->User_model->restricted();

    	$title = $this->input->post('title');
        $youtube_id = $this->input->post('youtube_id');

        $url = "http://gdata.youtube.com/feeds/api/users/".$youtube_id."?alt=json";
        $json = file_get_contents($url);
        $jsonOutput = json_decode($json);

        $started = $jsonOutput->entry->published->{'$t'};
        
        $data = array(
            'title' => $title,
            'slug' => url_title($title, 'dash', true),
            'youtube_id' => $youtube_id,
            'approved' => '1',
            'started' => $started,
            'added' => date('Y-m-d H:i:s')
        );

        if ($this->Channel_model->create($data)) {

            redirect('dashboard');

        }

    }

    public function edit($id) {

        $this->User_model->restricted();

    	$data['title'] = 'Edit';
        $data['channel'] = $this->Channel_model->get(array('id' => $id));
        $data['traks'] = $this->Trak_model->get(array('channel_id' => $id));

        $this->load->view('admin/edit', $data);
    } 

    public function import() {
        
        $this->User_model->restricted();

        $channels = $this->Channel_model->get(array('approved' => 1));
        foreach ($channels as $channel){
        
            $channel_id = $channel->id;
            $youtube_id = $channel->youtube_id;

            $url = "http://gdata.youtube.com/feeds/api/users/".$youtube_id."/uploads?v=2&alt=jsonc&max-results=1&format=5&prettyprint=true";
            $json = file_get_contents($url);
            $jsonOutput = json_decode($json);

            for ( $i = 1; $i <= $jsonOutput->data->totalItems; $i += $jsonOutput->data->itemsPerPage) {

                $url = "http://gdata.youtube.com/feeds/api/users/".$youtube_id."/uploads?v=2&alt=jsonc&max-results=50&start-index=".$i."&format=5";
                $json = file_get_contents($url);
                $jsonOutput = json_decode($json);

                if (isset($jsonOutput->data->items)) {

                    foreach ( $jsonOutput->data->items as $trak ){

                        if ($this->Trak_model->unique($trak->id)) {

                            $data = array(
                                'title' => $trak->title,
                                'slug' => url_title($trak->title, 'dash', true),
                                'youtube_id' => $trak->id,
                                'channel_id' => $channel_id,
                                'views' => $trak->viewCount,
                                'uploaded' => $trak->uploaded,
                                'imported' => date('Y-m-d H:i:s'),
                                'updated' => date('Y-m-d H:i:s')
                            );
                            
                            $this->Trak_model->create($data);

                        } else {
                        	$this->Channel_model->update($channel_id, array('updated' => date('Y-m-d H:i:s')));
                            break;
                        }
                    }

                } else {
                    print '<p style="color:red">Done with '.$channel_id.'</p>';
                    $this->Channel_model->update($channel_id, array('updated' => date('Y-m-d H:i:s')));
                    break;
                }
            }
        }
    }

}