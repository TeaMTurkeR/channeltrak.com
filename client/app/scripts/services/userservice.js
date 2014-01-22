'use strict';

angular.module('channeltrakApp')
  	.factory('userService', function ($http, $q) {

		var url = 'http://localhost/channeltrak.com/server/users';

		var getUsers = function(){

			var deferred = $q.defer();

			$http.get(url+'/authenticate')
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;
		
		};

		var createUser = function(userData) {
			
			var deferred = $q.defer();

			$http.get(url, userData)
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;

		}

		var getUser = function(userSlug){

			var deferred = $q.defer();

			$http.get(url+'/'+channelSlug)
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;
		
		};

		var authenticateUser = function(credentials) {

			var deferred = $q.defer();

			$http.get(url+'/authenticate', credentials)
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
			getUsers: getUsers,
			createUser: createUser,
			getUser: getUser,
			authenticateUser: authenticateUser
		};

	});
