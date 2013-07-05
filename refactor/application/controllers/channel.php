<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channel extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Channel_model');
    }

    public function submit() {
        $name = $this->input->post('name');
        $slug = url_title($name, 'dash', true);
        $youtube = $this->input->post('youtube');
        $facebook = $this->input->post('facebook');
        $twitter = $this->input->post('twitter');
        $website = $this->input->post('website');

        $data = array(
            'channel_name' => $name,
            'channel_slug' => $slug,
            'channel_yt_url' => $youtube,
            'channel_fb_url' => $facebook,
            'channel_tw_url' => $twitter,
            'channel_web_url' => $website
        );
        $this->Channel_model->submitChannel($data);

        $data['title'] = 'Submit';
        $data['subtitle'] = 'Submit a new Youtube channel';
        $data['success'] = 'Channel submitted successfully!';
        $this->load->view('submit', $data);
    }

    public function approve() {
        if ($this->session->userdata('user_name') == 'Admin') {
            $id = $this->input->post('id');
            $slug = url_title($this->input->post('name'), 'dash', true);
            $ytId = $this->input->post('yt-id');

            $data = array(
                'channel_name' => $this->input->post('name'),
                'channel_slug' => $slug,
                'channel_yt_id' => $ytId,
                'channel_yt_url' => $this->input->post('youtube'),
                'channel_fb_url' => $this->input->post('facebook'),
                'channel_tw_url' => $this->input->post('twitter'),
                'channel_web_url' => $this->input->post('website'),
                'channel_approved' => date('Y-m-d H:i:s'),
                'channel_status' => '1'
            );

            $this->Channel_model->updateChannel($id, $data);
            $this->import();
            redirect('/edit/'.$slug, 'refresh');
        } else {
            redirect('latest');
        }
    }

    public function update() {
        if ($this->session->userdata('user_name') == 'Admin') {
            
            $id = $this->input->post('id');
            $current = $this->input->post('current');
            $name = $this->input->post('name');
            $slug = url_title($this->input->post('name'), 'dash', true);
            $ytId = $this->input->post('yt-id');

            if ( $current == $name ) {

                $data = array(
                    'channel_yt_id' => $ytId,
                    'channel_yt_url' => $this->input->post('youtube'),
                    'channel_fb_url' => $this->input->post('facebook'),
                    'channel_tw_url' => $this->input->post('twitter'),
                    'channel_web_url' => $this->input->post('website'),
                    'channel_cover_song_id' => $this->input->post('cover-id'),
                    'channel_approved' => date('Y-m-d H:i:s')
                );

                $this->Channel_model->updateChannel($id, $data);

            } else {

                $data = array(
                    'channel_name' => $name,
                    'channel_slug' => $slug,
                    'channel_yt_id' => $ytId,
                    'channel_yt_url' => $this->input->post('youtube'),
                    'channel_fb_url' => $this->input->post('facebook'),
                    'channel_tw_url' => $this->input->post('twitter'),
                    'channel_web_url' => $this->input->post('website'),
                    'channel_cover_song_id' => $this->input->post('cover-id'),
                    'channel_approved' => date('Y-m-d H:i:s')
                );

                $song = array(
                    'song_channel_name' => $name,
                    'song_channel_slug' => $slug
                );

                $this->Channel_model->updateChannel($id, $data);
                $this->Song_model->updateSongChannel($current, $song);

            }

            redirect('edit/'.$slug, 'refresh');
        } else {
            redirect('latest');
        }
    }

    public function delete($slug) {
        if ($this->session->userdata('user_name') == 'Admin') {
            $this->Channel_model->deleteChannel($slug);

            $where = array(
                'song_channel_slug' => $slug
            );

            $this->Song_model->deleteSong($where);

            redirect('admin', 'refresh');
        } else {
            redirect('latest');
        }
    }

    public function import() {
        $channel = $this->Channel_model->getChannels('1');
        foreach ($channel as $channel){
        
            $channelName = $channel->channel_name;
            $channelSlug = $channel->channel_slug;

            for ( $i = 1; $i <= 1000; $i += 50) {

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
                            print '<p style="color:green">New: '.$song->title.' - '.$channelName.'</p>';
                        } else {
                            break;
                        }
                    }
                } else {
                    print '<p style="color:red">Nothing from: '.$channelName.'</p>';
                    break;
                }
            }
        }
    }
}

?>