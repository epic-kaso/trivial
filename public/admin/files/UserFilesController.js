/**
 * Created by kaso on 1/11/2015.
 */

var app = angular.module('app.files.controller', []);

app.controller('UserFileListingController', ['$scope', 'user_files', '$rootScope', function ($scope, user_files, $rootScope) {
    $rootScope.count.files = user_files.data.length;
    $scope.files = user_files.data;
    console.log(user_files.data);
}]);