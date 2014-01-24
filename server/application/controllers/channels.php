<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channels extends CI_Controller {

    public function index() { // APPROVED CHANNELS

        $data = $this->Channel_model->channels(array('approved' => 1));

        echo json_encode($data);

    }

    public function create() {

        $decoded_channel = json_decode(file_get_contents('php://input'), TRUE);

        $title = $decoded_channel['title'];
        $slug = url_title($title);
        $channel_url = $decoded_channel['channel_url'];
        $youtube_title = explode('/', substr( $url, strrpos( $channel_url, 'user/' )+5 ), 2)[0];

        $url = 'http://gdata.youtube.com/feeds/api/users/'.$youtube_title.'?v=2&format=5&prettyprint=true&alt=json';

        $json = file_get_contents($url);
        $jsonOutput = json_decode($json);

        $youtube_title = $jsonOutput->entry->title->{'$t'};
        $youtube_id = $jsonOutput->entry->{'yt$channelId'}->{'$t'};
        $published = $jsonOutput->entry->published->{'$t'};
        
        $data = array(
            'title' => $title,
            'slug' => $slug,
            'youtube_id' => $youtube_id,            
            'youtube_title' => $youtube_title,
            'approved' => 0, // NOT APPROVED
            'published' => $published,
            'created' => date('Y-m-d H:i:s'),
            'updated' => date('Y-m-d H:i:s')
        );

        if ($id = $this->Channel_model->create($data)) {
            echo json_encode($id);
        } else {
            header('HTTP', TRUE, 401);
        }

    }

    public function get($id) {

        if (is_numeric($id)) {
            $data = $this->Channel_model->get(array('id' => $id));
        } else {
            $data = $this->Channel_model->get(array('slug' => $id));
        }

        echo json_encode($data);

    }

    public function update($id) {

        $decoded_channel = json_decode(file_get_contents('php://input'), TRUE);

        $email = $decoded_channel['email'];
        $password = md5($decoded_channel['password']);
        
        $data = array(
            'email' => $email,
            'password' => $password,
            'created' => date('Y-m-d H:i:s'),
            'updated' => date('Y-m-d H:i:s')
        );

        if ($this->Channel_model->update($data)) {
            // RETRUN SOMETHING HERE
        } else {
            header('HTTP', TRUE, 401);
        }

    }

    // public function import() {
        
    //     $this->Channel_model->restricted();

    //     $channels = $this->Channel_model->get(array('approved' => 1));
    //     foreach ($channels as $channel){
        
    //         $channel_id = $channel->id;
    //         $youtube_id = $channel->youtube_id;

    //         $url = "http://gdata.youtube.com/feeds/api/users/".$youtube_id."/uploads?v=2&alt=jsonc&max-results=1&format=5&prettyprint=true";
    //         $json = file_get_contents($url);
    //         $jsonOutput = json_decode($json);

    //         for ( $i = 1; $i <= $jsonOutput->data->totalItems; $i += $jsonOutput->data->itemsPerPage) {

    //             $url = "http://gdata.youtube.com/feeds/api/users/".$youtube_id."/uploads?v=2&alt=jsonc&max-results=50&start-index=".$i."&format=5";
    //             $json = file_get_contents($url);
    //             $jsonOutput = json_decode($json);

    //             if (isset($jsonOutput->data->items)) {

    //                 foreach ( $jsonOutput->data->items as $trak ){

    //                     if ($this->Trak_model->unique($trak->id)) {

    //                         $data = array(
    //                             'title' => $trak->title,
    //                             'slug' => url_title($trak->title, 'dash', true),
    //                             'youtube_id' => $trak->id,
    //                             'channel_id' => $channel_id,
    //                             'views' => $trak->viewCount,
    //                             'uploaded' => $trak->uploaded,
    //                             'imported' => date('Y-m-d H:i:s'),
    //                             'updated' => date('Y-m-d H:i:s')
    //                         );
                            
    //                         $this->Trak_model->create($data);

    //                     } else {
    //                     	$this->Channel_model->update($channel_id, array('updated' => date('Y-m-d H:i:s')));
    //                         break;
    //                     }
    //                 }

    //             } else {
    //                 print '<p style="color:red">Done with '.$channel_id.'</p>';
    //                 $this->Channel_model->update($channel_id, array('updated' => date('Y-m-d H:i:s')));
    //                 break;
    //             }
    //         }
    //     }
    // }

}