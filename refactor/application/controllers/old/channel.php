<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channel extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Channel_model');
        $this->load->model('Song_model');
    }

    public function index($slug) {

        $data['songs'] = $this->Channel_model->getChannelBySlug($slug, $config['per_page'], $page);
        $this->load->view('base', $data);
    }

	public function submit() {
		$name = $this->input->post('name');
        $url = $this->input->post('url');
        $data = array(
        	'channel_name' => $this->input->post('name'),
            'channel_yt_id' => $this->input->post('url')
        );
        $this->Channel_model->submitChannel($data);
        redirect('/', 'refresh');
    }

	public function approve() {
		$id = $this->input->post('id');
        $slug = url_title($this->input->post('name'), 'dash', true);
        $ytId = $this->input->post('yt-id');

        $data = array(
        	'channel_slug' => $slug,
        	'channel_name' => $this->input->post('name'),
            'channel_yt_id' => $ytId,
            'channel_status' => '1',
            'channel_approved' => date('Y-m-d H:i:s')
        );

        $this->Channel_model->updateChannel($id, $data);
        $this->import();
	}

    public function import() {

        $channel = $this->Channel_model->getChannels('1');
        foreach ($channel as $channel){
        
            $channelName = $channel->channel_name;
            $channelSlug = $channel->channel_slug;

            for ( $i = 1; $i <= 500; $i += 50) {

                $url = "http://gdata.youtube.com/feeds/api/users/".$channel->channel_yt_id."/uploads?v=2&alt=jsonc&max-results=50&start-index=".$i."&format=5";
                $json = file_get_contents($url);
                $jsonOutput = json_decode($json);

                if (isset($jsonOutput->data->items)) {

                    $this->load->model('Song_model');

                    foreach ( $jsonOutput->data->items as $song ){

                        $unique = $this->Song_model->checkDuplicates($song->id);

                        if ($unique) {
                            $slug = url_title($song->title, 'dash', true);

                            $data = array(
                                'song_slug' => $slug,
                                'song_title' => $song->title,
                                'song_yt_id' => $song->id,
                                'song_channel_name' => $channelName,
                                'song_channel_slug' => $channelSlug,
                                'song_uploaded' => $song->uploaded,
                                'song_imported' => date('Y-m-d H:i:s')
                            );
                            
                            $this->Song_model->addSong($data);
                            print '<p style="color:green">New: '.$song->title.'</p>';
                        } else {
                            break;
                        }
                    }
                } else {
                    break;
                }
            }
        }

    }

}

?>