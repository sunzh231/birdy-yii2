'use strict';

/* Controllers */
  // signin controller
app.controller('SigninController', ['$scope', '$resource', '$state', function($scope, $resource, $state) {
    $scope.user = {};
    $scope.login = function() {
      var url = 'api/site/signin';
      var resource = $resource(url);
      resource.save($scope.user, function(resp) {
        console.log(resp);
      }, function(resp) {
        console.log(resp);
      });
    };
  }])
;
