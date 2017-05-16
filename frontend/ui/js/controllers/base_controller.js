'use strict';

/* User Controller */
app.controller('BaseCtrl', ['$scope', 'toaster', '$resource', function($scope, toaster, $resource) {
    $scope.toaster = {
        type: 'success',
        title: 'Title',
        text: 'Message'
    };
    $scope.pop = function(){
        toaster.pop($scope.toaster.type, $scope.toaster.title, $scope.toaster.text);
    };
}]);
