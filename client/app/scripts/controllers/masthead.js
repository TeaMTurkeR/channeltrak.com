'use strict';

angular.module('channeltrakApp')
	.controller('MastheadCtrl', function ($scope, $rootScope, $location, userService, channelService) {

		$scope.togglePlayer = function() {
			$rootScope.isPlayerOpen = !$rootScope.isPlayerOpen;
			console.log($rootScope.isPlayerOpen);
		}

		$scope.toggleSignInModal = function() {
			$scope.isSignInModalVisible = !$scope.isSignInModalVisible;
		}

		$scope.toggleJoinModal = function() {
			$scope.isJoinModalVisible = !$scope.isJoinModalVisible;
		}

		$scope.toggleMenu = function() {
			$scope.isMenuOpen = !$scope.isMenuOpen;
		}

		$scope.closeModals = function() {
			$scope.isSignInModalVisible = false;
			$scope.isJoinModalVisible = false;
		}

		$scope.signIn = function(credentials) {

			userService.authUser(credentials)
				.then(function(callback) {
					console.log(callback);
					$rootScope.User = callback;
					$scope.closeModals();
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
