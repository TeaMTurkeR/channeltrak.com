	<article id="login-modal" class="modal" style="display:none">
		<h3>You need to...</h3>
		<a href="<?php echo base_url(); ?>login" class="button">Login</a>
		<p>or</p>
		<a href="<?php echo base_url(); ?>join" class="button">Join Channeltrak</a>	
	</article>

	<div id="overlay" style="display:none;"></div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/javascripts/vendor/jquery.js"><\/script>')</script>

	<?php if (isset($songs)) : ?>
	<script src="http://www.youtube.com/iframe_api"></script>
	<?php endif; ?>

	<?php echo script_tag(base_url().'assets/javascripts/vendor/plugins.js'); ?>
  	<?php echo script_tag(base_url().'assets/javascripts/script.js'); ?>

  	<?php if (isset($splash)) : ?>
	<script>
		$(function() {
			var cookie = 'splash-page-cookie';
			$isset = $.cookies.get(cookie);
			if ($isset == null) {
				$.cookies.set( cookie, 'Channeltrak', { expiresAt: 30 });
				$('#splash').height($(window).height());
			} else {
				$('#splash').hide();
			}
		});
	</script>
	<?php endif; ?>

  	<?php if (isset($pagination)) : ?>
	<script>
		var ajaxUrl = '<?php echo base_url(); ?><?php echo $pagination; ?>';
	</script>
  	<?php endif; ?>

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