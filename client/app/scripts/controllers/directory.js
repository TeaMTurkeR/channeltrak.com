'use strict';

angular.module('channeltrakApp')
  	.controller('DirectoryCtrl', function ($scope, $rootScope, channelService) {
	
  		var init = function() {

  			$rootScope.isPlayerOpen = false;

	  		channelService.getChannels()
	  			.then(function(callback){
	  				$scope.Channels = callback;
	  			});

	  			console.log($scope.Channels);

	  	}

	  	init();
	
  });
