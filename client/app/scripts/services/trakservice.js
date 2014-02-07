'use strict';

angular.module('channeltrakApp')
  	.factory('trakService', function ($http, $q, $location, urlService) {

  		var root = urlService.rootUrl();
  		var url = root+'traks';

		var getTraks = function(order, offset){

			var deferred = $q.defer();

			$http.get(url+'?order='+order+'&offset='+offset)
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;
		
		};

		var getChannelTraks = function(channelId, order, offset){

			var deferred = $q.defer();

			$http.get(url+'?channel='+channelId+'&order='+order+'&offset='+offset)
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;
		
		};

		var searchTraks = function(query, offset){

			var deferred = $q.defer();

			console.log(url+'?q='+query+'&order=latest&offset='+offset);

			$http.get(url+'?q='+query+'&order=latest&offset='+offset)
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;
		
		};

		var getTrak = function(trakId){

			var deferred = $q.defer();

			$http.get(url+'/'+trakId)
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
			getTraks: getTraks,
			getChannelTraks: getChannelTraks,
			searchTraks: searchTraks,
			getTrak: getTrak
		};

	});
