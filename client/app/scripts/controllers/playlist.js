'use strict';

angular.module('channeltrakApp')
  	.controller('PlaylistCtrl', function ($scope, $rootScope, channelService, playerService) {
	
  		var init = function() {

  			$rootScope.Playlist = [];

	  		channelService.getChannels()
	  			.then(function(callback){
	  				$scope.Channels = callback;
	  			});

	  	}

	  	$scope.playTrak = function(trak) {
	  		$rootScope.playing = trak;
	        playerService.createYTPlayer(trak.youtube_id);
	  	}

	  	$scope.removeFromPlaylist = function(index) {
	  		$scope.Playlist.splice(index, 1);	  		
	  	}

	  	init();
	
  });
