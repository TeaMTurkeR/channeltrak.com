'use strict';

angular.module('channeltrakApp')
  	.factory('userService', function ($http, $q) {

		var url = 'http://localhost/channeltrak.com/server/users';

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

			console.log(credentials);

			$http.get(url+'/auth', credentials)
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
		};

	});
