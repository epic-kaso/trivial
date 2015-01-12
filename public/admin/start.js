/**
 * Created by kaso on 1/9/2015.
 */

var app = angular.module('AdminApp', [
    'ui.router',
    'ui.bootstrap',
    'app.users',
    'app.files'
], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

app.run(function ($rootScope) {
    $rootScope.count = {
        'users': 0,
        'files': 0,
        'storages': 0
    }
});
//app.constant('ViewsBaseURL','/Assets/app/views');


app.constant('UserUrlRoot', window.application.user_base_url);
app.constant('UserFileUrlRoot', window.application.user_files_base_url);

app.config(function ($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.otherwise("/users");

    var users = {
        name: 'users',
        url: "/users",
        templateUrl: "usersTable.html",
        controller: "UserListingController",
        resolve: {
            'users': function (UserService) {
                return UserService.fetchAll();
            }
        }
    };

    var files = {
        name: 'files',
        url: "/files",
        templateUrl: "userFilesTable.html",
        controller: "UserListingController",
        resolve: {
            'user_files': function (UserFileService) {
                return UserFileService.fetchAll();
            }
        }
    };

    var storages = {
        name: 'storages',
        url: "/storages",
        templateUrl: "usersTable.html",
        controller: "UserListingController",
        resolve: {
            'users': function (UserService) {
                return UserService.fetchAll();
            }
        }
    };

    var analytics = {
        name: 'analytics',
        url: "/analytics",
        templateUrl: "usersTable.html",
        controller: "UserListingController",
        resolve: {
            'users': function (UserService) {
                return UserService.fetchAll();
            }
        }
    };

    $stateProvider
        .state(users)
        .state(files)
        .state(analytics)
        .state(storages);
});
