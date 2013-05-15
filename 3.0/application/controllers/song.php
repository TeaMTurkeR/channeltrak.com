<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Song extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Songmodel');
        $this->load->model('Favoritemodel');
    }

    public function index($slug) {
        $data['row'] = $this->Songmodel->getSongBySlug($slug);
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

	            $this->Songmodel->updateSong($songId, $data);

	            $data = array(
	            	'user_id' => $userId,
	            	'song_id' => $songId
	            );
	            $this->Favoritemodel->addFavorite($data);
	        } else {

	        	$userId = $this->session->userdata('user_id');
	            $songId = $this->input->post('songId');
	            $newCount = $this->input->post('newCount');


	            $data = array(
	               'song_favorites' => $newCount
	            );
	            $this->Songmodel->updateSong($songId, $data);
	            $this->Favoritemodel->removeFavorite($songId);
	        } 

        } else {
        	print 'not working';
        }
	}
}

?>