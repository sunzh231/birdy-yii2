'use strict';

/* User Controller */
app.controller('UserCtrl', ['$scope','dialogs','$resource', function($scope, $dialogs, $resource) {
  var aoColumns = [];
  $('#target_table').find('th').each(function(index, elem) {
    if($(elem).attr('field')) {
      aoColumns.push({
        mData: $(elem).attr('field')
      })
    }
  });
  aoColumns.push({
    // visible: false,
    data: null,
    'mRender': function(data, type, full) {
      return '<input type="checkbox" class="chk" name=ids value='+data+'>';
    }
    // defaultContent: '<div class="btn-group dropdown">'+
    //     '<button class="btn btn-success" data-toggle="dropdown">操作<span class="caret"></span></button>'+
    //     '<ul class="dropdown-menu">'+
    //       '<li><a href>查看</a></li>'+
    //       '<li><a href>编辑</a></li>'+
    //       '<li><a href>删除</a></li>'+
    //       '<li class="divider"></li>'+
    //       '<li><a href>更多</a></li>'+
    //     '</ul>'+
    //   '</div>'
  });
  $scope.table_options = {
    data: resp.items,
    serverSide: true,
    aoColumns: aoColumns,
    serverSide: true
    stateSave: false
    fnServerData: function( sUrl, aoData, fnCallback, oSettings ) {
      oSettings.jqXHR = $.ajax({
      "url": sUrl,
      beforeSend: function(xhr) {
        xhr.withCredentials = true;
      },
      "data": aoData,
      "type": 'get',
      "success": fnCallback,
      "cache": false
    });
  }
  var resource = $resource('/api/channel/index?access-token=123456');
  resource.get({},function(resp) {
    console.log(resp);

  });

  $scope.launch = function(which){
    var dlg = $dialogs.create('/src/tpl/modules/channels/dialog.html','DialogCtrl',{},{key: false,back: 'static'});
    dlg.result.then(function(name){
      $scope.name = name;
    },function(){
      $scope.name = 'You decided not to enter in your name, that makes me sad.';
    });
  };
}]);

/* Dialog Controller */
app.controller('DialogCtrl', ['$scope', function($scope, $modalInstance, data) {
  $scope.user = {name : ''};

  $scope.cancel = function(){
    $modalInstance.dismiss('canceled');
  }; // end cancel

  $scope.save = function(){
    $modalInstance.close($scope.user.name);
  }; // end save

  $scope.hitEnter = function(evt){
    if(angular.equals(evt.keyCode,13) && !(angular.equals($scope.name,null) || angular.equals($scope.name,'')))
        $scope.save();
  }; // end hitEnter
}]);
