<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channels extends CI_Controller {

    public function index() { // APPROVED CHANNELS

        $data = $this->Channel_model->get(array('approved' => 1));

        echo json_encode($data);

    }

    public function test() {

        $channel_url = 'http://www.youtube.com/user/getit/stuff';
 
        $array = preg_split("/[^A-Za-z0-9 ]/", substr($channel_url, strrpos( $channel_url, 'user/' ) + 5));

        $youtube_title = $array[0];

        echo $youtube_title;

    }

    // curl -i -X POST -H 'Content-Type: application/json' -d '{"channel_url": "http://www.youtube.com/user/liquicity"}' http://localhost:8000/channeltrak.com/server/channels

    public function create() {

        $decoded_channel = json_decode(file_get_contents('php://input'), TRUE);

        $channel_url = $decoded_channel['channel_url'];

        $array = preg_split("/[^A-Za-z0-9 ]/", substr($channel_url, strrpos( $channel_url, 'user/' ) + 5));

        $youtube_title = $array[0];

        $url = 'http://gdata.youtube.com/feeds/api/users/'.$youtube_title.'?v=2&format=5&prettyprint=true&alt=json';

        $json = file_get_contents($url);
        $jsonOutput = json_decode($json);

        // var_dump($jsonOutput);

        $title = $jsonOutput->entry->{'yt$username'}->display;
        $youtube_title = $jsonOutput->entry->{'yt$username'}->{'$t'}; // GET OFFICAL TITLE
        $youtube_id = $jsonOutput->entry->{'yt$channelId'}->{'$t'};
        $published = $jsonOutput->entry->published->{'$t'};

        $slug = url_title($title, '-', TRUE);

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
            header('HTTP', TRUE, 404);
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
            header('HTTP', TRUE, 404);
        }

    }

    public function import($id) {

        $channel = $this->Channel_model->get(array('id' => $id));
        
        $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=".$channel->youtube_id."&maxResults=1&key=AIzaSyCkoszshUaUgV-2CrviQI0I4pTkd8j61gc";
        $json = file_get_contents($url);
        $jsonOutput = json_decode($json);

        $limit = $jsonOutput->pageInfo->resultsPerPage;
        $total = $jsonOutput->pageInfo->totalResults;

        $totalPages = ceil($total / $limit);

        $counter = 0;

        for ( $page_number = 1; $page_number < $totalPages; $page_number++) { // Paginate

            if ($page_number > 1) {
                $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=".$channel->youtube_id."&pageToken=".$token."&maxResults=50&key=AIzaSyCkoszshUaUgV-2CrviQI0I4pTkd8j61gc";
            } else {
                $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=".$channel->youtube_id."&maxResults=50&key=AIzaSyCkoszshUaUgV-2CrviQI0I4pTkd8j61gc";
            }

            $json = file_get_contents($url);
            $jsonOutput = json_decode($json);

            $result = '<p>'.$channel->title.' is up to date!</p>';

            for ( $item_number = 0; $item_number < count($jsonOutput->items); $item_number++ ){

                if (isset($jsonOutput->items[$item_number]->id->videoId) && $this->Trak_model->is_new($jsonOutput->items[$item_number]->id->videoId) ) {

                    $title = $jsonOutput->items[$item_number]->snippet->title;
                    $slug = url_title($title, '-', TRUE);
                    $youtube_id = $jsonOutput->items[$item_number]->id->videoId;
                    $published = $jsonOutput->items[$item_number]->snippet->publishedAt;
                    $current_time = date('Y-m-d H:i:s');

                    $data = array(
                        'title' => $title,
                        'slug' => $slug,
                        'youtube_id' => $youtube_id,            
                        'channel_id' => $id,
                        'color_sample' => $this->Trak_model->sample_color($youtube_id),
                        'published' => $published,
                        'created' => date('Y-m-d H:i:s'),
                        'updated' => date('Y-m-d H:i:s')
                    );

                    if (!$this->Trak_model->create($data)) {
                        $result = '<p>Error at '.$title.'</p>';
                        break 2;
                    }

                    $counter++;

                    $result = '<p>'.$counter . ' new traks added to '.$channel->title.'!</p>';

                }

            }

            if (isset($jsonOutput->nextPageToken)) {

                $token = $jsonOutput->nextPageToken;

            } else {

                break 1;

            }

        }

        echo $result;
        // $path = $this->config->base_url().'assets/uploads';
        // $this->load->helper('file');
        // delete_files($path, true);
    }

    public function import_all() {

        $channels = $this->Channel_model->get(array('approved' => 1));

        foreach ($channels as $channel) {
            $this->import($channel->id);
        }
    }

}