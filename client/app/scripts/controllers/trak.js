'use strict';

angular.module('channeltrakApp')
  	.controller('TrakCtrl', function ($scope, channelService) {
	
  		var init = function() {

	  		channelService.getChannels()
	  			.then(function(callback){
	  				$scope.Channels = callback;
	  			});

	  	}

	  	init();
	
  });
