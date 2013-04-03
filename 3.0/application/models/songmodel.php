<?php

class Songmodel extends CI_Model {

	public function getSongs($limit) {
        $query = $this->db->order_by('song_uploaded', 'desc')->get('songs', $limit);
        if($query->num_rows() <= $limit && $query->num_rows() > 0) {
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

}

?>