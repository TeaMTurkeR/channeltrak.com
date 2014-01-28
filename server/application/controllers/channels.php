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

    public function import($id) {

        $channel = $this->Channel_model->get(array('id' => $id));
        
        $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=".$channel->youtube_id."&maxResults=1&key=AIzaSyCkoszshUaUgV-2CrviQI0I4pTkd8j61gc";
        $json = file_get_contents($url);
        $jsonOutput = json_decode($json);

        $limit = $jsonOutput->pageInfo->resultsPerPage;
        $total = $jsonOutput->pageInfo->totalResults;

        $totalPages = ceil($total / $limit);

        for ( $page_number = 1; $page_number < $totalPages; $page_number++) { // Paginate

            if ($page_number > 1) {
                $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=".$channel->youtube_id."&pageToken=".$token."&maxResults=50&key=AIzaSyCkoszshUaUgV-2CrviQI0I4pTkd8j61gc";
            } else {
                $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=".$channel->youtube_id."&maxResults=50&key=AIzaSyCkoszshUaUgV-2CrviQI0I4pTkd8j61gc";
            }

            $json = file_get_contents($url);
            $jsonOutput = json_decode($json);

            $counter = 0;
            $result = '<p>Up to date!</p>';

            for ( $item_number = 0; $item_number < count($jsonOutput->items); $item_number++ ){

                if (isset($jsonOutput->items[$item_number]->id->videoId) && $this->Trak_model->is_new($jsonOutput->items[$item_number]->id->videoId) ) {

                    $title = $jsonOutput->items[$item_number]->snippet->title;
                    $slug = url_title($title);
                    $youtube_id = $jsonOutput->items[$item_number]->id->videoId;
                    $published = $jsonOutput->items[$item_number]->snippet->publishedAt;
                    $current_time = date('Y-m-d H:i:s');

                    $data = array(
                        'title' => $title,
                        'slug' => $slug,
                        'youtube_id' => $youtube_id,            
                        'channel_id' => $channel->youtube_id,
                        'published' => $published,
                        'created' => date('Y-m-d H:i:s'),
                        'updated' => date('Y-m-d H:i:s')
                    );

                    if ($id = $this->Trak_model->create($data)) {
                        echo json_encode($id);
                    } else {
                        header('HTTP', TRUE, 401);
                        echo '<p>Error at '.$title.'</p>';
                        break;
                    }

                    $counter++;

                    $result = '<p>'.$counter . ' new traks added!</p>';

                }

            }

            if (isset($jsonOutput->nextPageToken)) {

                $token = $jsonOutput->nextPageToken;

            } else {

                break;

            }

        }

        echo $result;
    }

    public function import_all() {

        $channels = $this->Channel_model->get(array('approved' => 1));

        foreach ($channels as $channel) {
            $this->import($channel->id);
        }
    }

}