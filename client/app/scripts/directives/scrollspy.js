'use strict';

angular.module('channeltrakApp')
  	.directive('scrollSpy', function ($window) {
    	return {
    		restrict: 'A',
    		link: function(scope, element, attrs) {
		        angular.element($window).bind('scroll', function() {
		            console.log(this.pageYOffset);
		            scope.$apply();
		        });
    		}
    	};
  	});
