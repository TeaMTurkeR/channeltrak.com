'use strict';

angular.module('channeltrakApp', [
	'ngCookies',
	'ngResource',
	'ngSanitize',
	'ngRoute'
])
.run(function($rootScope, $http, $location){

	// $http.get('http://localhost/moderator/server/authenticate') 
	// 	.success(function(callback){
	// 		$rootScope.loginErrorMessage = false;
	// 		$rootScope.user = callback;
	// 	})
	// 	.error(function(){
	// 		$rootScope.User = false;
	// 		$rootScope.loginErrorMessage = 'Please login first.';
	// 		$location.path('/login');
	// 	});

	// $rootScope.$on('$routeChangeStart', function(current, next) {
	// 	if (next.requireLogin) {
	// 		$http.get('http://localhost/moderator/server/authenticate') 
	// 			.success(function(callback){
	// 				$rootScope.loginErrorMessage = false;
	// 				$rootScope.user = callback;
	// 			})
	// 			.error(function(){
	// 				$rootScope.User = false;
	// 				$rootScope.loginErrorMessage = 'Please login first.';
	// 				$location.path('/login');
	// 			});
	// 	}
	// });

})
.config(function ($routeProvider) {
	$routeProvider
		.when('/latest', {
			templateUrl: 'views/latest.html',
			controller: 'LatestCtrl'
		})
		.when('/popular', {
			templateUrl: 'views/popular.html',
			controller: 'PopularCtrl'
		})
		.when('/directory', {
			templateUrl: 'views/directory.html',
			controller: 'DirectoryCtrl'
		})
		.otherwise({
			redirectTo: '/latest'
		});
});
