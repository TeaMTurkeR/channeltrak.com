'use strict';

angular.module('channeltrakApp')
  .controller('SigninCtrl', function ($scope, $rootScope, $location, userService) {

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

  	});
