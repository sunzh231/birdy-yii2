'use strict';

var dlg = null;
/* User Controller */
app.controller('IndexCtrl', ['$scope', 'dialogs', '$resource', function($scope, $dialogs, $resource) {
  $scope.table_render = function(current_page) {
    var url = '/api/bases/user/index?page='+ current_page +'&access-token=123456';
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
    dlg = $dialogs.create('/tpl/modules/users/form.html','DialogCtrl',{},{key: false,back: 'static'});
    dlg.result.then(function(name){
      $scope.table_render(1);
    },function(){
      console.log('modal closed!');
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
app.controller('DialogCtrl', ['$scope', '$resource', function($scope, $resource) {
  $scope.table_render = function(current_page) {
    var url = '/api/bases/role/index?page='+ current_page +'&access-token=123456';
    var resource = $resource(url);
    resource.get({},function(resp) {
      $scope.roles = resp.items;
    });
  }

  $scope.table_render(1);

  $scope.cancel = function() {
    dlg.dismiss('Canceled');
  }

  $scope.save = function(){
    var url = '/api/bases/user/create?access-token=123456';
    var resource = $resource(url);
    $scope.target['roles'] = $scope.multipleDemo.selectedRolesWithGroupBy;
    resource.save($scope.target, function(resp) {
      dlg.close();
    });
  };
  $scope.multipleDemo = {}
  $scope.multipleDemo.selectedRolesWithGroupBy = [];
}]);
