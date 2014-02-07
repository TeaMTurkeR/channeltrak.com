'use strict';

angular.module('channeltrakApp')
  	.factory('urlService', function () {

  		var rootUrl = function() {

  			// LOCAL 
  			// return 'http://localhost:8000/channeltrak.com/server/';

  			// DEV
  			return 'http://dev.channeltrak.com/server/';

  			// PRODUCTION
  			// return 'http://channeltrak.com/server/';

  		}
  		
		// Public API

		return {
			rootUrl: rootUrl
		};

	});
