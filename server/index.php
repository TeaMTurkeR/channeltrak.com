<?php

// Slim

require 'vendor/autoload.php';
$app = new \Slim\Slim();

// Routes

$app->get('/', 'index');

$app->get('/traks/latest/page/:page_number', 'getLatestTraks');
$app->get('/traks/popular/page/:page_number', 'getPopularTraks');
$app->get('/traks/channel/:channel_id/page/:page_number', 'getChannelTraks');
$app->get('/traks/:id', 'getTrak');

$app->get('/channels', 'getChannels');
$app->get('/channels/:channel_slug', 'getChannel');

// Global

function index() {
	echo 'Welcome to the Channeltrak API';
}

function getConnection() {
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'root';
	$dbname = 'ctrak';
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

$limit = 10;

// TRAKS

function getLatestTraks($page_number) {

	global $limit;

	$offset = ($page_number - 1) * $limit;
	$sql = 'SELECT t.id, t.title, t.slug, t.youtube_id, DATE_FORMAT(t.uploaded,"%Y-%m-%dT%TZ") AS uploaded, c.title AS channel_title, c.slug AS channel_slug
			FROM traks t LEFT JOIN channels c ON t.channel_id = c.id 
			ORDER BY uploaded DESC LIMIT '.$offset.','.$limit;

	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$traks = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($traks);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getPopularTraks($page_number) {

	global $limit;

	$offset = ($page_number - 1) * $limit;
	$sql = 'SELECT t.id, t.title, t.slug, t.youtube_id, DATE_FORMAT(t.uploaded,"%Y-%m-%dT%TZ") AS uploaded, c.title AS channel_title, c.slug AS channel_slug
			FROM traks t LEFT JOIN channels c ON t.channel_id = c.id 
			ORDER BY uploaded DESC LIMIT '.$offset.','.$limit;

	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$traks = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($traks);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getChannelTraks($channel_id, $page_number) {

	global $limit;

	$offset = ($page_number - 1) * $limit;
	$sql = 'SELECT t.id, t.title, t.slug, t.youtube_id, DATE_FORMAT(t.uploaded,"%Y-%m-%dT%TZ") AS uploaded, c.title AS channel_title, c.slug AS channel_slug 
			FROM traks t LEFT JOIN channels c ON t.channel_id = c.id 
			WHERE channel_id='.$channel_id.'
			ORDER BY uploaded DESC LIMIT '.$offset.','.$limit;

    try {
        $db = getConnection();
		$stmt = $db->query($sql);  
		$traks = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($traks);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function getTrak($trak_id) {

    $sql = 'SELECT * FROM traks WHERE id = '.$trak_id;
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->execute();
        $trak = $stmt->fetchObject();  
        $db = null;
        echo json_encode($trak); 
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

// CHANNELS

function getChannels() {

	$sql = 'SELECT id, title, slug, youtube_id, cover_id, added 
			FROM channels 
			ORDER BY added';

	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$channels = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($channels);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getChannel($channel_slug) {

	$sql = 'SELECT id, title, slug, youtube_id, cover_id, added 
			FROM channels 
			WHERE slug = "'.$channel_slug.'"';

	try {
		$db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->execute();
        $channel = $stmt->fetchObject(); 
		$db = null;
		echo json_encode($channel);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

// RUN DA TRAP

$app->run();


