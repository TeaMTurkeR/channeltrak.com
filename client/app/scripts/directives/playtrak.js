'use strict';

angular.module('channeltrakApp')
  	.directive('playTrak', function () {
    	return {
	      	restrict: 'A',
	      	link: function (scope, element, attrs) {

	      		element.bind('click', function() {

	      			alert(attrs.trak);

			        var youtube_id = attrs.trak
			        var $newPlayer = $('<div id="player"></div>');

			        $('#player').remove();
			        $post.addClass('playing');
			        $('.post').not($post).removeClass('playing');
			        $media.prepend($newPlayer);

			        if ($post.hasClass('youtube')) {
			            $('#play').children('i').removeClass().addClass('icon-bolt');
			            createYTPlayer(post_media);
			        } else {
			            $('#play').children('i').removeClass().addClass('icon-ban-circle');
			            SC.oEmbed(post_media, {auto_play: true}, $('#player').get(0));
			        }

			        $.scrollTo('.playing', 500, {offset:-79} );
			        $('#menu, #wrap').removeClass('open-menu');
			        
			    });

      		}
    	};
  	});
