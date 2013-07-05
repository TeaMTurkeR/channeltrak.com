<?php

class Channel_model extends CI_Model {

    public function getChannels($status) {
        $this->load->model('Song_model');
        $this->load->model('Favorite_model');

        $this->db->where('channel_status', $status);
        $query = $this->db->get('channels');
        if($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $row->channel_tracks = $this->Song_model->songCount($row->channel_slug);
                $row->channel_favorites = $this->Favorite_model->countChannelFavorites($row->channel_slug);
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getChannel($key, $value) {
        $this->load->model('Song_model');
        $this->load->model('Favorite_model');

        $this->db->where($key, $value);
        $query = $this->db->get('channels');
        if($query->num_rows() == 1) {
            $row = $query->row();
            $row->channel_tracks = $this->Song_model->songCount($row->channel_slug);
            $row->channel_favorites = $this->Favorite_model->countChannelFavorites($row->channel_slug);
            return $row;
        }
    }

    public function getChannelImage($id) {
        $this->db->where('song_id', $id);
        $query = $this->db->get('songs');
        if($query->num_rows() == 1) {
            $row = $query->row();
            return $row->song_yt_id;
        }
    }

    public function submitChannel($data) {
        $this->db->insert('channels', $data);
        return;
    } 

    public function updateChannel($id, $data) {
        $this->db->where('channel_id', $id);
        $this->db->update('channels', $data);
        return;
    }

    public function deleteChannel($slug) {
        $this->db->where('channel_slug', $slug);
        $this->db->delete('channels');
    }

}

?>