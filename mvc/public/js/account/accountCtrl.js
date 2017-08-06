//Created by Danila Chenchik, Joseph Son Monikos LLC

var app = angular.module('myApp', ['ui.select', 'ngSanitize']);

app.controller('accountCtrl', function ($scope, $http) {
    var url7 = "/db/get_programs.php";
    $http.get(url7).then(function (response) {
        console.log('ww');
        console.log(response);
        $scope.programs = response.data.records;
        for (var i = 0; i < 6; i++) {
            switch ($scope.programs[i].program) {
                case "do":
                    $scope.programs[i].program = "D.O";
                    $scope.programs[i].programId = i;
                    break;
                case "nursing":
                    $scope.programs[i].program = "Nursing";
                    $scope.programs[i].programId = i;
                    break;
                case "pharmacy":
                    $scope.programs[i].program = "Pharmacy";
                    $scope.programs[i].programId = i;
                    break;
                case "med":
                    $scope.programs[i].program = "Medicine";
                    $scope.programs[i].programId = i;
                    break;
                case "pa":
                    $scope.programs[i].program = "PA";
                    $scope.programs[i].programId = i;
                    break;
                case "dental":
                    $scope.programs[i].program = "Dental";
                    $scope.programs[i].programId = i;
                    break;
            }
        }
        $scope.selectedProgram = $scope.programs[0];
        console.log($scope.programs);
    })
    $scope.closeError = function () {

    }

    $scope.findSchool = function () {
        var pro = $('#program').text();
        var url;

        if (pro == "Nursing") {
            var url = "/db/get_nursing_schools.php";
        } else if (pro == "Pharmacy") {
            var url = "/db/get_pharm_schools.php";
        } else if (pro == "Medicine") {
            var url = "/db/get_med_schools.php";
        } else if (pro == "PA") {
            var url = "/db/get_pa_schools.php";
        } else if (pro == "D.O") {
            var url = "/db/get_do_schools.php";
        } else if (pro = "Dental") {
            var url = "/db/get_dental_schools.php";
        }
        $http.get(url).then(function (response) {
            console.log('ww');
            console.log(response);
            $scope.schoolnames = response.data.records;
            $scope.selectedSchool = $scope.schoolnames[0];

            console.log($scope.schoolnames);
        });
    }
    
    $scope.findYear = function () {
        var arr = [];
        var year = 2017;
        for(i=0;i<20;i++){
            arr[i] = year;
            year++;
        }
        $scope.years = arr;
    }

    $scope.test = function () {
        var schoolid = document.getElementById('schoolid').innerHTML;
        alert(schoolid);
    }

    function showError(str) {
        $('#errorMessage').show();
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



    function lengthChecker(str, field) {
        if (str.length > 2) {
            return true;
        } else {
            showError("Please enter a " + field + " greater than 2 characters long.");
            return false;
        }
    }


    function passwordSameChecker(str, str2) {
        if (str === str2) {
            return true;
        } else {
            showError("Please enter the same password.")
            return false;
        }
    }

    function validateSchool(str) {
        if (str != null) {
            return true;
        } else {
            showError("Please select a school.")
            return false;
        }
    }

    function checkAplhaNumeric(str, field) {
        var Exp = /^([0-9]|[a-z])+([0-9a-z]+)$/i;

        if (!str.match(Exp)) {
            showError("Please only use numbers or letters in the " + field + " field.");
            return false;
        } else {
            return true;
        }
    }

    function fieldChecker(str, field) {

        if (!lengthChecker(str, field)) {
            return false;
        } else if (!checkAplhaNumeric(str, field)) {
            return false;
        } else if ($('#program').val() == null) {
            showError("Please select a program.");
            return false;
        }
        return true;
    }

    $scope.checkUsername = function () {
        var un = document.getElementById('un_reg').value;
        if (!fieldChecker(un, 'username')) {
            return false;
        }
        var email = document.getElementById('email_reg').value;
        var pw = document.getElementById('pw_reg').value;
        var pw2 = document.getElementById('pw2_reg').value;
        var schoolname = document.getElementById('school').innerHTML;

        if (!fieldChecker(pw, 'password')) {
            return false;
        }
        if (!passwordSameChecker(pw, pw2)) {
            return false;
        }
        if (!validateSchool(schoolname)) {
            return false;
        }
        var url = "/db/check_username.php";

        var data = $.param({
            username: un,
            email: email
        });

        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $http.post(url, data, config)
            .then(function (response) {
                console.log(response);

                $scope.response = response;
                if (response.data.records[0].user) {
                    showError("That username is already taken.");
                } else if (!response.data.records[0].email) {
                    showError("Please enter a valid email.");
                } else {
                    $scope.createAccount();
                }
            });

    }

    $scope.createAccount = function () {
        var un = document.getElementById('un_reg').value;
        var email = document.getElementById('email_reg').value;
        var pw = document.getElementById('pw_reg').value;
        var schoolid = document.getElementById('schoolid').innerHTML;
        var schoolname = document.getElementById('school').innerHTML;
        var year = document.getElementById('year').innerHTML;


        var url = "/db/create_account.php";

        var data = $.param({
            username: un,
            password: pw,
            email: email,
            schoolid: schoolid,
            schoolname: schoolname,
            year: year
        });
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };


        $http.post(url, data, config)
            .then(function (response) {
                console.log(response);
                $scope.response = response;
                if (response.data[0].response == 200) {
                    $scope.login();
                } else {
                    alert("error in creating account");
                }
            });

    }
    $scope.login = function () {
        $(".header_title").text('Login');
        document.getElementById('register_app').style.display = "none";
        document.getElementById('login_form').style.display = "inline";
    }
});

angular.bootstrap(document.getElementById('register_app'), ['myApp']);

$(document).ready(function () {
    $('#errorBtn').on('click', function () {
        $('#errorMessage').slideUp('fast');
    });
});
