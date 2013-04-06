<?php 

	$data['title'] = 'Settings | Channeltrak';
	$this->load->view('includes/header', $data);

?>

<section class="row">
	<aside id="side" class="large-4 columns">
		<?php $this->load->view('includes/side'); ?>
	</aside>
	<section id="main" class="large-4 large-centered columns">
		<?php echo form_open('user/update'); ?>
			<fieldset>
				<legend>Settings</legend>

					<input type="hidden" name="id" value="<?php echo $row->user_id ?>">

					<label for="name">Username</label>
					<input type="text" name="name" value="<?php echo $row->user_name ?>">

					<label for="email">Email</label>
					<input type="text" name="email" value="<?php echo $row->user_email ?>">
					
					<label for="password">New Password</label>
					<input type="password" name="password">

					<label for="confirm-passowrd">Confirm New Password</label>
					<input type="password" name="confirm-password">

					<input class="button small expand" type="submit" value="Update">
			</fieldset>
		<?php echo form_close(); ?>

	</section>
</section>

<?php $this->load->view('includes/footer');?>