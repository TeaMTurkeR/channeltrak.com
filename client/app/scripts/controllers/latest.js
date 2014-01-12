'use strict';

angular.module('channeltrakApp')
	.controller('LatestCtrl', function ($scope, Latest) {

		Latest.get(function(data){
			$scope.Traks = data.traks;
		});

	});
