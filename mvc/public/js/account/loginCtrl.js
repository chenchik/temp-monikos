//Created by Danila Chenchik Monikos LLC

var app = angular.module('loginApp', []);
app.controller('loginCtrl', function($scope, $http, $location) {
    $scope.login = function(){
        var online = navigator.onLine;
        if(online){
            handleOnlineLogin();
        }else{
            handleOfflineLogin();
        }
    }
    $scope.create = function(){
        //create new database controller
        window.location = window.location.origin + "/mvc/public/account/create";

    }

    function handleOnlineLogin(){
        var un = document.getElementById('un').value;
        var pw = document.getElementById('pw').value;

        var url = "/db/do_login.php";

        var data = $.param({
            username: un,
            password: pw,
        });
        var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
        };
        $scope.loading = true;

        $http.post(url, data, config)
        .then(
            function (response) {
                //success
                handleLoginResponse(response);
            },function(response){
                // failure
                handleLoginFailure(response);
        });
    }

    function showError(str){
        
        $('#errorMessage').slideDown('fast');
        $('.errorText').html(str);
        $scope.loading = false;
    }

    function handleLoginResponse(response){
        console.log(response);
        $scope.response = response;
        if(response.data[0].response == 200){
            window.location = window.location.origin + "/mvc/public/home";
            if(document.cookie.indexOf("user_id") < 0){
                document.cookie = "user_id="+response.data[0].user_id+"; expires="+(Date.now()+(86400 * 30))+"; path=/";
            }

            if(document.cookie.indexOf("username") < 0){
                document.cookie = "username="+response.data[0].username+"; expires="+(Date.now()+(86400 * 30))+"; path=/";
            }
            $scope.loading = false;
        }else{
            showError('Incorrect username or password.');  
        }
        
    }

    function handleLoginFailure(response){
        console.log(response);
        $scope.loading = false;
    }

    function handleOfflineLogin(){
        window.location = window.location.origin + "/mvc/public/home/drugDatabase";
    }
});

$( document ).ready(function() {
    $('#errorBtn').on('click', function(){
        $('#errorMessage').slideUp('fast');
    });

});

