<h1 id="logo"><a href="<?php echo base_url(); ?>">Channeltrak</a></h1>
<ul id="site-nav">
	<li class="active"><a href="<?php echo base_url(); ?>">Latest</a></li>
	<li><a href="<?php echo base_url(); ?>index.php/popular">Popular</a></li>
	<li><a href="<?php echo base_url(); ?>index.php/staff-picks">Staff Picks</a></li>
	<li><a href="<?php echo base_url(); ?>index.php/channels">Channels</a></li>
</ul>
<ul id="account-nav">
<?php if ($this->session->userdata('logged_in')) { ?>
	<li id="account-name"><?php echo $this->session->userdata('user_name') ?></li>
	<li><a href="<?php echo base_url(); ?>index.php/favorites">Favorites</a></li>
	<li><a href="<?php echo base_url(); ?>index.php/settings">Settings</a></li>
	<li><a href="<?php echo base_url(); ?>index.php/logout">Logout</a></li>
<?php } else { ?>
	<li><a href="<?php echo base_url(); ?>index.php/join">Join</a></li>
	<li><a href="<?php echo base_url(); ?>index.php/login">Login</a></li>
<?php } ?>
</ul>
