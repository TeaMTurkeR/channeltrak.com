'use strict';

angular.module('channeltrakApp')
  	.controller('SubmitCtrl', function ($scope, channelService) {

  		$scope.submitChannel = function(url) {

	  		channelService.createChannel(url)
	  			.then(function(callback){
	  				console.log(callback);
	  			});

	  	}

	
  	});
