'use strict';

var dlg = null;
/* User Controller */
app.controller('DetailCtrl', ['$scope', '$stateParams', '$resource', function($scope, $stateParams, $resource) {
  var url = '/api/channel/view/:channel_id?access-token=123456';
  var resource = $resource(url, {channel_id: '@id'});
  resource.get({channel_id: $stateParams.id}, function(resp) {
    $scope.channel = resp;
  });
  $scope.menu = {};
  $scope.menu_types = [
    { name: '点击推事件', type: 'click', content: 12 },
    { name: '跳转URL', type: 'view', content: 12 },
    { name: '扫码推事件', type: 'scancode_push', content: 21 },
    { name: '扫码推事件且弹出“消息接收中”', type: 'scancode_waitmsg', content: 21 },
    { name: '弹出系统拍照', type: 'pic_sysphoto', content: 30 },
    { name: '弹出拍照或者相册', type: 'pic_photo_or_album', content: 30 },
    { name: '弹出微信相册发图器', type: 'pic_weixin', content: 43 },
    { name: '弹出地理位置选择器', type: 'location_select', content: 54 },
    { name: '下发消息', type: 'media_id', content: 15 },
    { name: '跳转图文消息URL', type: 'view_limited', content: 43 }
  ];
  $scope.wechatMenus = []
  $scope.addMenu = function (index) {
    if (index !== undefined) {
      $scope.wechatMenus[index].sub_button.push({
        name: 'test',
        type: { name: '跳转图文消息URL', type: 'view_limited', content: 43 },
        key: '123',
        media_id: '',
        url: ''
      })
    } else {
      $scope.wechatMenus.push({
        name: 'test',
        type: 'click',
        key: '123',
        media_id: '',
        url: '',
        sub_button: []
      })
    }

  }
  $scope.setMenu = function (parentIndex, index, $event) {
    $event.stopPropagation();
    if (parentIndex === -1) {
      $scope.menu = $scope.wechatMenus[index]
    } else {
      $scope.menu = $scope.wechatMenus[parentIndex].sub_button[index]
    }
  }

  $scope.menuActive = function () {
    var url = '/api/channel/menu?access-token=123456';
    var resource = $resource(url);
    var result = {
      id: $stateParams.id,
      data: {
        button: $scope.wechatMenus
      }
    }
    resource.save(result, function(resp) {
      console.log(resp)
    });
  }

  // Fans List
  $scope.table_render = function(current_page) {
    var url = '/api/fans/index?page='+ current_page +'&access-token=123456';
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

app.controller('MeterialCtrl', ['$scope', 'dialogs', '$resource', function($scope, $dialogs, $resource) {
  $scope.table_render = function(current_page) {
    var url = '/api/channel/index?page='+ current_page +'&access-token=123456';
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
    dlg = $dialogs.create('/tpl/modules/channels/meterial_dialog.html','DialogCtrl',{},{key: false,back: 'static'});
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
    var url = '/api/channel/create?access-token=123456';
    var resource = $resource(url);
    resource.save($scope.channel, function(resp) {
      dlg.close();
    });
  };

  $scope.htmlVariable = '<h3>Try me!</h3><p>textAngular is a super cool WYSIWYG Text Editor directive for AngularJS</p><p><b>Features:</b></p><ol><li>Automatic Seamless Two-Way-Binding</li><li style="color: blue;">Super Easy <b>Theming</b> Options</li><li>Simple Editor Instance Creation</li><li>Safely Parses Html for Custom Toolbar Icons</li><li>Doesn&apos;t Use an iFrame</li><li>Works with Firefox, Chrome, and IE8+</li></ol><p><b>Code at GitHub:</b> <a href="https://github.com/fraywing/textAngular">Here</a> </p>';
}]);
