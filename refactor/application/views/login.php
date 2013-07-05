<?php $this->load->view('includes/header'); ?>
<div id="page">
	<?php $this->load->view('includes/side'); ?>
	
	<?php $this->load->view('includes/info'); ?>


	<section id="main">
		<?php echo form_open('user/login', 'id=login class=form' ); ?>
			
			<?php if(isset($error)) : ?>
			<p class="error"><?php echo $error ?></p>
			<?php endif ?>

			<label for="name">Username</label>
			<input type="text" name="name" required value="<?php if(isset($username)){ echo $username; } ?>">
			
			<label for="password">Password</label>
			<input type="password" name="password" required>

			<input class="button" type="submit" value="Login">

		<?php echo form_close(); ?>

		<div class="form-side">
			<h3>Don't have an account?</h3>
			<a href="<?php echo base_url(); ?>join" class="button">Join Channeltrak</a>
		</div>
	</section>

	<?php $this->load->view('includes/links'); ?>

</div>
<?php $this->load->view('includes/footer'); ?>