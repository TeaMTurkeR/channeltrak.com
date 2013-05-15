<?php

class Songmodel extends CI_Model {

    public function countSongs() {
        return $this->db->count_all('songs');
    }

    public function countChannelSongs($slug) {
        $this->db->where('song_channel_slug', $slug);
        $query = $this->db->get('songs');
        return $query->num_rows();
    }

	public function getSongs($maxDate, $orderBy, $limit, $offset) {
		$this->db->where('song_imported >', $maxDate);
        $this->db->limit($limit, $offset);
		$this->db->order_by($orderBy, 'DESC');
        $query = $this->db->get('songs');
        if($query->num_rows() <= $limit && $query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getSongBySlug($slug) {
        $this->db->where('song_slug', $slug);
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

	public function checkDuplicates($ytId) {
		$this->db->where('song_yt_id', $ytId);
		$query = $this->db->get('songs');
		if($query->num_rows() == 0){
			return true;
		}
	}

	public function updateSong($songId, $data) {
		$this->db->where('song_id', $songId);
		$this->db->update('songs', $data);
	}

}

?>