'use strict';

angular.module('channeltrakApp')
  	.factory('favoriteService', function ($http, $q, $location, urlService) {

  		var root = urlService.rootUrl();
  		var url = root+'favorites';

		var createFavorite = function(trak_id) {
			
			var deferred = $q.defer();

			var favoriteData = { 'trak_id': trak_id }

			$http.post(url, favoriteData)
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;

		};

		var getFavorites = function(order, offset){

			var deferred = $q.defer();

			console.log(url+'?order='+order+'&offset='+offset);

			$http.get(url+'?order='+order+'&offset='+offset)
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;
		
		};

		var deleteFavorite = function(trak_id) {
			
			var deferred = $q.defer();

			$http.post(url+'/delete/'+trak_id)
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
			createFavorite: createFavorite,
			getFavorites: getFavorites,
			deleteFavorite: deleteFavorite
		};

	});
