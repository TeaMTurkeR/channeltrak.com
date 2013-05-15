<?php

class Favoritemodel extends CI_Model {

	public function countFavorties($userId) {
		$this->db->where('user_id', $userId);
        return $this->db->count_all('favorites');
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