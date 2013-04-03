<?php 

	$data['title'] = 'Submit | Channeltrak';
	$this->load->view('includes/header', $data);

?>

<div class="row">
	<div class="large-6 columns">
		<?php echo form_open('channel/submit'); ?>
			<fieldset>
				<legend>Submit a Channel</legend>

					<label for="name">Channel Name</label>
					<input type="text" name="name">

					<label for="url">Channel URL</label>
					<input type="text" name="url">

					<input type="submit" value="Submit">
					
			</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>

<?php $this->load->view('includes/footer');?>