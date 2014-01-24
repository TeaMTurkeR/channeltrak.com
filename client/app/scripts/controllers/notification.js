'use strict';

angular.module('channeltrakApp')
	.controller('NotificationCtrl', function ($scope, $rootScope, $location, userService, channelService) {

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

			userService.authUser(credentials)
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

			userService.createUser(userData)
				.then(function(user_id) {
					
					userService.getUser(user_id)
						.then(function(callback){
							$rootScope.User = callback;
						});

				}, function() {
					$scope.error = true;
					$scope.errorMessage = 'User exists';
				});

		}

	});
