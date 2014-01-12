<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />

	<title><?php echo $title ?></title>

	<link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/ico">

	<?php echo link_tag(base_url().'assets/stylesheets/admin.css'); ?>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,300,400,700' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
		<?php echo script_tag(base_url().'assets/javascripts/vendor/html5shiv.js'); ?>
	<![endif]-->
</head>
<body>

	<header id="header">
		<div class="center">
			<h1><a href="<?php echo base_url(); ?>index.php/dashboard">Admin</a></h1>
			<a href="<?php echo base_url(); ?>index.php/logout">Log Out</a>
		</div>
	</header>
	