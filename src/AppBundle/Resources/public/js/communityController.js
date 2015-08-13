/**
 * Created by miguelplazas on 10/08/15.
 */

    var config = angular.module("ComunityApp", ['restangular'],
        function ($interpolateProvider) {
            $interpolateProvider.startSymbol('[[');
            $interpolateProvider.endSymbol(']]')
        });


    config.controller("indexController", function ($scope, Restangular) {
        $scope.title = "Communities";
        $scope.communitiesList = [];
        Restangular.all(getRoute('get_communities')).getList().then(function(communitiesList){
            $scope.communitiesList = communitiesList;
        })
    });

    var app = angular.module('community', ['ComunityApp']);

    app.config(function(RestangularProvider){
        RestangularProvider.setBaseUrl('/api');
        //RestangularProvider.setRequestSuffix('.json');
    });


    /**
     * transform http://localhost:8000//app_dev.php => http://localhost:8000/app_dev.php
     * as Restangular and Routing components add  '/' to baseUrl, we have to remove it
     * @param routeName
     * @returns {string}
     */
    var getRoute = function (routeName) {
        return Routing.generate(routeName, {}, false).slice(1);
    };