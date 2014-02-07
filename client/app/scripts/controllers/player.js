'use strict';

angular.module('channeltrakApp')
	.controller('PlayerCtrl', function ($scope, $route, $rootScope, $location, userService, channelService, favoriteService) {

		var init = function() {

		}

		$scope.signOut = function() {

			userService.unauthUser()
				.then(function(callback) {
					$rootScope.User = false;
					$rootScope.isAuthed = false;
					location.reload();
				}, function() {
					location.reload();
				});
		}

		$scope.togglePlayer = function() {
			if ($scope.playing) {
				$rootScope.isMenuOpen = false;
				$rootScope.isSearchOpen = false;
				$rootScope.isPlayerOpen = !$rootScope.isPlayerOpen;
			}
		}

		$scope.toggleMenu = function() {
			$rootScope.isSearchOpen = false;
			$rootScope.isMenuOpen = !$rootScope.isMenuOpen;

			if ($rootScope.isMenuOpen) {
				$(document.body).animate({
				    'scrollTop': 0
				}, 1000);
			}
		}

		$rootScope.keydown = function(event){

			var pos = $('body').scrollTop();

			if (event.keyCode == 37) {

				$scope.playPrevious();

			} else if (event.keyCode == 38 && pos == 0) {

				$rootScope.isPlayerOpen = true;

			} else if (event.keyCode == 39) {

				$scope.playNext();

			} else if (event.keyCode == 40) {

				$rootScope.isPlayerOpen = false;

			}
		}

		$scope.togglePlay = function() {
			if ($scope.playerState == 1) {
				$scope.player.pauseVideo();
				clearInterval($scope.tickerProgress);
			} else if ($scope.playerState == 2) {
				$scope.player.playVideo();
				ticker();
			}
		}

		$scope.playPrevious = function() {

			if ($rootScope.playing.index > 0) {

				var nextTrak = $scope.Playlist[$rootScope.playing.index - 1];
				var index = $rootScope.playing.index - 1

				$rootScope.newPlayer(nextTrak, index);

			}

		}

		$scope.playNext = function() {

			var nextTrak = $scope.Playlist[$rootScope.playing.index + 1];
			var index = $rootScope.playing.index + 1

			$rootScope.newPlayer(nextTrak, index);

		}

		$rootScope.toggleFavorite = function(trak) {

			$scope.loadingFavorite = true;

			if (!trak.favorited && $rootScope.isAuthed) {
				favoriteService.createFavorite(trak.id)
					.then(function() {
						console.log('added');
						$scope.loadingFavorite = false;
						trak.favorited = true;
					});

			} else if (trak.favorited) {
				console.log('destroying...');
				favoriteService.deleteFavorite(trak.id)
					.then(function(){
						console.log('...and it\'s gone');
						$scope.loadingFavorite = false;
						trak.favorited = false;
					});

			} else {
				$rootScope.toggleSignInModal();
				$rootScope.signInErrorMessage = 'You need to sign in first!';
			}

		}

		$rootScope.newPlayer = function (trak, index){

			console.log('initalizing new player');

			$scope.Playlist = angular.copy($rootScope.Traks);

			$rootScope.playing = trak;
			$rootScope.playing.index = index;

			$scope.playerState = 3;
	  		var newPlayer = $('<div id="iframe"></div>');

			$('#iframe')
				.remove();
			$('#video .aspect-ratio')
				.prepend(newPlayer)
				.addClass('playing');

		    $scope.player = new YT.Player('iframe', {
		        videoId: trak.youtube_id,
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

		    ticker();
		     
		}

		$scope.scrollToPlaying = function() {
			if ($('#'+$scope.playing.id).length) {
				$(document.body).animate({
				    'scrollTop': $('#'+$scope.playing.id).offset().top - 60
				}, 2000);
			}
		}

		// Private Methods

		var setColors = function(color) {

			$('#player').css('backgroundColor', color);
			$('#ticker').css('borderColor', color);
			$('#masthead').css('borderBottomColor', color);

			$('#video, #ticker .info, .sharing .button').css('color', textColor(color));
			$('.sharing .button').css('borderColor', textColor(color));
		} 

		var ticker = function() {
			$scope.tickerProgress = setInterval(function(){

		    	if ($scope.player) {

		    		var length = $scope.player.getDuration();
		    		var lengthText = calculateTime(length);

			    	var time = $scope.player.getCurrentTime();
			    	var percent = (time/length)*100 + '%';

			    	var progressText = calculateTime(time) + ' / ' + lengthText;

			    	$('#ticker').css('left', percent);
			    	$('#ticker span').text(progressText);

			    }

		    }, 1000);
		}

		var calculateTime = function(time) {

		    var minutes = Math.floor(time / 60);
		    var seconds = Math.round(time - minutes * 60);

		    if (seconds < 10) {
		        seconds = '0' + seconds;
		    }

		    return minutes + ':' + seconds;

		}

		var textColor = function(hex) {

			var color = hexToRgb(hex); 
			var red = color.r;
			var green = color.g;
			var blue = color.b;

			var brightness = ((red * 299) + (green * 587) + (blue * 114)) / 1000;
			var colorDiffBlack = (Math.max(red, 0) - Math.min(red, 0)) + (Math.max(green, 0) - Math.min(green, 0)) + (Math.max(blue, 0) - Math.min(blue, 0));
			var colorDiffWhite = (Math.max(red, 255) - Math.min(red, 255)) + (Math.max(green, 255) - Math.min(green, 255)) + (Math.max(blue, 255) - Math.min(blue, 255));

			if (colorDiffBlack > colorDiffWhite) {
				return 'inherit';
			} else {
				return '#fff'
			}
		}

		function hexToRgb(hex) {
		    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
		    return result ? {
		        r: parseInt(result[1], 16),
		        g: parseInt(result[2], 16),
		        b: parseInt(result[3], 16)
		    } : null;
		}

		var playerEvents = function (event) {

			// -1 (unstarted)
			// 0 (ended)
			// 1 (playing)
			// 2 (paused)
			// 3 (buffering)
			// 5 (video cued).

			$scope.playerState = event.data;

			if ($scope.playerState == 0) {
				$scope.playNext();
			}

			$scope.$apply();

		}

		var onPlayerStateEnded = function (event) {
		    if (event.data == YT.PlayerState.ENDED) {
		        autoplay();
		    }
		}

		var onPlayerReady = function (event) {
		    event.target.playVideo();
		    setColors($rootScope.playing.color_sample);
		    // $scope.showTicker = true;
		    // setTimeout(function(){
		    // 	$scope.showTicker = false;
		    // 	$scope.$apply();
		    // }, 5000);
		}

		init();

	});
