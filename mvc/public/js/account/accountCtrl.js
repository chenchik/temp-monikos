//Created by Danila Chenchik Monikos LLC

var app = angular.module('myApp', []);
app.controller('accountCtrl', function($scope, $http) {

    var url2 = "/db/get_schools.php";
    $http.get(url2).then(function (response) {
        console.log('ww');
        console.log(response);
        $scope.schoolnames = response.data.records;
        console.log($scope.schoolnames);
    });

    $scope.closeError = function(){

    }

    function showError(str){
        $('#errorMessage').slideDown('fast');
        $('.errorText').html(str);
    }

    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    function checkEmail(email) {

      if (!validateEmail(email)) {
        showError("The email you enetered is not valid");
        return false;
      }
      return true;
    }



    function lengthChecker(str, field){
        if(str.length > 2) {
            return true;
        }else{
            showError("Please enter a " + field + " greater than 2 characters long.");
            return false;
        }
    }

    function checkAplhaNumeric(str, field){
        var Exp = /^([0-9]|[a-z])+([0-9a-z]+)$/i;

        if(!str.match(Exp)){
            showError("Please only use numbers or letters in the " + field + " field.");
            return false;
        }else{
            return true;
        }
    }

    function fieldChecker( str, field){

        if(!lengthChecker(str, field)){
            return false;
        }else if(!checkAplhaNumeric(str, field)){
            return false;
        }else if($('#school').val() == null){
            showError("Please select a school.");
            return false;
        }
        return true;
    }

    $scope.checkUsername = function(){

        var un = document.getElementById('un').value;
        if(!fieldChecker(un, 'username')){
            return false;
        }
        var email = document.getElementById('email').value;
        var pw = document.getElementById('pw').value;
        if(!fieldChecker(pw, 'password')){
            return false;
        }
        var url = "/db/check_username.php";

        var data = $.param({
            username: un,
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
            if(response.data.records[0].user){
                showError("That username is already taken.");
            }else if(!response.data.records[0].email){
                showError("Please enter a valid email.");
            }else{
                $scope.createAccount();
            }
        });




    }

    $scope.createAccount = function(){
        var un = document.getElementById('un').value;
        var email = document.getElementById('email').value;
        var pw = document.getElementById('pw').value;
        var schoolid = document.getElementById('school').value;
        var tempname = "a" + schoolid;
        var schoolname = document.getElementById(tempname).innerHTML;


        var url = "/db/create_account.php";

        var data = $.param({
            username: un,
            password: pw,
            email: email,
            schoolid: schoolid,
            schoolname: schoolname
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
            if(response.data[0].response == 200){
                window.location = window.location.origin + "/mvc/public/account/login";
            }else{
                alert("error in creating account");
            }
        });
    }
    $scope.login = function(){
        window.location = window.location.origin + "/mvc/public/account/login";
    }
});

$( document ).ready(function() {
    $('#errorBtn').on('click', function(){
        $('#errorMessage').slideUp('fast');
    });
});
