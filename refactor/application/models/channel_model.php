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

}

?>