'use strict';

angular.module('channeltrakApp')
  	.factory('trakService', function ($http, $q) {

		var url = 'http://localhost:9000/traks.json';
		var deferred = $q.defer();

		var getTraks = function(){

			$http.get(url)
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;
		
		};

		// Public API

		return {
			getTraks: getTraks
		};

	});
