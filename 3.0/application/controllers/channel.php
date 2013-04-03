<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channel extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Channelmodel');
    }

	public function submit() {
		$name = $this->input->post('name');
        $url = $this->input->post('url');
        $data = array(
        	'channel_name' => $this->input->post('name'),
            'channel_yt_id' => $this->input->post('url')
        );
        $this->Channelmodel->submitChannel($data);
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

        $this->Channelmodel->updateChannel($id, $data);
        $this->import();
	}

    public function import() {

        $channel = $this->Channelmodel->getChannels('1');
        foreach ($channel as $channel){
        
            $id = $channel->channel_id;

            for ( $i = 1; $i <= 500; $i += 50) {

                $url = "http://gdata.youtube.com/feeds/api/users/".$channel->channel_yt_id."/uploads?v=2&alt=jsonc&max-results=50&start-index=".$i."&format=5";
                $json = file_get_contents($url);
                $jsonOutput = json_decode($json);

                if (isset($jsonOutput->data->items)) {

                    $this->load->model('Songmodel');

                    foreach ( $jsonOutput->data->items as $song ){

                        $unique = $this->Songmodel->checkDuplicates($song->id);

                        if ($unique) {
                            $slug = url_title($song->title, 'dash', true);

                            $data = array(
                                'song_slug' => $slug,
                                'song_title' => $song->title,
                                'song_yt_id' => $song->id,
                                'song_channel_id' => $id,
                                'song_uploaded' => $song->uploaded,
                                'song_imported' => date('Y-m-d H:i:s')
                            );
                            
                            $this->Songmodel->addSong($data);
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