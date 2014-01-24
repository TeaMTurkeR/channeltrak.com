'use strict';

angular.module('channeltrakApp')
  	.service('playerService', function Playerservice() {

	  	var createYTPlayer = function (vidID){

	  		var newPlayer = $('<div id="iframe"></div>');

			$('#iframe')
				.remove();
			$('#video .aspect-ratio')
				.prepend(newPlayer)
				.addClass('playing');

		    var player = new YT.Player('iframe', {
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
		}

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

		// Public API

		return {
			createYTPlayer: createYTPlayer,
			onPlayerStateEnded: onPlayerStateEnded,
			onPlayerReady: onPlayerReady,
			playerEvents: playerEvents
		};

  });
