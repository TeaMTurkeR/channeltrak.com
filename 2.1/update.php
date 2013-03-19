<?php
	require_once('includes/global.inc.php');

	$query = "SELECT * FROM channels";
	$result = mysql_query($query);
	while( $row = mysql_fetch_assoc($result)){
		$new_array[] = $row; // Inside while loop
	}

	foreach ($new_array as $array){

		$channelId = $array['channel_id'];
		$channelName = $array['channel_name'];
		$url = "http://gdata.youtube.com/feeds/api/users/".$channelId."/uploads?v=2&max-results=50&alt=jsonc";
		
		$json = file_get_contents($url);
		$jsonOutput = json_decode($json);

	    foreach ( $jsonOutput->data->items as $data ){

			$success = true;
			$postTools = new PostTools();
			$escapedTitle = addslashes($data->title);
			$uploadDate = $data->uploaded;
			$views = $data->viewCount;

			$date = date('Y-m-d H:i:s',time());
			$diff = strtotime($date) - strtotime($uploadDate);
			$days = floor($diff/(3600*24));

			if($postTools->checkTitleExists($escapedTitle)){
			    $success = false;
			    print '<div style="color:red;">'.$escapedTitle.'<br>'.$channelName.'<br>'.$views.'<br>'.$uploadDate.'<br>Duplicate<br>'.$days.'<br><br></div>';

			}

			if($success && $days < 5){
				print '<div style="color:green;">'.$escapedTitle.'<br>'.$channelName.'<br>'.$views.'<br>'.$uploadDate.'<br>New Post<br><br></div>';
	   			
	   			$post['video_title'] = $escapedTitle;
	    		$post['video_id'] = $data->id;
	    		$post['channel_name'] = $channelName;
	    		$post['channel_id'] = $channelId;
	    		$post['upload_date'] = $uploadDate;
	    		$post['database_date'] = date("Y-m-d H:i:s",time());

			    //create the new post object
			    $newPost = new Post($post);

			    //save the new post to the database
			    $newPost->save(true);
			}
	    }
	}

?>