'use strict';

angular.module('channeltrakApp')
  	.controller('LatestCtrl', function ($scope, trakService) {

  		var init = function() {

	  		trakService.getTraks('latest', 0)
	  			.then(function(callback){
	  				$scope.Traks = callback;
	  			});

	  	}

	  	init();

  	});
