<?php

class Channel_model extends CI_Model {

    public function getChannels($status) {
        $this->db->where('channel_status', $status);
        $query = $this->db->get('channels');
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getChannelId($column, $data) {
        $this->db->where($column, $data);
        $query = $this->db->get('channels');
        if($query->num_rows() == 1) {
            $row = $query->row();
            return $row->channel_id;
        }
    }

    public function getChannelName($column, $data) {
        $this->db->where($column, $data);
        $query = $this->db->get('channels');
        if($query->num_rows() == 1) {
            $row = $query->row();
            return $row->channel_name;
        }
    }

    public function getChannelBySlug($slug, $limit, $offset) {
        $this->db->where('song_channel_slug', $slug);
        $this->db->limit($limit, $offset);
        $query = $this->db->get('songs');
        if($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
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

}

?>