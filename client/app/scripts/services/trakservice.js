'use strict';

angular.module('channeltrakApp')
  	.factory('trakService', function ($http, $q) {

		var url = 'http://localhost/channeltrak.com/server/traks';

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

		var getPopularTraks = function(pageNumber){

			var deferred = $q.defer();

			$http.get(url+'popular/page/'+pageNumber)
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;
		
		};

		var getChannelTraks = function(channelId, pageNumber){

			var deferred = $q.defer();

			$http.get(url+'channel/'+channelId+'/page/'+pageNumber)
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
			getPopularTraks: getPopularTraks,
			getChannelTraks: getChannelTraks,
			getTrak: getTrak
		};

	});
