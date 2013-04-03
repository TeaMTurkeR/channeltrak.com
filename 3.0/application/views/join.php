<?php 

	$data['title'] = 'Join | Channeltrak';
	$this->load->view('includes/header', $data);

?>

<div class="row">
	<div class="large-6 columns">
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

					<input type="submit" value="Submit">
			</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>

<?php $this->load->view('includes/footer');?>