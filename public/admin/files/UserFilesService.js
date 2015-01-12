/**
 * Created by kaso on 1/11/2015.
 */
var app = angular.module('app.files.service', []);

app.factory('UserFileService', function ($q, $http, UserFileUrlRoot) {
    return {
        'fetchAll': function () {
            return $http.get(UserFileUrlRoot);
        }
    }
});