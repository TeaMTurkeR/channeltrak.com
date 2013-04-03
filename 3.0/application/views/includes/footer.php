	<script>
		document.write('<script src=' +
		('__proto__' in {} ? '<?php echo base_url(); ?>assets/javascripts/vendor/zepto' : '<?php echo base_url(); ?>assets/javascripts/vendor/jquery') +
		'.js><\/script>')
	</script>
  
	<?php echo script_tag(base_url().'assets/javascripts/foundation/foundation.js'); ?>

	<?php echo script_tag(base_url().'assets/javascripts/foundation/foundation.alerts.js'); ?>

	<?php echo script_tag(base_url().'assets/javascripts/foundation/foundation.clearing.js'); ?>

	<?php echo script_tag(base_url().'assets/javascripts/foundation/foundation.cookie.js'); ?>

	<?php echo script_tag(base_url().'assets/javascripts/foundation/foundation.dropdown.js'); ?>

	<?php echo script_tag(base_url().'assets/javascripts/foundation/foundation.forms.js'); ?>

	<?php echo script_tag(base_url().'assets/javascripts/foundation/foundation.joyride.js'); ?>
	
	<?php echo script_tag(base_url().'assets/javascripts/foundation/foundation.magellan.js'); ?>

	<?php echo script_tag(base_url().'assets/javascripts/foundation/foundation.orbit.js'); ?>
		
	<?php echo script_tag(base_url().'assets/javascripts/foundation/foundation.placeholder.js'); ?>
		
	<?php echo script_tag(base_url().'assets/javascripts/foundation/foundation.reveal.js'); ?>
		
	<?php echo script_tag(base_url().'assets/javascripts/foundation/foundation.section.js'); ?>
		
	<?php echo script_tag(base_url().'assets/javascripts/foundation/foundation.tooltips.js'); ?>
		
	<?php echo script_tag(base_url().'assets/javascripts/foundation/foundation.topbar.js'); ?>

  	<script>
   		$(document).foundation();
  	</script>

  	<?php echo script_tag(base_url().'assets/javascripts/script.js'); ?>
</body>
</html>