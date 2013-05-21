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

    public function getChannelImage($slug) {
        $this->db->where('song_channel_slug', $slug);
        $this->db->limit(1);
        $query = $this->db->get('songs');
        if($query->num_rows() == 1) {
            $row = $query->row();
            return $row->song_yt_id;
        }
    }

}

?>