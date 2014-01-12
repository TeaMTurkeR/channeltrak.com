	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/javascripts/vendor/jquery.js"><\/script>')</script>

    <script>
		var tag = document.createElement('script');
	    tag.src = "https://www.youtube.com/iframe_api";
	    var firstScriptTag = document.getElementsByTagName('script')[0];
	    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	</script>
	
	<?php echo script_tag(base_url().'assets/javascripts/vendor/plugins.js'); ?>
  	<?php echo script_tag(base_url().'assets/javascripts/frontend.js'); ?>

  	<script>
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-38870469-1']);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
	
</body>
</html>