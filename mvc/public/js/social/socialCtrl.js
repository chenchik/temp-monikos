var app = angular.module('socialApp', []);

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
var id_cookie = getCookie("user_id");
var data = $.param({
    id: id_cookie
});
var config = {
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    }
};

app.controller('socialCtrl', function ($scope, $http, $log) {

    $scope.getFriends = function () {
        $http.post('/db/get_friends.php', data, config).then(function (response) {
            $log.info(response.data.records);
            $scope.friends = response.data.records;
        });
    }

    $scope.addFriend = function () {
        var fr_un = document.getElementById('fr_un').value;
        console.log(fr_un);
        var fr_data = $.param({
            fr_un: fr_un
        });
        $http.post('/db/add_friend.php', fr_data, config).then(function (response) {
            $log.info(response.data);
        });
    }

    $scope.showPopup = function () {
       document.getElementById('lean_overlay').style.display = "block"; 
    }
    
    $scope.hidePopup = function(){
        document.getElementById('lean_overlay').style.display = "none";
    }

    $http.post("/db/get_user_profile.php", data, config).then(function (response) {
        console.log(response);
        $scope.capsules = response.data.records;
    });

    $scope.home = function () {
        window.location = window.location.origin + "/mvc/public/home/";
    }
    $scope.listManager = function () {
        window.location = window.location.origin +
            "/mvc/public/home/listManager/";
    }

})
