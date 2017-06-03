'use strict';

var dlg = null;
/* User Controller */
app.controller('IndexCtrl', ['$scope', 'dialogs', '$resource', function($scope, $dialogs, $resource) {
  $scope.table_render = function(current_page) {
    var url = '/api/bases/role/index?page='+ current_page +'&access-token=123456';
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

  $scope.launch = function(which){
    dlg = $dialogs.create('/tpl/modules/roles/form.html','DialogCtrl',{},{key: false,back: 'static'});
    dlg.result.then(function(name){
      $scope.table_render(1);
    },function(){
      console.log('modal closed!');
    });
  };
}]);

/* Dialog Controller */
app.controller('DialogCtrl', ['$scope', '$resource', function($scope, $resource) {
  $scope.cancel = function() {
    dlg.dismiss('Canceled');
  }

  $scope.save = function(){
    var url = '/api/bases/role/create?access-token=123456';
    var resource = $resource(url);
    resource.save($scope.target, function(resp) {
      dlg.close();
    });
  };
}]);
