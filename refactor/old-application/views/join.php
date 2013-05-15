<?php $this->load->view('includes/header', $data); ?>

<section class="row">
	<aside id="side" class="large-4 columns">
		<?php $this->load->view('includes/side'); ?>
	</aside>
	<section id="main" class="large-4 large-centered columns">
		<?php echo form_open('user/register'); ?>
			<fieldset>
				<legend>Join Channeltrak</legend>
					<label for="name">Username</label>
					<input type="text" name="name">

					<label for="email">Email</label>
					<input type="text" name="email">
					
					<label for="password">Password</label>
					<input type="password" name="password">

					<label for="confirm-passowrd">Confirm Password</label>
					<input type="password" name="confirm-password">

					<input class="button small expand" type="submit" value="Submit">
			</fieldset>
		<?php echo form_close(); ?>
	</section>
</section>

<?php $this->load->view('includes/footer');?>