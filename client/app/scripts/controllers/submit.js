'use strict';

angular.module('channeltrakApp')
  	.controller('SubmitCtrl', function ($scope, $rootScope, channelService) {

  		var init = function() {
  			$rootScope.isMenuOpen = false;
  		}

  		$scope.submitChannel = function(url) {

  			$scope.loadingSubmit = true;

	  		channelService.createChannel(url)
	  			.then(function(callback){
	  				$scope.submitSuccess = true; 
	  				$scope.channel_url = '';
	  				$scope.loadingSubmit = false;
	  			}, function() {
	  				$scope.submitSuccess = false;
	  				$scope.loadingSubmit = false;
	  			});

	  	}

	  	init();
	
  	});
