'use strict';

/* Controllers */
  // signin controller
app.controller('SigninController', ['$scope', '$resource', '$state', function($scope, $resource, $state) {
    $scope.user = {};
    $scope.login = function() {
      var url = 'api/site/signin';
      var resource = $resource(url);
      resource.save($scope.user, function(resp) {
        if (resp.code === 0) {
          $state.go('app.index', {target: 'channels'});
        }
      }, function(resp) {
        console.log(resp);
      });
    };
  }])
;
