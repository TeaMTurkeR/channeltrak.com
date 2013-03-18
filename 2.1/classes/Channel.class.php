<?php
//Post.class.php

require_once 'DB.class.php';


class Channel {

	public $id;
	public $channelName;
	public $channelId;
	public $submitDate;
	public $approved;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->id = (isset($data['id'])) ? $data['id'] : "";
		$this->channelName = (isset($data['channel_name'])) ? $data['channel_name'] : "";
		$this->channelId = (isset($data['channel_id'])) ? $data['channel_id'] : "";
		$this->submitDate = (isset($data['submit_date'])) ? $data['submit_date'] : "";
		$this->approved = (isset($data['approved'])) ? $data['approved'] : "";
	}

	public function save($isNewChannel = false) {
		//create a new database object.
		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewChannel) {
			//set the data array
			$data = array(
				"channel_name" => "'$this->channelName'",
				"channel_id" => "'$this->channelId'",
				"approved" => "'$this->approved'"
			);
			
			//update the row in the database
			$db->update($data, 'channels', 'id = '.$this->id);
		} else {
		//if the user is being registered for the first time.
			$data = array(
				"channel_name" => "'$this->channelName'",
				"channel_id" => "'$this->channelId'",
				"submit_date" => "'".date("Y-m-d H:i:s",time())."'"
			);
			
			$this->id = $db->insert($data, 'channels');
		}
		return true;
	}
	
}

?>
