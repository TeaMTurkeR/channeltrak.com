<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seo extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Channel_model');
        $this->load->model('Song_model');
    }

	public function sitemap() {

        $data['channels'] = $this->Channel_model->getChannelUrls();
        $data['songs'] = $this->Song_model->getSongUrls();

        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view('sitemap', $data);

    }


}

?>