<?php

class Song_model extends CI_Model {

	public function getSongs($array, $order, $limit, $offset) {
		$this->db->where($array);
        $this->db->limit($limit, $offset);
		$this->db->order_by($order, 'DESC');
        $query = $this->db->get('songs');
        if($query->num_rows() <= $limit && $query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getSong($array) {
        $this->db->where($array);
        $query = $this->db->get('songs');
        if($query->num_rows() == 1) {
            $row = $query->row();
            return $row;
        }
    }

    public function getFavorites($userId, $limit, $offset) {
        $this->db->select('*');
        $this->db->from('songs');
        $this->db->join('favorites', 'favorites.song_id = songs.song_id');
        $this->db->where('favorites.user_id', $userId);
        $this->db->limit($limit, $offset);
        $this->db->order_by('favorites.favorite_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function addSong($data) {
        $this->db->insert('songs', $data);
        if($this->db->affected_rows() > 0) {
            return true;
        }
    } 

    public function deleteSong($array) {
        $this->db->where($array);
        $this->db->delete('songs'); 
    }

    public function checkDuplicates($ytId) {
        $this->db->where('song_yt_id', $ytId);
        $query = $this->db->get('songs');
        if($query->num_rows() == 0){
            return true;
        }
    }

    public function songCount($slug) {
        $this->db->where('song_channel_slug', $slug);
        $query = $this->db->get('songs');
        return $query->num_rows();
    }

    public function updateSong($songId, $data) {
        $this->db->where('song_id', $songId);
        $this->db->update('songs', $data);
    }

    public function updateSongChannel($current, $data) {
        var_dump($current);
        $this->db->where('song_channel_name', $current);
        $this->db->update('songs', $data);
    }

}

?>