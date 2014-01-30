'use strict';

angular.module('channeltrakApp')
  	.factory('channelService', function ($http, $q) {

		var url = 'http://localhost/channeltrak.com/server/channels';

		var createChannel = function(channelUrl) {
			
			var deferred = $q.defer();

			console.log(channelUrl);

			$http.post(url, channelUrl)
				.success(function(data){
					deferred.resolve(data);
				})
				.error(function(){
					deferred.reject();
				});

			return deferred.promise;

		}

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
			createChannel: createChannel,
			getChannels: getChannels,
			getChannel: getChannel
		};

	});
