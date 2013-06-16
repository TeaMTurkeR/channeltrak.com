<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<meta name="viewport" content="width=device-width" />
	<?php if (isset($title)) : ?>
	<title><?php echo $title ?> | Channeltrak</title>
	<?php else : ?>
	<title>Channeltrak | Youtube Music Channels</title>
	<?php endif; ?>

	<link rel="icon" href="<?=base_url()?>favicon.ico" type="image/ico">

	<?php echo link_tag(base_url().'assets/stylesheets/admin.css'); ?>
		
	<script type="text/javascript" src="//use.typekit.net/nuh3nan.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<!--[if lt IE 9]>
	<?php echo script_tag(base_url().'assets/javascripts/vendor/html5shiv.js'); ?>
	<![endif]-->
</head>

<body>

	<div class="navbar navbar-inverse navbar-fixed-top">
      	<div class="navbar-inner">
        	<div class="container">
          		<a class="brand" href="<?php echo base_url(); ?>index.php/admin">Channeltrak</a>
            	<ul class="nav pull-right">
            		<li><a href="<?php echo base_url(); ?>">Site</a></li>
              		<li><a href="http://www.twitter.com/channeltrak">Twitter</a></li>
              		<li><a href="#about">Email</a></li>
              		<li><a href="#about">Analytics</a></li>
            	</ul>
          	</div>
        </div>
    </div>
