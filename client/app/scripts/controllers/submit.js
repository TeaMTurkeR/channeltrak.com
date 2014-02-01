'use strict';

angular.module('channeltrakApp')
  	.controller('SubmitCtrl', function ($scope, channelService) {

  		$scope.submitChannel = function(url) {

	  		channelService.createChannel(url)
	  			.then(function(callback){
	  				$scope.success = true; 
	  			}, function() {
	  				$scope.success = false;
	  			});

	  	}

	
  	});
