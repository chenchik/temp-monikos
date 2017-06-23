var app = angular.module('socialApp', []);

var config = {
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    }
};

app.controller('socialCtrl', function ($scope, $http, $log) {

    $scope.getFriends = function () {
        var id_cookie = getCookie("user_id");
        var data = $.param({
            id: id_cookie
        });
        $http.post('/db/get_friends.php', data, config).then(function (response) {
            $log.info(response.data.records);
            $scope.friends = response.data.records;
        });
    }
    
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
