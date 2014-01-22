'use strict';

angular.module('channeltrakApp')
  	.controller('TraklistCtrl', function ($scope, $routeParams, $rootScope, $location, trakService, channelService, playerService) {

  		$scope.pageNumber = 1;
  		$scope.moreTraks = true;
  		$scope.isListLayout = false;

  		var init = function() {

  			if ($location.path() == '/latest') {

		  		trakService.getLatestTraks($scope.pageNumber)
		  			.then(function(callback){
		  				$scope.Traks = callback;
		  				if (callback.length < 10) {
		  					$scope.moreTraks = false;
		  				}
		  				if (!$rootScope.playing) {
			  				// $scope.playTrak($scope.Traks[0]);
			  			}
		  			});

		  	} else if ($location.path() == '/popular') {

		  	} else {

		  		$scope.channelSlug = $routeParams.slug;

		  		channelService.getChannel($scope.channelSlug)
		  			.then(function(callback){
		  				$scope.Channel = callback;

		  				trakService.getChannelTraks($scope.Channel.id, $scope.pageNumber)
				  			.then(function(callback){
				  				$scope.Traks = callback;
				  				if (callback.length < 10) {
				  					$scope.moreTraks = false;
				  				}
				  				if (!$rootScope.playing) {
					  				// $scope.playTrak($scope.Traks[0]);
					  			}
				  			});
		  			});
		  	}

	  	}

	  	$scope.gridLayout = function() {
	  		$scope.isListLayout = false;
	  	}

	  	$scope.listLayout = function() {
	  		$scope.isListLayout = true;
	  	}

	  	$scope.playTrak = function(trak) {
	  		$rootScope.playing = trak;
	        playerService.createYTPlayer(trak.youtube_id);
	  	}

	  	$scope.addToPlaylist = function(trak) {
		  	$rootScope.Playlist.push(trak);
	  	}

	  	$scope.pagination = function() {

	  		$scope.loadingMoreTraks = true;
	  		$scope.pageNumber++

	  		setTimeout(function() {
		  		if ($location.path() == '/latest') {

			  		trakService.getLatestTraks($scope.pageNumber)
			  			.then(function(callback){
			  				$scope.Traks = $scope.Traks.concat(callback);
			  				$scope.loadingMoreTraks = false;
			  				if (callback.length < 10) {
			  					$scope.moreTraks = false;
			  				}
			  			});

			  	} else if ($location.path() == '/popular') {


			  	} else {

			  		trakService.getChannelTraks($scope.Channel.id, $scope.pageNumber)
						.then(function(callback){
						  	$scope.Traks = $scope.Traks.concat(callback);
						  	$scope.loadingMoreTraks = false;
						  	if (callback.length < 10) {
			  					$scope.moreTraks = false;
			  				}
						});

			  	}
	  		}, 1000);
	  	}

	  	init();

  	});
