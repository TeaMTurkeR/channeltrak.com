<?php 

	$data['title'] = 'Channeltrak';
	$this->load->view('includes/header', $data);

?>

<section class="row">
	<aside id="side" class="large-3 columns">
		<?php $this->load->view('includes/side'); ?>
	</aside>
	<section id="main" class="large-9 columns">
		<?php $this->load->view('includes/controls'); ?>
		<?php $this->load->view('includes/loop'); ?>
		<?php echo $links; ?>
	</section>
</section>

<?php $this->load->view('includes/footer');?>