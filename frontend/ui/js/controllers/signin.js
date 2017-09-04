'use strict';

function setCookie(c_name, value, expiredays) {
  var exdate=new Date()
  exdate.setDate(exdate.getDate()+expiredays)
  document.cookie=c_name+ "=" +escape(value)+
  ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
}

/* Controllers */
  // signin controller
app.controller('SigninController', ['$scope', '$resource', '$state', 'toaster', function($scope, $resource, $state, toaster) {
  var code = "";
  $scope.createCode = function() {
    code = "";
    var codeLength = 4;//验证码的长度
    var checkCode = document.getElementById("code");
    var random = new Array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R',
      'S','T','U','V','W','X','Y','Z');//随机数
    for(var i = 0; i < codeLength; i++) {//循环操作
        var index = Math.floor(Math.random()*36);//取得随机数的索引（0~35）
        code += random[index];//根据索引取得随机数加到code上
    }
    checkCode.value = code;//把code值赋给验证码
  }
  $scope.createCode();

  $scope.validate = function() {
    var inputCode = document.getElementById("input").value.toUpperCase(); //取得输入的验证码并转化为大写
    if(inputCode.length <= 0) {
      alert("请输入验证码！");
    } else if(inputCode != code ) {
      $scope.createCode();//刷新验证码
      document.getElementById("input").value = "";
      return false;
    } else {
      return true;
    }
  }
  $scope.user = {};
  $scope.login = function() {
    if ($scope.validate()) {
      var url = 'api/site/signin';
      var resource = $resource(url);
      resource.save($scope.user, function(resp) {
        if (resp.success) {
          setCookie('birdy_token', resp.token, 2);
          $state.go('app.index', {target: 'users'});
        }
      }, function(resp) {
        toaster.pop({type: 'error', title: '用户名或密码错误'});
      });
    }
  };
}]);
