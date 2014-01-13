'use strict';

describe('Service: Trakservice', function () {

  // load the service's module
  beforeEach(module('channeltrakApp'));

  // instantiate service
  var Trakservice;
  beforeEach(inject(function (_Trakservice_) {
    Trakservice = _Trakservice_;
  }));

  it('should do something', function () {
    expect(!!Trakservice).toBe(true);
  });

});
