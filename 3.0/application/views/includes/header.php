<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8" />
  	<meta name="viewport" content="width=device-width" />
  	<title><?php echo $title ?></title>

  	<?php echo link_tag(base_url().'assets/stylesheets/normalize.css'); ?>
  	<?php echo link_tag(base_url().'assets/stylesheets/app.css'); ?>
  	
  	<script type="text/javascript" src="//use.typekit.net/nuh3nan.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

  	<?php echo script_tag(base_url().'assets/javascripts/vendor/custom.modernizr.js'); ?>
</head>
<body>

	<header>
		<div class="row">
			<div class="large-12 columns">
				<h1><a href="http://localhost/channeltrak.com/3.0/">Channeltrak</a></h1>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<ul class="inline-list left">
					<li><a href="http://localhost/channeltrak.com/3.0/index.php/latest">Latest</a></li>
					<li><a href="http://localhost/channeltrak.com/3.0/index.php/popular">Popular</a></li>
					<li><a href="http://localhost/channeltrak.com/3.0/index.php/favorites">Favorites</a></li>
				</ul>
				<ul class="inline-list right">
				<?php if ($this->session->userdata('logged_in')) { ?>
					<li><a href="http://localhost/channeltrak.com/3.0/index.php/account"><?php echo $this->session->userdata('user_name') ?></a></li>
					<li><a href="http://localhost/channeltrak.com/3.0/index.php/logout">Logout</a></li>
				<?php } else { ?>
					<li><a href="http://localhost/channeltrak.com/3.0/index.php/join">Join</a></li>
					<li><a href="http://localhost/channeltrak.com/3.0/index.php/login">Login</a></li>
				<?php } ?>
				</ul>
			</div>
		</div>
	</header>
