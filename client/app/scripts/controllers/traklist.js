'use strict';

angular.module('channeltrakApp')
  	.controller('TraklistCtrl', function ($scope, $routeParams, $location, trakService, channelService) {

  		$scope.pageNumber = 1;
  		$scope.moreTraks = true;

  		var init = function() {

  			if ($location.path() == '/latest') {

		  		trakService.getLatestTraks($scope.pageNumber)
		  			.then(function(callback){
		  				$scope.Traks = callback;
		  				if (callback.length < 10) {
		  					$scope.moreTraks = false;
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
				  				console.log(callback.length);
				  				if (callback.length < 10) {
				  					$scope.moreTraks = false;
				  				}
				  			});
		  			});
		  	}

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
