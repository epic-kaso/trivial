/**
 * Created by kaso on 1/11/2015.
 */
var app = angular.module('app.users.service', []);

app.factory('UserService', function ($q, $http, UserUrlRoot) {
    return {
        'fetchAll': function () {
            return $http.get(UserUrlRoot);
        }
    }
});