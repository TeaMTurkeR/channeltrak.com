'use strict';

angular.module('channeltrakApp')
	.controller('ChannelCtrl', function ($scope, $routeParams, Channel) {

		Channel.get($routeParams.slug, function(data){
			$scope.Traks = data.traks;
		});

	});
