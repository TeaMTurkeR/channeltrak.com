<h1 id="logo"><a href="<?php echo base_url(); ?>">Channeltrak</a></h1>
<ul id="toggle-mobile-nav" class="hide-desktop">
	<li><a href="javascript:void(0)"><span class="iconic layers_alt"></span>Menu</a></li>
</ul>
<?php if (isset($title)) : ?>
<ul id="site-nav" class="hide-mobile">
	<li><a class="<?php if ($title == 'Latest') echo 'active';?>" href="<?php echo base_url(); ?>index.php/latest">Latest</a></li>
	<li><a class="<?php if ($title == 'Popular') echo 'active';?>" href="<?php echo base_url(); ?>index.php/popular">Popular</a></li>
<!-- 	<li><a class="<?php if ($title == 'Staff Picks') echo 'active';?>" href="<?php echo base_url(); ?>index.php/staff-picks">Staff Picks</a></li>
 -->	<li><a class="<?php if ($title == 'Channel') echo 'active';?>" href="<?php echo base_url(); ?>index.php/channels">Channels</a></li>
	<li><?php print $title; ?></li>
</ul>
<?php else : ?>
<ul id="site-nav" class="hide-mobile">
	<li><a href="<?php echo base_url(); ?>index.php/latest">Latest</a></li>
	<li><a href="<?php echo base_url(); ?>index.php/popular">Popular</a></li>
<!-- 	<li><a href="<?php echo base_url(); ?>staff-picks">Staff Picks</a></li>
 -->	<li><a href="<?php echo base_url(); ?>index.php/channels">Channels</a></li>
</ul>
<?php endif; ?>
<ul id="account-nav" class="hide-mobile">
<?php if ($this->session->userdata('logged_in')) { ?>
	<li id="account-name"><?php echo $this->session->userdata('user_name') ?></li>
	<li><a href="<?php echo base_url(); ?>index.php/favorites">Favorites</a></li>
	<li><a href="<?php echo base_url(); ?>index.php/settings">Settings</a></li>
	<li><a href="<?php echo base_url(); ?>index.php/submit">Submit</a></li>
	<li><a href="<?php echo base_url(); ?>index.php/logout">Logout</a></li>
<?php } else { ?>
	<li><a href="<?php echo base_url(); ?>index.php/join">Join</a></li>
	<li><a href="<?php echo base_url(); ?>index.php/login">Login</a></li>
<?php } ?>
</ul>
