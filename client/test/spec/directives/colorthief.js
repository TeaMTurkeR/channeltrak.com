'use strict';

describe('Directive: colorThief', function () {

  // load the directive's module
  beforeEach(module('channeltrakApp'));

  var element,
    scope;

  beforeEach(inject(function ($rootScope) {
    scope = $rootScope.$new();
  }));

  it('should make hidden element visible', inject(function ($compile) {
    element = angular.element('<color-thief></color-thief>');
    element = $compile(element)(scope);
    expect(element.text()).toBe('this is the colorThief directive');
  }));
});
