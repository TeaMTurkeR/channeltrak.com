'use strict';

angular.module('channeltrakApp')
  	.factory('userService', function ($http, $q) {

		var url = 'http://localhost:8000/channeltrak.com/server/users';

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

		var getUser = function(id){

			var deferred = $q.defer();

			$http.get(url+'/'+id)
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

			$http.post(url+'/auth', credentials)
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
