'use strict';

angular.module('channeltrakApp')
  	.factory('trakService', function ($http, $q) {

		var url = 'http://localhost:8000/channeltrak.com/server/traks';

		var getLatestTraks = function(offset){

			var deferred = $q.defer();

			$http.get(url+'?order=latest&offset='+offset)
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;
		
		};

		var getChannelTraks = function(channelId, offset){

			var deferred = $q.defer();

			$http.get(url+'?order=latest&channel='+channelId+'&offset='+offset)
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

			$http.get(url+trakId)
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
			getLatestTraks: getLatestTraks,
			getChannelTraks: getChannelTraks,
			getTrak: getTrak
		};

	});
