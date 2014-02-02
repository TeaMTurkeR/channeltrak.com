<?php

class Trak_model extends CI_Model {

    public function create($data) {

        $this->db->insert('traks', $data);

        if ($this->db->affected_rows() > 0) {

            return $this->db->insert_id();

        } else {

            return false;
        
        }
    }

    public function get($array, $offset, $order) {

        $this->load->helper('date');

        $this->db->select('id, title, slug, youtube_id, channel_id, published');
        $this->db->where($array);
        $this->db->order_by('published', $order);
        $this->db->limit('50', $offset);

        $query = $this->db->get('traks');

        if ($query->num_rows() == 1) {

            $row = $query->row();
            $channel = $this->Channel_model->get(array('id' => $row->channel_id));

            $row->channel_title = $channel->title;
            $row->channel_slug = $channel->slug;

            $row->published = date(DATE_ISO8601, strtotime($row->published));

            return $row;
        
        } else if ($query->num_rows() > 1) {

            foreach ($query->result() as $row) {

                $channel = $this->Channel_model->get(array('id' => $row->channel_id));

                $row->channel_title = $channel->title;
                $row->channel_slug = $channel->slug;

                $row->published = date(DATE_ISO8601, strtotime($row->published));

                $data[] = $row;

            }

            return $data;

        } else {
            return false;
        }
    }

    public function search($query, $offset) {

        // print $query;

        $this->load->helper('date');

        $this->db->select('id, title, slug, youtube_id, channel_id, published');
        $this->db->like('title', $query, 'both');
        $this->db->order_by('published', 'DESC');
        $this->db->limit('50', $offset);

        $query = $this->db->get('traks');

        if ($query->num_rows() == 1) {

            $row = $query->row();
            $channel = $this->Channel_model->get(array('id' => $row->channel_id));

            $row->channel_title = $channel->title;
            $row->channel_slug = $channel->slug;

            $row->published = date(DATE_ISO8601, strtotime($row->published));

            return $row;
        
        } else if ($query->num_rows() > 1) {

            foreach ($query->result() as $row) {

                $channel = $this->Channel_model->get(array('id' => $row->channel_id));

                $row->channel_title = $channel->title;
                $row->channel_slug = $channel->slug;

                $row->published = date(DATE_ISO8601, strtotime($row->published));

                $data[] = $row;

            }

            return $data;

        } else {
            return false;
        }
    }

    public function update($id, $data) {

        $this->db->where('id', $id);
        $this->db->update('traks', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
    } 

    public function count($array) {

        $this->db->where($array);
        $query = $this->db->get('traks');

        return $query->num_rows();

    }

    public function random() {

        $this->db->order_by('id', 'RANDOM');
        $this->db->limit('1', '0');

        $query = $this->db->get('traks');

        return $query->row();
        
    }

    public function popular() {

        $this->db->order_by('views', 'DESC');
        $this->db->limit('50', '0');

        $query = $this->db->get('traks');

        if ($query->num_rows() == 1) {

            $row = $query->row();

            $channel = $this->Channel_model->get(array('id' => $row->channel_id));

            $row->channel_title = $channel->title;
            $row->channel_slug = $channel->slug;

            return $row;
        
        } else if ($query->num_rows() > 1) {

            foreach ($query->result() as $row) {

                $channel = $this->Channel_model->get(array('id' => $row->channel_id));

                $row->channel_title = $channel->title;
                $row->channel_slug = $channel->slug;

                $data[] = $row;

            }

            return $data;

        } else {
            return false;
        }
        
    }

    public function is_new($youtube_id) {

        $this->db->where('youtube_id', $youtube_id);
        $query = $this->db->get('traks');

        if ($query->num_rows() == 0){
            return true;
        }
    }

    public function delete($id) {

        $this->db->where('id', $id);
        $this->db->delete('traks'); 

        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }

}

?>