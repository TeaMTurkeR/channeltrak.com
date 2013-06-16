<?php

class Favorite_model extends CI_Model {

	public function countUserFavorties($userId) {
		$this->db->where('user_id', $userId);
		$query = $this->db->get('favorites');
		return $query->num_rows();
	}

	public function countChannelFavorites($slug) {
		$this->db->where('song_channel_slug', $slug);
		$query = $this->db->get('songs');
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$this->db->where('song_id', $row->song_id);
				$query = $this->db->get('favorites');
				$i = $i+$query->num_rows();
			}
			return $i;
		}
	}

	public function addFavorite($data) {
		$this->db->insert('favorites', $data);
		if($this->db->affected_rows() > 0) {
			return true;
		}
	} 

	public function removeFavorite($songId) {
		$this->db->where('song_id', $songId);
		$this->db->delete('favorites');
		if($this->db->affected_rows() > 0) {
			return true;
		}
	} 

	public function checkFavorites($userId, $songId) {
		$this->db->where('user_id', $userId);
		$this->db->where('song_id', $songId);
		$query = $this->db->get('favorites');
		if($query->num_rows() !== 0){
			return true;
		}
	}

}

?>