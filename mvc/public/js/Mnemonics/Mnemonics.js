var app = angular.module('myApp', ['ngAnimate']);

app.directive('modalDialog', function() {
    return {
        restrict: 'E',
        scope: {
            show: '='
        },
        replace: true, // Replace with the template below
        transclude: true, // we want to insert custom content inside the directive
        link: function(scope, element, attrs) {
            scope.dialogStyle = {};
            if (attrs.width)
                scope.dialogStyle.width = attrs.width;
            if (attrs.height)
                scope.dialogStyle.height = attrs.height;
            scope.hideModal = function() {
                scope.show = false;
            };
        },
        template: "<div class='ng-modal' ng-show='show'><div class='ng-modal-overlay' ng-click='hideModal()'></div><div class='ng-modal-dialog' ng-style='dialogStyle'><div class='ng-modal-close' ng-click='hideModal()'>X</div><div class='ng-modal-dialog-content' ng-transclude></div></div></div>"
    };
});

app.controller('showCtrl', ['$scope', function($scope) {
    $scope.modalShown = false;
    $scope.toggleModal = function() {
        $scope.modalShown = !$scope.modalShown;
    };
}]);



app.controller('customersCtrl', function($scope, $http) {
    $scope.queryBy = '$';
    $scope.modalShown = false;
    $scope.toggleModal = function() {
        $scope.modalShown = !$scope.modalShown;
    };


    //var url = "http://testmonikos.us-east-1.elasticbeanstalk.com/sql_result.php"
    //var url = "http://danilachenchik.com/sql_result.php";
    //var url = "http://monikos.xpyapvzutk.us-east-1.elasticbeanstalk.com/sql_result.php";
    var url = "/db/get_drugs.php"
    $http.get(url)
        .then(function (response) {
        console.log(response);
        //console.log(response);
        $scope.names = response.data.records;
        console.log($scope.names);
        //alert($scope.names);
    });

    $scope.home = function(){
        //create new database controller
        window.location = window.location.origin + "/mvc/public/home/";
    }

    $scope.showInfo = function() {
        //show drug content in database
        $
    }


});
