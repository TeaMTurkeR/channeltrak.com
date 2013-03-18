<?php
require_once 'classes/User.class.php';
require_once 'classes/UserTools.class.php';
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
$userTools = new UserTools();
$postTools = new PostTools();
$channelTools = new ChannelTools();

//start the session
session_start();

//refresh session variables if logged in
if(isset($_SESSION['logged_in'])) {
	$user = unserialize($_SESSION['user']);
	$_SESSION['user'] = serialize($userTools->get($user->id));
}
?>
