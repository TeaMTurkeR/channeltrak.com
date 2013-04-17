<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title><?php echo $title ?></title>

	<link rel="icon" href="<?=base_url()?>/favicon.ico" type="image/ico">

	<?php echo link_tag(base_url().'assets/stylesheets/normalize.css'); ?>
	<?php echo link_tag(base_url().'assets/stylesheets/iconic_stroke.css'); ?>
	<?php echo link_tag(base_url().'assets/stylesheets/app.css'); ?>
		
	<script type="text/javascript" src="//use.typekit.net/nuh3nan.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	<?php echo script_tag(base_url().'assets/javascripts/vendor/custom.modernizr.js'); ?>
</head>

<?php 

	if ($this->session->userdata('logged_in')) { 
		$this->load->model('Favoritemodel');

?>

<body class="logged-in">

<?php } else { ?>

<body>

<?php } ?>

	<div id="wrap">
