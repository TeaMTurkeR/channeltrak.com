'use strict';

angular.module('channeltrakApp')
  	.controller('PopularCtrl', function ($scope, Popular) {

  		$scope.toggleDirection = function() {
  			$scope.direction = !$scope.direction;
  		}

		Popular.get(function(data){
			$scope.Traks = data.traks;
		});

  	});
