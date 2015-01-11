/**
 * Created by kaso on 1/11/2015.
 */

var app = angular.module('app.users.controller', []);

app.controller('UserListingController', ['$scope', 'users', '$rootScope', function ($scope, users, $rootScope) {
    $rootScope.count.users = users.data.length;
    $scope.users = users.data;
    console.log(users.data);
}]);