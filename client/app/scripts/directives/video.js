'use strict';

angular.module('channeltrakApp')
	.directive('video', function () {
		return {
			restrict: 'A',
			controller: function($scope) {
				$scope.loadVideo = function() {
		          		
		        	alert('tolo');	

		        };
			}
		};
	});
