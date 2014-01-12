'use strict';

describe('Controller: TrakCtrl', function () {

  // load the controller's module
  beforeEach(module('channeltrakApp'));

  var TrakCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    TrakCtrl = $controller('TrakCtrl', {
      $scope: scope
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
