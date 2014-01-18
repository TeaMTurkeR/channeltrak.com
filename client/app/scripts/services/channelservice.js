'use strict';

angular.module('channeltrakApp')
  	.factory('channelService', function ($http, $q) {

		var url = 'http://localhost/channeltrak.com/server/channels';

		var getChannels = function(){

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

		var getChannel = function(channelSlug){

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

		// Public API

		return {
			getChannels: getChannels,
			getChannel: getChannel
		};

	});
