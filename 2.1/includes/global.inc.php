<?php
require_once 'classes/Post.class.php';
require_once 'classes/PostTools.class.php';
require_once 'classes/Channel.class.php';
require_once 'classes/ChannelTools.class.php';
require_once 'classes/DB.class.php';
require_once 'chrome.php';

//connect to the database
$db = new DB();
$db->connect();

//initialize UserTools object
$postTools = new PostTools();
$channelTools = new ChannelTools();

?>
