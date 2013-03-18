<?php
//Post.class.php

require_once 'DB.class.php';


class Post {

	public $id;
	public $videoId;
	public $videoTitle;
	public $channelName;
	public $channelId;
	public $upvotes;
	public $uploadDate;
	public $databaseDate;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->id = (isset($data['id'])) ? $data['id'] : "";
		$this->videoId = (isset($data['video_id'])) ? $data['video_id'] : "";
		$this->videoTitle = (isset($data['video_title'])) ? $data['video_title'] : "";
		$this->channelName = (isset($data['channel_name'])) ? $data['channel_name'] : "";
		$this->channelId = (isset($data['channel_id'])) ? $data['channel_id'] : "";
		$this->upvotes = (isset($data['upvotes'])) ? $data['upvotes'] : "";
		$this->uploadDate = (isset($data['upload_date'])) ? $data['upload_date'] : "";
		$this->databaseDate = (isset($data['database_date'])) ? $data['database_date'] : "";
	}

	public function save($isNewPost = false) {
		//create a new database object.
		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewPost) {
			//set the data array
			$data = array(
				"upvotes" => "'$this->upvotes'"
			);
			
			//update the row in the database
			$db->update($data, 'posts', 'id = '.$this->id);
		} else {
		//if the user is being registered for the first time.
			$data = array(
				"video_id" => "'$this->videoId'",
				"video_title" => "'$this->videoTitle'",
				"channel_name" => "'$this->channelName'",
				"channel_id" => "'$this->channelId'",
				"upload_date" => "'$this->uploadDate'",
				"database_date" => "'$this->databaseDate'"
			);
			
			$this->id = $db->insert($data, 'posts');
		}
		return true;
	}
	
}

?>
