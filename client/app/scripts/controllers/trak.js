'use strict';

angular.module('channeltrakApp')
  	.controller('TrakCtrl', function ($scope, Trak) {
		
		Trak.get(function(data){
			$scope.Traks = data.songs;
		});

  	});
