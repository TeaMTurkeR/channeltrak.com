'use strict';

angular.module('channeltrakApp')
  .controller('SigninCtrl', function ($scope, $rootScope, $location, userService) {

		$scope.signIn = function(credentials) {

			userService.authUser(credentials)
				.then(function(callback) {
					$rootScope.User = callback;
					$location.path('/favorites');
				}, function() {
					$scope.error = true;
					$scope.errorMessage = 'Incorrect email or password';
				});

		}

  	});
