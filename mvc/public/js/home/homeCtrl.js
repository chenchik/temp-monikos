//Created by Danila Chenchik Monikos LLC

var app = angular.module('myApp', []);
app.controller('homeCtrl', function($scope, $http) {
    var url = "/db/get_drugs.php";
    $http.get(url)
    .then(function (response) {
        console.log(response);
        $scope.names = response.data.records;
        console.log($scope.names);
    });

    $scope.drugDatabase = function(){
        //create new database controller
        window.location = window.location.origin + "/mvc/public/home/drugDatabase";
    }

    $scope.listManager = function(){
        //create list manager controller
        window.location = window.location.origin + "/mvc/public/home/listManager";
    }
});
