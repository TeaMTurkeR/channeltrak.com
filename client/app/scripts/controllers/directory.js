'use strict';

angular.module('channeltrakApp')
  	.controller('DirectoryCtrl', function ($scope, $rootScope, channelService) {
	
  		var init = function() {

  			$rootScope.isPlayerOpen = false;
  			$rootScope.isMenuOpen = false;

	  		channelService.getChannels()
	  			.then(function(callback){
	  				$scope.Channels = callback;
	  			});

	  	}

	  	init();
	
  });
