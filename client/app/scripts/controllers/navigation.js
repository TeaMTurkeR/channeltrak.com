'use strict';

angular.module('channeltrakApp')
	.controller('NavigationCtrl', function ($scope, $rootScope, $location, userService, channelService) {

		$scope.toggleSignInModal = function() {
			$scope.isSignInModalVisible = !$scope.isSignInModalVisible;
		}

		$scope.toggleJoinModal = function() {
			$scope.isJoinModalVisible = !$scope.isJoinModalVisible;
		}

		$scope.closeModals = function() {
			$scope.isSignInModalVisible = false;
			$scope.isJoinModalVisible = false;
		}

		$scope.signIn = function(credentials) {

			console.log(credentials);

			userService.authenticateUser(credentials)
				.then(function(callback) {
					console.log(callback);
					$rootScope.User = callback;
					$location.path('/favorites');
				}, function() {
					$scope.error = true;
					$scope.errorMessage = 'Incorrect email or password';
				});

		}

		$scope.join = function(userData) {

		}

	});
