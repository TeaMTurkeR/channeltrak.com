'use strict';

angular.module('channeltrakApp', [
	'ngCookies',
	'ngResource',
	'ngSanitize',
	'ngRoute',
	'ngAnimate'
])
.run(function($rootScope, $http, $location, userService){

	// WHEN THE APP FIRST RUNS
	userService.getUser()
		.then(function(callback){
			$rootScope.User = callback;
			$rootScope.isAuthed = true;
		},function(error){
			$rootScope.isAuthed = false;
		});

	// WHEN EVER YOU GO TO A PAGE THAT IS RESTRICTED...
	$rootScope.$on('$routeChangeStart', function(current, next) {
		if (next.requireLogin) {
			userService.getUser()
				.then(function(callback){
					$rootScope.isAuthed = true;
				},function(error){
					console.log(error);
					$rootScope.isAuthed = false;
					$location.path('/sign-in');
				});
		}
	});

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
		  controller: 'FavoritesCtrl',
		  requireLogin: true
		})
		.when('/settings', {
		  templateUrl: 'views/settings.html',
		  controller: 'SettingsCtrl',
		  requireLogin: true
		})
		.when('/sign-in', {
		  templateUrl: 'views/signin.html',
		  controller: 'SigninCtrl'
		})
		.when('/join', {
		  templateUrl: 'views/join.html',
		  controller: 'JoinCtrl'
		})
		.otherwise({
			redirectTo: '/latest'
		});
});
