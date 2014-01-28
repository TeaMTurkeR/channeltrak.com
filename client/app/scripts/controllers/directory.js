'use strict';

angular.module('channeltrakApp')
  	.controller('DirectoryCtrl', function ($scope, channelService) {
	
  		var init = function() {

	  		channelService.getChannels()
	  			.then(function(callback){
	  				$scope.Channels = callback;
	  			});

	  			console.log($scope.Channels);

	  	}

	  	init();
	
  });
