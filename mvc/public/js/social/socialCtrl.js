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

//challenging your friend variables
var challengeGame;
var bet;
var challengeUser;
var challenged_capsules;
var user_capsules;
var datalid;


function selectChallengeGame(game) {
    $('#challenge-header').text("Place a bet");
    $('#select-game').hide();
    $('#place-bet').show();
    challengeGame = game;
    console.log("You chose to play " + game);
}

function gotoGame1(challengeFlag) {
    angular.element(document.getElementById('main_app_module')).scope().createChallenge('game1', challengeFlag);
}


function gotoGame2(challengeFlag) {
    angular.element(document.getElementById('main_app_module')).scope().createChallenge('game2', challengeFlag);
}

app.controller('socialCtrl', function ($scope, $http, $log) {

    var data = $.param({
        id: id_cookie
    });

    var un_data = $.param({
        un: un_cookie
    });

    $scope.listId = [];
    $scope.lists = [];

    /* --------------- CHALLENGE SECTION --------------------- */

    //get drugs for list
    var getListsData = $.param({
        user_id: getCookie("user_id")
    });
    var getListsUrl = "/db/get_lists.php";
    $http.post(getListsUrl, getListsData, config)
        .then(function (response) {
            $scope.listId = response.data.records
            if (response.data.records.length < 1) {
                $(".custom-list-collection-block").append(
                    '<p id="noListsMessage">Please create a list</p>');
            } else {
                for (var i in response.data.records) {
                    $scope.lists.push({
                        name: response.data.records[i].list_name.toString(),
                        drugs: response.data.records[i].drugnames.toString().split(
                            ",")
                    });
                }
            }
        });

    //add list
    $scope.addList = function () {
        $scope.lists.push($scope.listform);
        var createListUrl =
            "http://monikos.xpyapvzutk.us-east-1.elasticbeanstalk.com/create_list.php";
        var createListUrl = "/db/create_list.php";

        var listData = $.param({
            name: $scope.listform.name,
            drugs: $scope.listform.drugs,
            user_id: $scope.getCookie("user_id")
        });


        $scope.listform.drugs;
        $http.post(createListUrl, listData, config)
            .then(function (response) {
                if (response.data[0].response == 200) {
                    console.log("successfuly added a list!");
                    $("#noListsMessage").remove();
                }
            });

        $scope.listform = {
            name: "",
            drugs: []
        };
        closeNav();
        window.location.reload();
    }


    //select list
    $scope.list_block = "list-block";

    $scope.selectList = function (index, thisElem) {
        $scope.passedId = $scope.listId[index]['list_id'];
        datalid=$scope.passedId;
        console.log("You selected list with ID: " + $scope.passedId);
        if ($scope.passedId != undefined) {
            $('#challenge-header').text("Select a game");
            $('#select-list').hide();
            $('#select-game').show();
        } else {
            $('#errorMessage').slideDown();
        }
    }

    //delete list
    $scope.deleteList = function (index) {
        $scope.passedId = $scope.listId[index]['list_id'];
        var url = "/db/delete_list.php";
        var data = $.param({
            lid: $scope.passedId
        });
        $http.post(url, data, config)
            .then(function (response) {
                console.log("You deleted list with ID: "+$scope.passedId);
                $scope.passedId = undefined;
            });
    }

    //submit challenge
    $scope.challengeSubmit = function () {
        bet = $('#capsulesQuantity').val();
        
        console.log("You placed a bet of " + bet + " capsules");
        console.log(un_cookie + " " + user_capsules);
        console.log(challengeUser + " " + challenged_capsules);

        var error = [];

        if (bet < 0) {
            error[0] = "Can't place a bet less than 0 capsules"
        }
        if (bet > user_capsules) {
            error[1] = "Can't place a bet larger than what you have"
        }
        if (bet > challenged_capsules) {
            error[2] = "Can't place a bet larger than what your friend has"
        }

        if (error.length == 0) {
            if (challengeGame == 'matching') {
                gotoGame1('challenge');
            } else if (challengeGame == 'pill') {
                gotoGame2('challenge');
            }
        } else {
            for (var i = 0; i < error.length; i++) {
                if (error[i] != null) {
                    console.log(error[i]);
                }
            }
        }
    }
    
    $scope.createChallenge = function (dagame, challengeFlag) {

        
        var usr1 = un_cookie;
        var usr2 = challengeUser;
        console.log(usr2);
        // var data = $.param({
        //     user1: usr1,
        //     user2: usr2,
        //     game: challengeGame,
        //     bet: bet
        // });
        // var theurl = "/db/create_challenge.php";
        // $http.post(theurl, data, config)
        //     .then(function (response) {
        //         console.log(response);
        //         $scope.response = response;
        //         challengeId = response.data[0].challengeid;
        //         window.location = window.location.origin + "/mvc/public/games/" + dagame + "/" + datalid + "/" + challengeFlag + "/" + challengeGame + "/" + usr1 + "/" + challengeUser + "/" + bet + "/" + challengeId;
        //     });
        window.location = window.location.origin + "/mvc/public/games/" + dagame + "/" + datalid + "/" + challengeFlag + "/" + challengeGame + "/" + usr1 + "/" + challengeUser + "/" + bet + "/" + 1;//1 for place holder, will update the challenge id after usr1 finishes the game

    }
    /* --------------- END CHALLENGE SECTION --------------------- */


    $scope.getNotifications = function () {
        var url = "/db/get_notifications.php";

        var username = getCookie('username');

        var data = $.param({
            user: username
        });

        $http.post(url, data, config)
            .then(function (response) {
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

    $scope.showPopup = function (option, challenge_user, challenge_capsules) {
        console.log(option);
        if (option == "add") {
            document.getElementById('modal-wrapper').style.visibility = "visible";
        } else if (option == "challenge") {
            challengeUser = challenge_user;
            challenged_capsules = challenge_capsules;
            document.getElementById('challenge-friend').style.visibility = "visible";
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
        } else if (option == "challenge") {
            $('#challenge-header').text("Select a list");
            $('#select-list').show();
            $('#select-game').hide();
            $('#place-bet').hide();
            
            document.getElementById('challenge-friend').style.visibility = "hidden";
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
        } else if (option == "added") {
            document.getElementsByClassName('added')[0].style.visibility = "visible";
        } else {
            //document.getElementsByClassName('challenge')[0].style.visibility = "visbile";
        }
    }

    $scope.hideResult = function (option) {
        console.log(option);
        if (option == "deleted") {
            document.getElementsByClassName('deleted')[0].style.visibility = "hidden";
            window.location.reload();
        } else if (option == "added") {
            document.getElementsByClassName('added')[0].style.visibility = "hidden";
            if ($scope.result.includes("added")) {
                window.location.reload();
            }
        } else {
            //document.getElementsByClassName('challenge')[0].style.visibility = "visbile";
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
        $scope.user_school = response.data.records[0].school;
        user_capsules = response.data.records[0].capsules;
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

$(document).ready(function () {

    $('#addListButton').on('click', function () {
        $('.custom-list-collection-block').addClass('list-collection-block-short');
    });

    $('.custom-list-collection-block').on('click', '.list_block .deleteList',
        function () {
            $(this).parent().remove();
        });

    $('.challenge').on('click', function () {
        $('#errorMessage').slideUp();
    });

    function removePopup() {
        $('.challenge').slideUp();
    }
});
