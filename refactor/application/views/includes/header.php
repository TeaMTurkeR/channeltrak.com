<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<?php if (isset($title)) : ?>
	<title id="html-title"><?php echo $title ?> | Channeltrak</title>
	<?php else : ?>
	<title id="html-title">Channeltrak | Youtube Music Channels</title>
	<?php endif; ?>

	<link rel="icon" href="<?=base_url()?>favicon.ico" type="image/ico">

	<?php echo link_tag(base_url().'assets/stylesheets/channeltrak.css'); ?>
		
	<script type="text/javascript" src="//use.typekit.net/nuh3nan.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<!--[if lt IE 9]>
	<?php echo script_tag(base_url().'assets/javascripts/vendor/html5shiv.js'); ?>
	<![endif]-->
</head>

<?php if ($this->session->userdata('logged_in')) : $this->load->model('User_model'); ?>

<body class="logged-in">

<?php else : ?>

<body>

<?php endif; ?>
