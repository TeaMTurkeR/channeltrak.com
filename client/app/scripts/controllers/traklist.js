'use strict';

angular.module('channeltrakApp')
  	.controller('TraklistCtrl', function ($scope, $routeParams, $rootScope, $location, trakService, channelService, playerService) {

  		$scope.offset = 0;
  		$scope.pageLength = 50;

  		$scope.moreTraks = true;
  		$scope.isListLayout = false;

  		var init = function() {

  			if ($location.path() == '/latest') {

		  		trakService.getLatestTraks($scope.offset)
		  			.then(function(callback){
		  				$rootScope.Traks = callback;
		  				if (callback.length < 10) {
		  					$scope.moreTraks = false;
		  				}
		  				if (!$rootScope.playing) {
			  				// $scope.playTrak($rootScope.Traks[0]);
			  			}
		  			});

		  	} else if ($location.path() == '/popular') {

		  	} else {

		  		$scope.channelSlug = $routeParams.slug;

		  		channelService.getChannel($scope.channelSlug)
		  			.then(function(callback){
		  				$scope.Channel = callback;

		  				trakService.getChannelTraks($scope.Channel.id, $scope.offset)
				  			.then(function(callback){
				  				$rootScope.Traks = callback;
				  				if (callback.length < $scope.pageLength) {
				  					$scope.moreTraks = false;
				  				}
				  			});
		  			});
		  	}

	  	}

	  	$scope.pagination = function() {

	  		$scope.loadingMoreTraks = true;
	  		$scope.offset += $scope.pageLength;

	  		setTimeout(function() {
		  		if ($location.path() == '/latest') {

			  		trakService.getLatestTraks($scope.offset)
			  			.then(function(callback){
			  				$rootScope.Traks = $rootScope.Traks.concat(callback);
			  				$scope.loadingMoreTraks = false;
			  				if (callback.length < $scope.pageLength) {
			  					$scope.moreTraks = false;
			  				}
			  			});

			  	} else if ($location.path() == '/popular') {


			  	} else {

			  		trakService.getChannelTraks($scope.Channel.id, $scope.offset)
						.then(function(callback){
						  	$rootScope.Traks = $rootScope.Traks.concat(callback);
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
