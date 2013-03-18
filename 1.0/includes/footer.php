	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>
	
	<script>
		var winW = $(window).width();
		var winH = $(window).height() - $('#header').height();
		$('#track-player').width(winW).height(winH).css('margin-left', winW);
		$('#player').height($('#player').width()*.5625);

	</script>

	<script src="js/libs/foundation.min.js"></script>
	
	<script src="http://www.youtube.com/iframe_api"></script>
	<script src="js/youtube.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/script.js"></script>

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