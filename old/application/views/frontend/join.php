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

	<div style="margin-top:80px;" class="center">

		<?php echo form_open('users/create', array('class' => 'pure-form pure-form-aligned')); ?>

			<div class="pure-control-group">
	            <label for="email">Email</label>
	            <input name="email" type="email" placeholder="Email">
	        </div>
			
			<div class="pure-control-group">
	            <label for="password">Password</label>
	            <input name="password" type="password" placeholder="Password">
	        </div>

			<div class="pure-controls">
				<input class="pure-button pure-button-primary" type="submit" value="Join">
			</div>

		<?php echo form_close(); ?>

	</div>



<?php $this->load->view('includes/footer'); ?>