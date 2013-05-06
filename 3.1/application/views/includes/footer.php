		<footer id="footer">
			<div class="row">
				<div class="large-12 columns">
	 				<ul class="inline-list left">
						<li>{elapsed_time} Seconds to Midnight</li>
						<!-- <li><a href="">About</a></li>
						<li><a href="">Contact</a></li>
						<li><a href="">Terms</a></li>
						<li><a href="">Privacy</a></li>
 -->					</ul>
					<ul class="inline-list right">
						<li>&copy Channeltrak 2013</li>
					</ul>
				</div>
			</div>
		</footer>
	</div> <!-- END WRAP -->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/javascripts/vendor/jquery.js"><\/script>')</script>

    <script>
    	
    </script>

	<?php if (isset($songs)) : ?>
	<script src="http://www.youtube.com/iframe_api"></script>
	<?php endif; ?>

	<?php echo script_tag(base_url().'assets/javascripts/vendor/plugins.js'); ?>
  	<?php echo script_tag(base_url().'assets/javascripts/script.js'); ?>

  	<?php if (isset($splash)) : ?>
	<script>
	$(function() {

		$(window).scroll(function(){
	        if ( $(window).scrollTop() > $(window).height() ) {
	            $('#side, #controls button, #playing-thumbnail').addClass('scroll');
	        } else {
	            $('#side, #controls button, #playing-thumbnail').removeClass('scroll');
	        }
	    });

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
	<?php else : ?>
	<script>
		$('#side, #controls button, #playing-thumbnail').addClass('scroll');
	</script>
  	<?php endif; ?>

  	<script type="text/javascript">
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

