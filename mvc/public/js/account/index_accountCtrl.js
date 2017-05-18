//Created by Danila Chenchik Monikos LLC

var app = angular.module('myApp', []);
app.controller('accountCtrl', function($scope, $http) {
    $scope.createAccount = function(){
        var un = document.getElementById('un').value;
        var email = document.getElementById('email').value;
        var pw = document.getElementById('pw').value;

        var url = "http://monikos.xpyapvzutk.us-east-1.elasticbeanstalk.com/create_account.php";

        var data = $.param({
            username: un,
            password: pw,
            email: email
        });
        var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            };
        $http.post(url, data, config)
        .then(function (response) {
            console.log(response);
            $scope.response = response;
        });
    }
});
