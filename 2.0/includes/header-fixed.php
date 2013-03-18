<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>channeltrak | track youtube music channels</title>
	<meta name="description" content="Channeltrak compiles the best music-oriented Youtube Channels. Like your favorite tracks and submit channels that consistently post good stuff.">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/style.css">

	<script type="text/javascript" src="//use.typekit.net/nuh3nan.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body class="fixed-push">

	<header id="header" class="fixed" role="banner">
		<div class="row">
			<div class="ten columns">
				<div id="list-view" style="display:none;">
					<i class="icon-left_arrow"></i>
				</div>
				<h1 id="logo"><a href="index.php">ChannelTrak</a></h1>
				<div id="song-title" style="display:none;">
					<a href="javascript:void(0)" class="ellipsis"></a>
					<div id="track-timer"><span id="track-elapsed">0:00</span> / <span id="track-length">0:00</span></div>
				</div>
			</div>
			<div class="two columns">
				<ul class="nav inline">

				<?php if(isset($_SESSION['logged_in'])) : ?>  

					<?php $user = unserialize($_SESSION['user']); ?>  
					<li><a id="dropdown-link" href="javascript:void(0)" class="arrow-down"><?php echo $user->username; ?></a></li>
					  
				<?php else : ?> 

					<li><a id="dropdown-link" style="display:none" href="javascript:void(0)" class="arrow-down"></a></li>
					<li><a href="login.php">login</i></a></li>
					<li><a href="register.php">register</i></a></li>

				<?php endif; ?> 

				</ul>
			</div>
		</div>
		<div id="dropdown-menu" style="display:none;">
			<ul class="nav">
				<li><a href="javascript:void(0)" id="dropdown-hide" class="arrow-up"><?php echo $user->username; ?></a></li>
				<li><a href="settings.php">account setting</a></li>
				<li><a href="submit.php">submit channel</a></li>
				<li><a href="logout.php">logout</a></li>
			</ul>
		</div>
	</header>