'use strict';

var dlg = null;
/* User Controller */
app.controller('DetailCtrl', ['$scope', 'dialogs', '$resource', function($scope, $dialogs, $resource) {
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
}]);


app.controller('TabsDemoCtrl', ['$scope', function($scope) {
  $scope.tabs = [
    { title:'Dynamic Title 1', content:'Dynamic content 1' },
    { title:'Dynamic Title 2', content:'Dynamic content 2', disabled: true }
  ];
}]);
