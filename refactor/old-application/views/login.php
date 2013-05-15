<?php $this->load->view('includes/header', $data); ?>

<section class="row">
	<aside id="side" class="large-4 columns">
		<?php $this->load->view('includes/side'); ?>
	</aside>
	<section id="main" class="large-4 large-centered columns">
		<?php echo form_open('user/login'); ?>
			<fieldset>

					<label for="email">Email</label>
					<input type="text" name="email">
					
					<label for="password">Password</label>
					<input type="password" name="password">

					<input class="button small expand" type="submit" value="Login">

			</fieldset>
		<?php echo form_close(); ?>
	</section>
</section>

<?php $this->load->view('includes/footer');?>