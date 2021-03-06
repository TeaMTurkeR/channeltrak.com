'use strict';

angular.module('channeltrakApp')
  	.factory('userService', function ($http, $q, $location, urlService) {

  		var root = urlService.rootUrl();
  		var url = root+'traks';
  		
		var createUser = function(userData) {
			
			var deferred = $q.defer();

			$http.post(url, userData)
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;

		}

		var getUser = function(){

			var deferred = $q.defer();

			$http.get(url)
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;
		
		};

		var authUser = function(credentials) {

			var deferred = $q.defer();
			
			$http.post(url+'/auth', credentials)
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;
		}

		var unauthUser = function(credentials) {

			var deferred = $q.defer();

			$http.post(url+'/unauth')
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;
		}

		var signOutUser = function() {

			var deferred = $q.defer();

			$http.post(url+'/signout')
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;
		}

		// Public API

		return {
			createUser: createUser,
			getUser: getUser,
			authUser: authUser,
			unauthUser: unauthUser
		};

	});
