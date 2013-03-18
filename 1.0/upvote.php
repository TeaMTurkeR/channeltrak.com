<?php

	require_once('includes/global.inc.php');

	$count = $_POST['count'];
	$id = $_POST['postId'];

	$sql = "UPDATE posts SET upvotes='$count' WHERE id='$id'";
	
	mysql_query($sql);

	ChromePhp::log($sql);

?>