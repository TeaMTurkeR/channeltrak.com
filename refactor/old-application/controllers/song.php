<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Song extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Song_model');
        $this->load->model('Favorite_model');
    }

    public function index($slug) {
        $data['row'] = $this->Song_model->getSongBySlug($slug);
        $this->load->view('single', $data);
    }

	public function favorite() {
		if (isset($_POST['songId']) && isset($_POST['newCount']) && isset($_POST['favorite'])) { 
            
			$favorite = $this->input->post('favorite');

			if($favorite == 'true') {

	            $userId = $this->session->userdata('user_id');
	            $songId = $this->input->post('songId');
	            $newCount = $this->input->post('newCount');


	            $data = array(
	               'song_favorites' => $newCount
	            );

	            $this->Song_model->updateSong($songId, $data);

	            $data = array(
	            	'user_id' => $userId,
	            	'song_id' => $songId
	            );
	            $this->Favorite_model->addFavorite($data);
	        } else {

	        	$userId = $this->session->userdata('user_id');
	            $songId = $this->input->post('songId');
	            $newCount = $this->input->post('newCount');


	            $data = array(
	               'song_favorites' => $newCount
	            );
	            $this->Song_model->updateSong($songId, $data);
	            $this->Favorite_model->removeFavorite($songId);
	        } 

        } else {
        	print 'not working';
        }
	}
}

?>