'use strict';

angular.module('channeltrakApp', [
	'ngCookies',
	'ngResource',
	'ngSanitize',
	'ngRoute',
	'ngAnimate'
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
.config(function($locationProvider, $routeProvider) {
	$locationProvider.html5Mode(false);
	$routeProvider
		.when('/latest', {
			templateUrl: 'views/traklist.html',
			controller: 'TraklistCtrl'
		})
		.when('/channel/:slug', {
			templateUrl: 'views/traklist.html',
			controller: 'TraklistCtrl'
		})
		.when('/shuffle/:slug', {
			templateUrl: 'views/trak.html',
			controller: 'TrakCtrl'
		})
		.when('/trak/:slug', {
			templateUrl: 'views/trak.html',
			controller: 'TrakCtrl'
		})
		.when('/directory', {
			templateUrl: 'views/directory.html',
			controller: 'DirectoryCtrl'
		})
		.when('/favorites', {
		  templateUrl: 'views/favorites.html',
		  controller: 'FavoritesCtrl'
		})
		.when('/settings', {
		  templateUrl: 'views/settings.html',
		  controller: 'SettingsCtrl'
		})
		.otherwise({
			redirectTo: '/latest'
		});
});
