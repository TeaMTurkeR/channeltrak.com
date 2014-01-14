'use strict';

angular.module('channeltrakApp')
  	.directive('trak', function () {
    	return {
	      	restrict: 'A',
	      	link: function (scope, element, attrs) {

	      		element.children('.media').bind('click', function() {

	      			var createYTPlayer = function (vidID){
					    var player = new YT.Player('player', {
					        videoId: vidID,
					        playerVars: {
					            wmode: "opaque",
					            showinfo: 0,
					            modestbranding: 1
					        },
					        events: {
					            'onReady': onPlayerReady,
					            'onStateChange': playerEvents
					        }
					    });
					};

					var onPlayerStateEnded = function (event) {
					    if (event.data == YT.PlayerState.ENDED) {
					        autoplay();
					    }
					}

					var onPlayerReady = function (event) {
					    event.target.playVideo();
					}

					var playerEvents = function (event) {

					    if (event.data == YT.PlayerState.PLAYING) {

					        console.log('playing');

					    } else if (event.data == YT.PlayerState.ENDED) {
					        
					        console.log('next song');

					    } else if (event.data == YT.PlayerState.PAUSED){

					        console.log('paused');

					    } else {

					        console.log('something else');

					    }
					}

			        var youtube_id = attrs.trak
			        var newPlayer = $('<div id="player"></div>');

			        $('#player').remove();
			        $('.trak').not(element).removeClass('playing');
			        element.addClass('playing');
			        element.find('.aspect-ratio').prepend(newPlayer);
			        createYTPlayer(attrs.trak);

			    });

      		}
    	};
  	});
