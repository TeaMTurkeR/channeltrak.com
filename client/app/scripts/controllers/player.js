'use strict';

angular.module('channeltrakApp')
	.controller('PlayerCtrl', function ($scope, $rootScope, $location, userService, channelService) {

		$scope.togglePlayer = function() {
			$rootScope.isPlayerOpen = !$rootScope.isPlayerOpen;
		}

		$scope.toggleSignInModal = function() {
			$scope.isSignInModalVisible = !$scope.isSignInModalVisible;
		}

		$scope.toggleJoinModal = function() {
			$scope.isJoinModalVisible = !$scope.isJoinModalVisible;
		}

		$scope.closeModals = function() {
			$scope.isSignInModalVisible = false;
			$scope.isJoinModalVisible = false;
		}

		$scope.signIn = function(credentials) {

			userService.authUser(credentials)
				.then(function(callback) {
					console.log(callback);
					$rootScope.User = callback;
					$scope.closeModals();
				}, function() {
					$scope.error = true;
					$scope.errorMessage = 'Incorrect email or password';
				});

		}

		$scope.join = function(userData) {

			userService.createUser(userData)
				.then(function(user_id) {
					
					userService.getUser(user_id)
						.then(function(callback){
							$rootScope.User = callback;
						});

				}, function() {
					$scope.error = true;
					$scope.errorMessage = 'User exists';
				});

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
			} else if ($scope.playerState == 2) {
				$scope.player.playVideo();
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

		$rootScope.newPlayer = function (trak, index){

			$scope.Playlist = angular.copy($rootScope.Traks);

			$rootScope.playing = trak;
			$rootScope.playing.index = index;

			$('#holder img').remove();

			var newImage = $('<img src="http://img.youtube.com/vi/'+trak.youtube_id+'/hqdefault.jpg">');
			$('#holder').prepend(newImage);

			var $image = document.getElementById('holder').getElementsByTagName('img')[0];
	  		var colorThief = new ColorThief();
			var playerColor = colorThief.getColor($image);	

			$('#player').css('backgroundColor', 'rgb('+playerColor+')');
			$('#video h2').css('color', textColor(playerColor));

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
		     
		}

		// Private Methods

		var textColor = function(rgb) {

			// SOURCE: http://www.w3.org/TR/AERT#color-contrast

			var red = rgb[0];
			var green = rgb[1];
			var blue = rgb[2];

			var brightness = ((red * 299) + (green * 587) + (blue * 114)) / 1000;
			var colorDiffBlack = (Math.max(red, 0) - Math.min(red, 0)) + (Math.max(green, 0) - Math.min(green, 0)) + (Math.max(blue, 0) - Math.min(blue, 0));
			var colorDiffWhite = (Math.max(red, 255) - Math.min(red, 255)) + (Math.max(green, 255) - Math.min(green, 255)) + (Math.max(blue, 255) - Math.min(blue, 255));
		
			if (colorDiffBlack > colorDiffWhite) {
				return 'inherit';
			} else {
				return '#fff'
			}
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
		}


	});
