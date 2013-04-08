<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channel extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Channelmodel');
        $this->load->model('Songmodel');
    }

    public function index($slug) {

        $config = array();
        $config['base_url'] = base_url().'index.php/channel/'.$this->uri->segment(2);
        $config['total_rows'] = $this->Songmodel->countChannelSongs($slug);
        $config['per_page'] = 50;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';

        $config['num_tag_open'] = '';
        $config['num_tag_close'] = '';

        $config['prev_tag_open'] = '';

        $config['cur_tag_open'] = '<b>';
        $config['cur_tag_close'] = '</b>';

        $config['prev_link'] = false;
        $config['next_link'] = false;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['rows'] = $this->Channelmodel->getChannelBySlug($slug, $config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('latest', $data);
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
        
            $channelName = $channel->channel_name;
            $channelSlug = $channel->channel_slug;

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
                                'song_channel_name' => $channelName,
                                'song_channel_slug' => $channelSlug,
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