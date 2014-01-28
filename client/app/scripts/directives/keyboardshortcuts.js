'use strict';

angular.module('channeltrakApp')
  .directive('keyboardShortcuts', function () {
    return function (scope, elm, attrs) {
            $('body').keydown(function (e) {
                if (e.keyCode == 37) {
                    console.log('left');
                } else if (e.keyCode == 38) {
                	console.log('right');
                }
            });
        }
  });
