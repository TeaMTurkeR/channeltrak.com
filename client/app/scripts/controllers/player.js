'use strict';

angular.module('channeltrakApp')
	.controller('PlayerCtrl', function ($scope, $rootScope, $location, userService, channelService) {

		$scope.togglePlayer = function() {
			$rootScope.isPlayerOpen = !$rootScope.isPlayerOpen;
			console.log($rootScope.isPlayerOpen);
		}

	});
