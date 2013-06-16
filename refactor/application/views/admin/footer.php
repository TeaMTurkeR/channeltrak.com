	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/javascripts/vendor/jquery.js"><\/script>')</script>

	<?php if (isset($songs)) : ?>
	<script src="http://www.youtube.com/iframe_api"></script>
	<?php endif; ?>

	<?php echo script_tag(base_url().'assets/javascripts/vendor/plugins.js'); ?>
  	<?php echo script_tag(base_url().'assets/javascripts/script.js'); ?>
</body>
</html>