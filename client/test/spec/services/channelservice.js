'use strict';

describe('Service: Channelservice', function () {

  // load the service's module
  beforeEach(module('channeltrakApp'));

  // instantiate service
  var Channelservice;
  beforeEach(inject(function (_Channelservice_) {
    Channelservice = _Channelservice_;
  }));

  it('should do something', function () {
    expect(!!Channelservice).toBe(true);
  });

});
