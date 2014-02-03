'use strict';

angular.module('channeltrakApp')
	.controller('PopupCtrl', function ($scope, $rootScope, $location, userService, channelService) {

		var init = function() {
			$scope.searchInstructions = 'Type to search';
			$scope.searchQuery = '';
		}

		// GLOBAL TOGGLES

		$rootScope.shareFacebook = function(trak) {
			var url = 'http://channeltrak.com/trak/'+trak.slug;
			var width  = 575,
	            height = 400,
	            left   = ($(window).width()  - width)  / 2,
	            top    = ($(window).height() - height) / 2,
	            opts   = 'status=1' +
	                     ',width='  + width  +
	                     ',height=' + height +
	                     ',top='    + top    +
	                     ',left='   + left;

			window.open('https://www.facebook.com/sharer/sharer.php?u='+url, 'facebook', opts);
		}

		$rootScope.shareTwitter = function(trak) {

	        var title = trak.title.replace('&', 'and');
	        var url = 'http://channeltrak.com/trak/'+trak.slug;

	        var width  = 575,
	            height = 400,
	            left   = ($(window).width()  - width)  / 2,
	            top    = ($(window).height() - height) / 2,
	            opts   = 'status=1' +
	                     ',width='  + width  +
	                     ',height=' + height +
	                     ',top='    + top    +
	                     ',left='   + left;

			window.open('http://twitter.com/intent/tweet?url='+url+'&text=Check%20out%20%20"'+title+'"%20at&via=channeltrak', 'twitter', opts);
		}

		$rootScope.toggleSearch = function() {
			$rootScope.isSearchOpen = !$rootScope.isSearchOpen;
			if ($rootScope.isSearchOpen) {
				setTimeout(function(){
					$('#search input').focus();
				}, 500);
			}
		}

		$rootScope.toggleSignInModal = function() {
			$scope.isSignInModalVisible = !$scope.isSignInModalVisible;
		}

		$rootScope.toggleJoinModal = function() {
			$scope.isJoinModalVisible = !$scope.isJoinModalVisible;
		}

		$rootScope.closeEverything = function() {
			$scope.isSignInModalVisible = false;
			$scope.isJoinModalVisible = false;
			$rootScope.isSearchOpen = false;
		}

		// LOCAL THINGS

		$scope.changeSearchInstructions = function(query) {
			var query;
			if (query.length > 3) {
				$scope.searchInstructions = 'Press enter to search for "'+query+'"';
			} else {
				$scope.searchInstructions = 'Type to search';
			}
		}

		$scope.searchTraks = function(query) {
			$location.path('/search').search({q: query});
			$rootScope.closeEverything();
		}

		$scope.signIn = function(credentials) {

			userService.authUser(credentials)
				.then(function(callback) {
					console.log(callback);
					$rootScope.User = callback;
					$rootScope.isAuthed = true;
					$rootScope.closeEverything();
				}, function() {
					$scope.error = true;
					$scope.errorMessage = 'Incorrect email or password';
				});

		}

		$scope.join = function(userData) {

			userService.createUser(userData)
				.then(function(user_id) {

					console.log(user_id);
					
					// userService.getUser(user_id)
					// 	.then(function(callback){
					// 		$rootScope.User = callback;
					// 	});

				}, function() {
					$scope.error = true;
					$scope.errorMessage = 'User exists';
				});

		}

		init();

	});
