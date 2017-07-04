//Created by Joseph Son Monikos LLC

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
var un_cookie = getCookie("username");

var config = {
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    }
};

app.controller('socialCtrl', function ($scope, $http, $log) {
    var data = $.param({
        id: id_cookie
    });

    var un_data = $.param({
        un: un_cookie
    });

    $scope.getNotifications = function () {
        var url = "/db/get_notifications.php";
        
        var username = getCookie('username');

        var data = $.param({
            user: username
        });

        $http.post(url, data, config)
            .then(function (response) {
                console.log(response);

                $('#notificationIndicator').html(response.data.records.length);
                //if theres no challenges dont show anything
                if (!response.data.records.length) {
                    $('#notificationIndicator').css({
                        'display': 'none'
                    });
                } else {
                    $('#noNotificationsText').css({
                        'display': 'none'
                    });
                    $('#notificationsBlock').css({
                        'display': 'block'
                    });
                    for (var notif in response.data.records) {
                        var _url = response.data.records[notif]['url'];
                        var elemm = document.createElement('p');
                        elemm.innerHTML = 'challenge:' + response.data.records[
                                notif]['challengegame'] + ', bet:' + response.data.records[
                                notif]['bet'] + ', who:' + response.data.records[notif]
              ['user1'];
                        elemm.className = 'notificationText';
                        elemm.onclick = function () {
                            window.location = _url
                        };
                        document.getElementById("notificationsBlock").appendChild(
                            elemm);
                    }
                }
            });

    }
    $scope.getNotifications();

    $http.post('/db/get_friends.php', data, config).then(function (response) {
        $log.info(response.data.records);
        $scope.friends = response.data.records;
    });

    $scope.getNatlRank = function () {
        $http.get("/db/rank_national.php").then(function (response) {
            $scope.national = response.data.records;
            console.log(response.data);
        });
    };

    $scope.getSchoolRank = function () {
        $http.post("/db/rank_school.php", un_data, config).then(function (response) {
            $scope.school = response.data.records;
            console.log(response.data);
        });
    };

    $scope.getFriendRank = function () {
        $http.post("/db/rank_friend.php", un_data, config).then(function (response) {
            $scope.friend_rank = response.data.records;
            console.log(response.data);
        });
    };

    $scope.addFriend = function () {
        var fr_un = document.getElementById('fr_un').value;
        var fr_data = $.param({
            fr_un: fr_un,
            un: un_cookie
        });
        $http.post('/db/add_friend.php', fr_data, config).then(function (response) {
            $scope.result = response.data;
            var success_msg = fr_un + " added to your friends list";
            if (response.data.includes("added")) {
                changeFontWhite();
            }
        });
    }

    $scope.deleteFriend = function (del) {
        var del_data = $.param({
            delete: del,
            un: un_cookie
        });
        $http.post('/db/delete_friend.php', del_data, config).then(function (response) {
            $scope.deleted = response.data;
        });

    }

    $scope.showPopup = function (option) {
        if (option == "add") {
            document.getElementById('modal-wrapper').style.visibility = "visible";
        } else {
            var length = $scope.friends.length;
            for (var i = 0; i < length; i++) {
                if ($scope.friends[i].username == option) {
                    $scope.friend_username = option;
                    $scope.friend_school = $scope.friends[i].school;
                    $scope.friend_year = $scope.friends[i].year;
                    $scope.friend_caps = $scope.friends[i].capsules;
                    break;
                }
            }
            document.getElementById('view-friend').style.visibility = "visible";
        }
        var css = document.createElement("style");
        css.type = "text/css"
        css.innerHTML =
            ".add-friend {webkit-transform: scale(1); -moz-transform: scale(1); -ms-transform: scale(1); transform: scale(1); opacity: 1; }";
        document.body.appendChild(css);
    }

    $scope.hidePopup = function (option) {
        if (option == "add") {
            document.getElementById('modal-wrapper').style.visibility = "hidden";
            $scope.result = "";
        } else {
            document.getElementById('view-friend').style.visibility = "hidden";
            $scope.result = "";
        }
        var css = document.createElement("style");
        css.type = "text/css"
        css.innerHTML =
            ".add-friend { -webkit-transform: scale(0.7); -moz-transform: scale(0.7);-ms-transform: scale(0.7);transform: scale(0.7);opacity: 0;-webkit-transition: all 0.3s;-moz-transition: all 0.3s;transition: all 0.3s;}";
        document.body.appendChild(css);
    }

    $scope.showNatl = function () {
        var arr = document.getElementsByClassName("ranking-list pals");
        var length = arr.length;
        for (i = 0; i < length; i++) {
            arr[i].style.display = "none";
        }
        var arr = document.getElementsByClassName("ranking-list school");
        var length = arr.length;
        for (i = 0; i < length; i++) {
            arr[i].style.display = "none";
        }
        var arr = document.getElementsByClassName("ranking-list natl");
        var length = arr.length;
        for (i = 0; i < length; i++) {
            arr[i].style.display = "block";
        }
    }


    $scope.showSchool = function () {
        var arr = document.getElementsByClassName("ranking-list pals");
        var length = arr.length;
        for (i = 0; i < length; i++) {
            arr[i].style.display = "none";
        }
        var arr = document.getElementsByClassName("ranking-list natl");
        var length = arr.length;
        console.log(length);
        for (i = 0; i < length; i++) {
            arr[i].style.display = "none";
        }
        var arr = document.getElementsByClassName("ranking-list school");
        var length = arr.length;
        console.log(length);
        for (i = 0; i < length; i++) {
            arr[i].style.display = "block";
        }
    }

    $scope.showFriendRank = function () {
        var arr = document.getElementsByClassName("ranking-list school");
        var length = arr.length;
        for (i = 0; i < length; i++) {
            arr[i].style.display = "none";
        }
        var arr = document.getElementsByClassName("ranking-list natl");
        var length = arr.length;
        for (i = 0; i < length; i++) {
            arr[i].style.display = "none";
        }
        var arr = document.getElementsByClassName("ranking-list pals");
        var length = arr.length;
        for (i = 0; i < length; i++) {
            arr[i].style.display = "block";
        }
    }


    $scope.showResult = function (option) {
        if (option == "deleted") {
            changeFontWhite();
            document.getElementsByClassName('deleted')[0].style.visibility = "visible";
        } else {
            document.getElementsByClassName('added')[0].style.visibility = "visible";
        }
    }

    $scope.hideResult = function (option) {
        console.log(option);
        if (option == "deleted") {
            document.getElementsByClassName('deleted')[0].style.visibility = "hidden";
            window.location.reload();
        } else {
            document.getElementsByClassName('added')[0].style.visibility = "hidden";
            if ($scope.result.includes("added")) {
                window.location.reload();
            }
        }
        changeFontRed();
        $scope.deleted = "";
        $scope.result = "";
    }

    function changeFontWhite() {
        var length = document.getElementsByClassName('errorText').length;
        for (var i = 0; i < length; i++) {
            document.getElementsByClassName('errorText')[i].style.color = "#FFF";
        }
    }

    function changeFontRed() {
        var length = document.getElementsByClassName('errorText').length;
        for (var i = 0; i < length; i++) {
            document.getElementsByClassName('errorText')[i].style.color = "#F63E17";
        }
    }


    $http.post("/db/get_user_profile.php", data, config).then(function (response) {
        console.log(response);
        $scope.user_school = response.data.records[0].school;
        console.log($scope.user_school);
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
