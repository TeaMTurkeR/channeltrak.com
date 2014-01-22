<?php

// open -a Google\ Chrome --args --disable-web-security
// Slim

require 'vendor/autoload.php';
$app = new \Slim\Slim(array(
    "MODE" => "development",
    "TEMPLATES.PATH" => "./templates"
));

// API Routes

$app->get('/users', 'getUsers');
$app->post('/users', 'createUser');
$app->get('/users/:id', 'getUser');
$app->post('/users/:id', 'updateUser');
$app->post('/users/authenticate', 'authenticateUser');

$app->get('/traks/latest/page/:page_number', 'getLatestTraks');
$app->get('/traks/popular/page/:page_number', 'getPopularTraks');
$app->get('/traks/channel/:channel_id/page/:page_number', 'getChannelTraks');
$app->get('/traks/:id', 'getTrak');

$app->get('/channels', 'getChannels');
$app->post('/channels', 'createChannels');
$app->get('/channels/import', 'importChannels');
$app->get('/channels/import/:channel_id', 'importChannel');
$app->get('/channels/:channel_slug', 'getChannel');
$app->post('/channels/:channel_id', 'updateChannel');

// Utility Routes
$app->get('/test', 'test');

// Global

$app->get('/', function () use ($app) {
    $app->render('admin.php');
});

function getConnection() {
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'root';
	$dbname = 'ctrak';
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

$limit = 12;

// USERS

function getUsers() {

}

function createUser() {

    $request = \Slim\Slim::getInstance()->request();
    $user = json_decode($request->getBody());
    $sql = 'INSERT INTO users (email, password, created, updated) 
    		VALUES (:email, :password, :created, :updated)';

    try {

        $db = getConnection();

        $current = date('Y-m-d H:i:s');

        $stmt = $db->prepare($sql);
        $stmt->bindParam('email', $user->email);
        $stmt->bindParam('password', $user->password);
        $stmt->bindParam('created', $current);
        $stmt->bindParam('updated', $current);
        $stmt->execute();

        $user->id = $db->lastInsertId();

        $db = null;

        echo json_encode($user);

    } catch(PDOException $e) {

        echo '{"error":{"text":'. $e->getMessage() .'}}';

    }
}

function getUser() {

}

function updateUser() {

}

function authenticateUser() {

    // Test: curl -i -X POST -H 'Content-Type: application/json' -d '{"email": "wgminer@gmail.com", "password": "gonzaga06"}' http://localhost/channeltrak.com/server/users/authenticate

    $request = \Slim\Slim::getInstance()->request();
    $user = json_decode($request->getBody());
    $sql = 'SELECT * 
			FROM users
			WHERE email=:email 
			AND password=:password';

    try {

        $db = getConnection();

        $password = md5($user->password);

        $stmt = $db->prepare($sql);
        $stmt->bindParam('email', $user->email);
        $stmt->bindParam('password', $user->password);
        $stmt->execute();
        $user = $stmt->fetchObject();

        $db = null;

        echo json_encode($password);

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

// TRAKS

function getLatestTraks($page_number) {

	global $limit;

	$offset = ($page_number - 1) * $limit;
	$sql = 'SELECT t.id, t.title, t.slug, t.youtube_id, DATE_FORMAT(t.published,"%Y-%m-%dT%TZ") AS published, c.title AS channel_title, c.slug AS channel_slug
			FROM traks t LEFT JOIN channels c ON t.channel_id = c.id 
			ORDER BY published DESC LIMIT '.$offset.','.$limit;

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
	$sql = 'SELECT t.id, t.title, t.slug, t.youtube_id, DATE_FORMAT(t.published,"%Y-%m-%dT%TZ") AS published, c.title AS channel_title, c.slug AS channel_slug
			FROM traks t LEFT JOIN channels c ON t.channel_id = c.id 
			ORDER BY published DESC LIMIT '.$offset.','.$limit;

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
	$sql = 'SELECT t.id, t.title, t.slug, t.youtube_id, DATE_FORMAT(t.published,"%Y-%m-%dT%TZ") AS published, c.title AS channel_title, c.slug AS channel_slug 
			FROM traks t LEFT JOIN channels c ON t.channel_id = c.id 
			WHERE channel_id='.$channel_id.'
			ORDER BY published DESC LIMIT '.$offset.','.$limit;

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

	$sql = 'SELECT id, title, slug, youtube_id, cover_id, created 
			FROM channels 
			ORDER BY created';

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

function createChannels() {

	// TEST: curl -i -X POST -H 'Content-Type: application/json' -d '{"title": "Boiler Room", "url": "http://www.youtube.com/user/brtvofficial/about"}' http://localhost/channeltrak.com/server/channels

    $request = \Slim\Slim::getInstance()->request();
    $channel = json_decode($request->getBody());
    $sql = 'INSERT INTO channels (title, slug, youtube_title, youtube_id, published, created, updated) 
    		VALUES (:title, :slug, :youtube_title, :youtube_id, :published, :created, :updated)';

    try {

        $youtube_title = parse_user($channel->url);

		$url = 'http://gdata.youtube.com/feeds/api/users/'.$youtube_title.'?v=2&format=5&prettyprint=true&alt=json';

        $json = file_get_contents($url);
        $jsonOutput = json_decode($json);

        $youtube_title = $jsonOutput->entry->title->{'$t'};
        $youtube_id = $jsonOutput->entry->{'yt$channelId'}->{'$t'};
        $published = $jsonOutput->entry->published->{'$t'};

        $slug = url_title($channel->title);
        $current_time = date('Y-m-d H:i:s');

        $db = getConnection();

        $stmt = $db->prepare($sql);
        $stmt->bindParam('title', $channel->title);
        $stmt->bindParam('slug', $slug);
        $stmt->bindParam('youtube_title', $youtube_title);
        $stmt->bindParam('youtube_id', $youtube_id); //pull
        $stmt->bindParam('published', $published); //pull
        $stmt->bindParam('created', $current_time);
        $stmt->bindParam('updated', $current_time);
        $stmt->execute();

        $id = $db->lastInsertId();

        $db = null;

        echo json_encode($channel);

    } catch(PDOException $e) {

        echo '{"error":{"text":'. $e->getMessage() .'}}';

    }
}

function getChannel($channel_slug) {

	$sql = 'SELECT id, title, slug, youtube_id, cover_id, created 
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

function updateChannel($channel_id) {

}

function importChannels() {
    
    $sql = 'SELECT id, title, slug, youtube_id, cover_id, created 
			FROM channels 
			ORDER BY created';

	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$channels = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}

    foreach ($channels as $channel) {
    
        $channel_id = $channel->id;
        $youtube_id = $channel->youtube_id;
        $url = "http://gdata.youtube.com/feeds/api/users/".$youtube_id."/uploads?v=3&alt=jsonc&max-results=1&format=5&prettyprint=true";
        $json = file_get_contents($url);
        $jsonOutput = json_decode($json);

        for ( $i = 1; $i <= $jsonOutput->data->totalItems; $i += $jsonOutput->data->itemsPerPage) {

            $url = "http://gdata.youtube.com/feeds/api/users/".$youtube_id."/uploads?v=3&alt=jsonc&max-results=50&start-index=".$i."&format=5";
            $json = file_get_contents($url);
            $jsonOutput = json_decode($json);

            if (isset($jsonOutput->data->items)) {

                foreach ( $jsonOutput->data->items as $trak ){

                	echo $trak->title;

                }

            } else {
                print '<p style="color:red">Done with '.$channel_id.'</p>';
                $this->Channel_model->update($channel_id, array('updated' => date('Y-m-d H:i:s')));
                break;
            }
        }
    }
}

function importChannel($channel_id) {

    $sql = 'SELECT youtube_id 
            FROM channels 
            WHERE id = "'.$channel_id.'"';

    try {

        $db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->execute();
        $channel = $stmt->fetchObject(); 
        //$db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }

    // Setup the data for the channel

    $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=".$channel->youtube_id."&maxResults=1&key=AIzaSyCkoszshUaUgV-2CrviQI0I4pTkd8j61gc";
    $json = file_get_contents($url);
    $jsonOutput = json_decode($json);

    $limit = $jsonOutput->pageInfo->resultsPerPage;
    $total = $jsonOutput->pageInfo->totalResults;

    $totalPages = ceil($total / $limit);

    for ( $page_number = 1; $page_number < $totalPages; $page_number++) { // Paginate

        if ($page_number > 1) {
            $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=".$channel->youtube_id."&pageToken=".$token."&maxResults=50&key=AIzaSyCkoszshUaUgV-2CrviQI0I4pTkd8j61gc";
        } else {
            $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=".$channel->youtube_id."&maxResults=50&key=AIzaSyCkoszshUaUgV-2CrviQI0I4pTkd8j61gc";
        }

        $json = file_get_contents($url);
        $jsonOutput = json_decode($json);

        for ( $item_number = 0; $item_number < count($jsonOutput->items); $item_number++ ){

            if (isset($jsonOutput->items[$item_number]->id->videoId)) {

                $sql = 'INSERT INTO traks (title, slug, youtube_id, channel_id, published, created, updated) 
                        VALUES (:title, :slug, :youtube_id, :channel_id, :published, :created, :updated)';

                $title = $jsonOutput->items[$item_number]->snippet->title;
                $slug = url_title($title);
                $youtube_id = $jsonOutput->items[$item_number]->id->videoId;
                $published = $jsonOutput->items[$item_number]->snippet->publishedAt;
                $current_time = date('Y-m-d H:i:s');

                $stmt = $db->prepare($sql);
                $stmt->bindParam('title', $title);
                $stmt->bindParam('slug', $slug);
                $stmt->bindParam('youtube_id', $youtube_id);
                $stmt->bindParam('channel_id', $channel_id);
                $stmt->bindParam('published', $published);
                $stmt->bindParam('created', $current_time);
                $stmt->bindParam('updated', $current_time);
                $stmt->execute();

            }

        }

        if (isset($jsonOutput->nextPageToken)) {

            $token = $jsonOutput->nextPageToken;

        } else {

            break;
            $db = null;

        }

    }

}

function url_title($str, $separator = '-', $lowercase = FALSE) {
    if ($separator == 'dash') {
        $separator = '-';
    }

    else if ($separator == 'underscore') {
        $separator = '_';
    }
    
    $q_separator = preg_quote($separator);

    $trans = array(
        '&.+?;'                 => '',
        '[^a-z0-9 _-]'          => '',
        '\s+'                   => $separator,
        '('.$q_separator.')+'   => $separator
    );

    $str = strip_tags($str);

    foreach ($trans as $key => $val) {
        $str = preg_replace("#".$key."#i", $val, $str);
    }

    if ($lowercase === TRUE) {
        $str = strtolower($str);
    }

    return trim($str, $separator);
}

function parse_user($url) {

    $str = substr( $url, strrpos( $url, 'user/' )+5 );

    return explode('/', $str, 2)[0];

}

function test() {

}

// RUN DA TRAP

$app->run();


