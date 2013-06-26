<?php $this->load->view('includes/header'); ?>
<div id="page">
	<?php $this->load->view('includes/side'); ?>
	
	<?php $this->load->view('includes/info'); ?>

	<section class="settings">		
		<?php echo form_open('index.php/user/', 'id=username class=form' ); ?>
			<label for="name">Username</label>
			<input type="text" name="name" value="<?php echo $user->user_name ?>">

			<label for="email">Email</label>
			<input type="text" name="email" value="<?php echo $user->user_email ?>">

			<input class="button" type="submit" value="Save">
		<?php echo form_close(); ?>
	</section>

	<section class="settings">		
		<?php echo form_open('index.php/user/password', 'id=password class=form' ); ?>
			<label for="current">Current Password</label>
			<input type="text" name="current">

			<label for="new">New Password</label>
			<input type="text" name="new">
			
			<label for="twitter">Confirm New Password</label>
			<input type="text" name="confirm">

			<input class="button" type="submit" value="Save">
		<?php echo form_close(); ?>
	</section>

	<section class="settings">		
		<input type="text">
		<a href="" class="button">Delete Account</a>
	</section>

	<?php $this->load->view('includes/links'); ?>

</div>
<?php $this->load->view('includes/footer'); ?>