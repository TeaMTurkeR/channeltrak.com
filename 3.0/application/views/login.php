<?php 

	$data['title'] = 'Login | Channeltrak';
	$this->load->view('includes/header', $data);

?>

<div class="row">
	<div class="large-6 columns">
		<?php echo form_open('user/login'); ?>
			<fieldset>
				<legend>Login</legend>

					<label for="email">Email</label>
					<input type="text" name="email">
					
					<label for="password">Password</label>
					<input type="password" name="password">

					<input type="submit" value="Submit">

			</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>

<?php $this->load->view('includes/footer');?>