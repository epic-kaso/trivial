/**
 * Created by kaso on 1/11/2015.
 */

var app = angular.module('app.users.controller', []);

app.controller('UserListingController', ['$scope', function ($scope, users) {
    $scope.users = users;
}]);