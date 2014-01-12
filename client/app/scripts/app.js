'use strict';

angular.module('channeltrakApp', [])
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
			.when('/channel/:slug', {
				templateUrl: 'views/channel.html',
				controller: 'ChannelCtrl'
			})
			.when('/trak', {
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
			.otherwise({
				redirectTo: '/latest'
			});
	})
	.factory('Latest', function($http) {
		var Latest = {};
		Latest.get = function(callback) {
		    $http.get('http://channeltrak.com/services/api/latest').success(function(data){
		      	callback(data);
		    });
		};
		return Latest;
	})
	.factory('Popular', function($http) {
		var Popular = {};
		Popular.get = function(callback) {
		    $http.get('http://channeltrak.com/services/api/popular').success(function(data){
		      	callback(data);
		    });
		};
		return Popular;
	})
	.factory('Directory', function($http) {
		var Directory = {};
		Directory.get = function(callback) {
		    $http.get('http://channeltrak.com/services/api/channels').success(function(data){
		      	callback(data);
		    });
		};
		return Directory;
	})
	.factory('Channel', function($http) {
		var Channel = {};
		Channel.get = function(slug, callback) {
		    $http.get('http://channeltrak.com/services/api/channel/'+slug).success(function(data){
		      	callback(data);
		    });
		};
		return Channel;
	});



