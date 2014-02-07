'use strict';

angular.module('channeltrakApp')
  	.controller('TraklistCtrl', function ($scope, $route, $routeParams, $rootScope, $location, trakService, channelService, favoriteService) {

  		var init = function() {

  			$(window).scrollTop(0);

  			$rootScope.Traks = []; // CLEAR TRAKS
  			console.log('loading!');

  			$scope.offset = 0;
	  		$scope.pageLength = 50;
	  		$scope.loadingTraks = true;

	  		$scope.moreTraks = false;
	  		$rootScope.isPlayerOpen = false;
	  		$rootScope.isMenuOpen = false;
	  		$rootScope.isAnimated = true;

  			$rootScope.closeEverything();

  			if ($location.path() == '/latest') {

		  		trakService.getTraks('DESC', $scope.offset)
		  			.then(function(callback){
		  				
		  				$rootScope.Traks = callback;
		  				$scope.loadingTraks = false;

		  				if (callback.length == $scope.pageLength) {
		  					$scope.moreTraks = true;
		  				}
		  			});

		  		$scope.pageSpan = 'All'; 
		  		$scope.pageTitle = 'Latest';

		  	} else if ($location.path() == '/randomize') {

		  		trakService.getTraks('RANDOM', $scope.offset)
		  			.then(function(callback){
		  				
		  				$rootScope.Traks = callback;
		  				$scope.loadingTraks = false;

		  				if (callback.length == $scope.pageLength) {
		  					$scope.moreTraks = true;
		  				}
		  			});

		  		$scope.pageSpan = 'All'; 
		  		$scope.pageTitle = 'Random';

		  	} else if ($location.path() == '/search') {

		  		$scope.currentPage = 'search';

		  		if ($scope.searchedQuery = $routeParams.q) {

			  		trakService.searchTraks($routeParams.q, $scope.offset)
			  			.then(function(callback){

			  				if (callback.length > 1) {
			  					$rootScope.Traks = callback;
				  			} else {
				  				$rootScope.Traks = [callback];
				  			}

			  				if (callback.length == $scope.pageLength) {
			  					$scope.moreTraks = true;
			  				}

			  				$scope.loadingTraks = false;

			  			}, function(){

			  				$scope.moreTraks = false;
			  				$rootScope.Traks = false;
			  				$scope.loadingTraks = false;

			  			});

			  			$scope.pageSpan = 'Results for'; 
			  			$scope.pageTitle = '"'+$scope.searchedQuery+'"';

			  	} else {

			  		$scope.isSearchOpen = true;
			  		if ($scope.isSearchOpen) {
						setTimeout(function(){
							$('#search input').focus();
						}, 500);
					}

			  	}

			} else if ($location.path() == '/favorites') {

				$scope.currentPage = 'favorites';

				favoriteService.getFavorites('DESC', $scope.offset)
		  			.then(function(callback){
		  				
		  				if (callback.length > 1) {
		  					$rootScope.Traks = callback;
			  			} else {
			  				$rootScope.Traks = [callback];
			  			}
			  			
		  				$scope.loadingTraks = false;

		  				if (callback.length == $scope.pageLength) {
		  					$scope.moreTraks = true;
		  				}

		  			}, function(){

		  				$scope.moreTraks = false;
		  				$rootScope.Traks = false;
		  				$scope.loadingTraks = false;

			  		});

		  		$scope.pageSpan = 'Your'; 
		  		$scope.pageTitle = 'Favorites';

		  	} else if ($location.path().indexOf('/trak/') != -1) {

		  		$rootScope.isAnimated = false;
		  		$rootScope.isPlayerOpen = true;

		  		trakService.getTrak($routeParams.slug)
		  			.then(function(callback){
		  				$rootScope.newPlayer(callback, 0);

		  				$scope.pageSpan = 'Traks related to'; 
			  			$scope.pageTitle = callback.title;

		  			});

		  		trakService.getTraks('RANDOM', $scope.offset)
		  			.then(function(callback){
		  				
		  				$rootScope.Traks = callback;
		  				$scope.loadingTraks = false;

		  				if (callback.length == $scope.pageLength) {
		  					$scope.moreTraks = true;
		  				}
		  			});

		  		setTimeout(function(){
		  			$rootScope.isAnimated = true;
		  		}, 1000);

		  	} else {

		  		$scope.channelSlug = $routeParams.slug;

		  		channelService.getChannel($scope.channelSlug)
		  			.then(function(callback){
		  				$scope.Channel = callback;

		  				trakService.getChannelTraks($scope.Channel.id, 'DESC', $scope.offset)
				  			.then(function(callback){
				  				
				  				$rootScope.Traks = callback;
				  				$scope.loadingTraks = false;

				  				if (callback.length == $scope.pageLength) {
				  					$scope.moreTraks = true;
				  				}
				  			});

				  		$scope.pageSpan = 'Channel'; 
				  		$scope.pageTitle = $scope.Channel.title;

		  			});

		  	}

	  	}

	  	$scope.pagination = function() {

	  		$scope.loadingPagination = true;
	  		$scope.offset += $scope.pageLength;

	  		setTimeout(function() {
		  		if ($location.path() == '/latest') {

			  		trakService.getTraks('DESC', $scope.offset)
			  			.then(function(callback){
			  				$rootScope.Traks = $rootScope.Traks.concat(callback);
			  				$scope.loadingPagination = false;
			  				if (callback.length < $scope.pageLength) {
			  					$scope.moreTraks = false;
			  				}
			  			});

			  	} else if ($location.path() == '/randomize') {

			  		trakService.getTraks('RANDOM', $scope.offset)
			  			.then(function(callback){
			  				$rootScope.Traks = $rootScope.Traks.concat(callback);
			  				$scope.loadingPagination = false;
			  				if (callback.length < $scope.pageLength) {
			  					$scope.moreTraks = false;
			  				}
			  			});

			  	} else {

			  		trakService.getChannelTraks($scope.Channel.id, 'DESC', $scope.offset)
						.then(function(callback){
						  	$rootScope.Traks = $rootScope.Traks.concat(callback);
						  	$scope.loadingPagination = false;
						  	if (callback.length < 10) {
			  					$scope.moreTraks = false;
			  				}
						});

			  	}
	  		}, 500);
	  	}

	  	init();

  	});
