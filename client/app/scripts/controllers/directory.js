'use strict';

angular.module('channeltrakApp')
	.controller('DirectoryCtrl', function ($scope, Directory) {

	    Directory.get(function(data){
			$scope.Channels = data.channels;
		});
		
  	});
