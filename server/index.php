<?php

// Slim

require 'vendor/autoload.php';
$app = new \Slim\Slim();

// Models

require 'models/users.php';
require 'models/studies.php';
require 'models/permissions.php';
require 'models/tests.php';

// Routes

$app->get('/', 'index');

$app->get('/users', 'getUsers');
$app->get('/user/:id', 'getUser');
$app->post('/user', 'createUser');

$app->get('/studies/:id', 'getStudies');
$app->get('/study/:id', 'getStudy');
$app->post('/study', 'createStudy');

$app->get('/tests/:id', 'getTests');
$app->get('/test/:id', 'getTest');
$app->post('/test', 'createTest');

$app->get('/permission', 'getPermission');
$app->post('/permission', 'createPermission');

// Global

function index() {
	echo 'Welcome to the Moderator API';
}

function getConnection() {
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'root';
	$dbname = 'moderator';
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

// Run Da Trap

$app->run();


