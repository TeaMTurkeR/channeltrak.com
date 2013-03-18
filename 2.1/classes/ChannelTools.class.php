<?php

require_once 'Channel.class.php';
require_once 'DB.class.php';

class ChannelTools {

	//Check to see if a username exists.
	//This is called during registration to make sure all user names are unique.
	public function checkChannelExists($channelName) {
		$result = mysql_query("SELECT id FROM channels WHERE name='$channelName'");
		if ($result !== false) {
	    	if(mysql_num_rows($result) == null)	{
				return false;
		   	} else {
		   		return true;
			}
		} else {
			return false;
		}
	}

	public function importPosts($channelId, $channelName) {

    	$url = "http://gdata.youtube.com/feeds/api/users/".$channelId."/uploads?v=2&alt=jsonc";
    	$json = file_get_contents($url);
    	$jsonOutput = json_decode($json);

	    foreach ( $jsonOutput->data->items as $data ){

			$success = true;
			$postTools = new PostTools();

			if($success)
			{
				//prep the data for saving in a new post object
				$escapedTitle = addslashes($data->title);

	   			$post['video_title'] = $escapedTitle;
	    		$post['video_id'] = $data->id;
	    		$post['channel_name'] = $channelName;
	    		$post['channel_id'] = $channelId;
	    		$post['upload_date'] = $data->uploadDate;
	    		$post['database_date'] = date("Y-m-d H:i:s",time());

			    //create the new user object
			    $newPost = new Post($post);

			    //save the new user to the database
			    $newPost->save(true);
			}
	    }
	}
}

?>
