/**
 * Created by kaso on 1/9/2015.
 */

var app = angular.module('AdminApp', [
    'ui.router',
    'ui.bootstrap'
], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

