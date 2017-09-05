'use strict';

var dlg = null;
/* User Controller */
app.controller('RoleIndexCtrl', ['$scope', 'dialogs', '$resource', 'toaster', '$uibModal', '$log',
  function($scope, $dialogs, $resource, toaster, $uibModal, $log,) {
    $scope.table_render = function(current_page) {
      var url = '/api/bases/role/index';
      var resource = $resource(url, {page: current_page});
      resource.query($scope.query,function(resp) {
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

    $scope.launch = function(data){
      var modalInstance = $uibModal.open({
        templateUrl: 'myModalContent.html',
        controller: 'ModalInstanceCtrl',
        resolve: {
          data: function () {
            return data;
          }
        }
      });

      modalInstance.result.then(function (data) {
        $scope.table_render(1);
      }, function () {
        $log.info('Modal dismissed at: ' + new Date());
      });
    };

    $scope.del = function(id) {
      $dialogs.confirm('删除操作确认','确定要删除本条记录吗？').result.then(function(btn){
        var url = '/api/bases/role/delete/:id';
        var resource = $resource(url, { id: '@id' });
        resource.delete({ id: id }, function(resp) {
          toaster.pop('success', '操作成功', '角色成功删除');
          $scope.result = resp;
          $scope.pagination = resp['_meta'];
          $scope.turnPage = $scope.pagination.currentPage;
        });
      },function(btn){

      });
    };
  }
]);

app.controller('ModalInstanceCtrl', ['$scope', '$resource', 'toaster', '$uibModalInstance','data', function ($scope, $resource, toaster, $uibModalInstance, data) {
  if (data && data != 0) {
    var url = '/api/bases/role/view/:id';
    var resource = $resource(url, { id: '@id' });
    resource.get({ id: data }, function(resp) {
      $scope.target = resp;
    });
  }

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };

  $scope.save = function(){
    if ($scope.target.id) {
      var url = '/api/bases/role/update/:id';
      var resource = $resource(url, { id: '@id' }, {
        'update': { method:'PUT' }
      });
      resource.update({ id: $scope.target.id }, $scope.target, function(resp) {
        toaster.pop('success', '操作成功', '角色更新成功');
        $uibModalInstance.close();
      });
    } else {
      var url = '/api/bases/role/create';
      var resource = $resource(url);
      resource.save($scope.target, function(resp) {
        toaster.pop('success', '操作成功', '角色创建成功');
        $uibModalInstance.close();
      });
    }
  };
}]);
