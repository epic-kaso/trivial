/**
 * Created by kaso on 1/9/2015.
 */

var app = angular.module('AdminApp', [
    'ui.router',
    'ui.bootstrap',
    'app.users'
], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

//app.constant('ViewsBaseURL','/Assets/app/views');


app.constant('UserUrlRoot', window.application.user_base_url);

app.config(function ($stateProvider, $urlRouterProvider, ViewBaseURL) {

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

    $stateProvider
        .state(users);
});
