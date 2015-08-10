/**
 * Created by miguelplazas on 10/08/15.
 */
(function () {

    angular.module('communities',['restangular']).controller('communityIndexController',function($scope, Restangular){
        $scope.pageTitle     = "Communities List";
        $scope.cocktailsList = Restangular.all(getRoute('get_communities')).getList();
    });

    var app = angular.module('demoApp', ['cocktails']);

    app.config(function(RestangularProvider) {
        RestangularProvider.setBaseUrl('http://localhost:8000'); //wOOt, ugly ...but that's a demo ;)
        RestangularProvider.setRequestSuffix('.json');
    });
    /**
     * transform http://localhost:8000//app_dev.php => http://localhost:8000/app_dev.php
     * as Restangular and Routing components add  '/' to baseUrl, we have to remove it
     * @param routeName
     * @returns {string}
     */
    var getRoute = function(routeName){
        return Routing.generate(routeName,{},false).slice(1);
    }

})();