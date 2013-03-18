<?php

//require_once 'Post.class.php';
require_once 'DB.class.php';

class PostTools {

	//Check to see if a username exists.
	//This is called during registration to make sure all user names are unique.
	public function checkTitleExists($videoTitle) {
		$result = mysql_query("select id from posts where video_title='$videoTitle'");
    	if(mysql_num_rows($result) == 0)
    	{
			return false;
	   	}else{
	   		return true;
		}
	}	
	
}

?>
