<?php

class Channelmodel extends CI_Model {

	public function submitChannel($data) {
        $this->db->insert('channels', $data);
        return;
    } 

    public function getChannels($status) {
        $this->db->where('channel_status', $status);
        $query = $this->db->get('channels');
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function updateChannel($id, $data) {
        $this->db->where('channel_id', $id);
        $this->db->update('channels', $data);
        return;
    }

}

?>