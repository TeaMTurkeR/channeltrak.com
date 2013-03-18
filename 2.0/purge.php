<?php
	require_once('includes/global.inc.php');

	$query = "SELECT * FROM posts";
	$result = mysql_query($query);
	while( $row = mysql_fetch_assoc($result)){
		$new_array[] = $row; // Inside while loop
	}

	foreach ($new_array as $array){

		$id = $array['id'];
		$upvotes = $array['upvotes'];
		$videoTitle = $array['video_title'];
		$databaseDate = $array['database_date'];

		$currentDate = date("Y-m-d H:i:s",time());

		$diff = strtotime($currentDate) - strtotime($databaseDate);
		$days = floor($diff/(3600*24));


		if ( $upvotes < 2 && $days > 5 ) {

			print '<div style="color:red;">Stale<br>'.$videoTitle.'<br>'.$upvotes.'<br>'.$days.'<br><br></div>';

			$sql = "DELETE FROM posts WHERE id = '$id'";
			mysql_query($sql);

		} else {

			print '<div style="color:green;">Fresh<br>'.$videoTitle.'<br>'.$upvotes.'<br>'.$days.'<br><br></div>';

		}

	}

?>