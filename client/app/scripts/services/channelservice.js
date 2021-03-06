'use strict';

angular.module('channeltrakApp')
  	.factory('channelService', function ($http, $q, $location, $templateCache, urlService) {

		var root = urlService.rootUrl();
  		var url = root+'channels';

		var createChannel = function(channelUrl) {
			
			var deferred = $q.defer();

			var channelData = { 'channel_url': channelUrl }

			$http({
				method: 'POST',
				url: url,
				data: channelData,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				cache: $templateCache
			})
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
