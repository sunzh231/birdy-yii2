'use strict';

/* User Controller */
app.controller('IndexCtrl', ['$scope', '$resource', function($scope, $resource) {
  $scope.table_render = function(current_page) {
    var url = '/api/user/index?page='+ current_page +'&access-token=123456';
    var resource = $resource(url);
    resource.get({},function(resp) {
      $scope.result = resp;
      $scope.pagination = resp['_meta'];
      $scope.turnPage = $scope.pagination.currentPage;
    });
  }

  $scope.setPage = function (pageNo) {
    $scope.table_render(pageNo);
  };

  $scope.pageChanged = function() {
    $scope.table_render($scope.pagination.currentPage);
  };
  
  $scope.table_render(1);
}]);
