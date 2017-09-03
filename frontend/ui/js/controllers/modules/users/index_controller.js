'use strict';

var dlg = null;
/* User Controller */
app.controller('IndexCtrl', ['$scope', 'dialogs', '$resource', 'toaster', function($scope, $dialogs, $resource, toaster) {
  $scope.table_render = function(current_page) {
    var url = '/api/bases/user/index';
    var resource = $resource(url, {page: current_page});
    resource.query($scope.query, function(resp) {
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

  $scope.launch = function(id){
    dlg = $dialogs.create('/tpl/modules/users/form.html','DialogCtrl',{id: id},{key: false,back: 'static'});
    dlg.result.then(function(name){
      $scope.table_render(1);
    },function(){
      console.log('modal closed!');
    });
  };

  $scope.del = function(id) {
    $dialogs.confirm('删除操作确认','确定要删除本条记录吗？').result.then(function(btn){
      var url = '/api/bases/user/delete/:id';
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
}]);

app.filter('propsFilter', function() {
  return function(items, props) {
    var out = [];
    if (angular.isArray(items)) {
      items.forEach(function(item) {
        var itemMatches = false;
        var keys = Object.keys(props);
        for (var i = 0; i < keys.length; i++) {
          var prop = keys[i];
          var text = props[prop].toLowerCase();
          if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
            itemMatches = true;
            break;
          }
        }
        if (itemMatches) {
          out.push(item);
        }
      });
    } else {
      // Let the output be the input untouched
      out = items;
    }
    return out;
  };
});

/* Dialog Controller */
app.controller('DialogCtrl', ['$scope', '$resource', 'data', 'toaster', function($scope, $resource, data, toaster) {
  $scope.multipleDemo = {}
  $scope.multipleDemo.selectedRolesWithGroupBy = [];
  $scope.table_render = function(current_page) {
    var url = '/api/bases/role/index';
    var resource = $resource(url, {page: current_page});
    resource.query($scope.query,function(resp) {
      $scope.roles = resp.items;
      if (data.id != 0) {
        var url = '/api/bases/user/view/:id';
        var resource = $resource(url, { id: '@id' });
        resource.get({ id: data.id }, function(resp) {
          $scope.target = resp.user;
          var target_roles = [];
          angular.forEach($scope.roles, function(origin_value, origin_key) {
            angular.forEach(resp.roles, function(target_value, target_key) {
              if (angular.equals(origin_value, target_value)) {
                target_roles.push(origin_value);
              }
            });
          });
          $scope.multipleDemo.selectedRolesWithGroupBy = target_roles;
        });
      }
    });
  }
  $scope.table_render(1);

  $scope.cancel = function() {
    dlg.dismiss('Canceled');
  }

  $scope.save = function(){
    $scope.target['roles'] = $scope.multipleDemo.selectedRolesWithGroupBy;
    if ($scope.target.id) {
      var url = '/api/bases/user/update/:id';
      var resource = $resource(url, { id: '@id' }, {
        'update': { method:'PUT' }
      });
      resource.update({ id: $scope.target.id }, $scope.target, function(resp) {
        toaster.pop('success', '操作成功', '角色更新成功');
        dlg.close();
      });
    } else {
      var url = '/api/bases/user/create';
      var resource = $resource(url);
      resource.save($scope.target, function(resp) {
        toaster.pop('success', '操作成功', '角色创建成功');
        dlg.close();
      });
    }
  };
}]);
