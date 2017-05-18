//Created by Dana Elhertani, Danila Chenchik Monikos LLC

var challengeGame;
var challengeUser;
var challengeBet;
var challengeId;
var showingSelectGame = false;
var showingSelectUser = false;
var showingPlaceBet = false;
//DC variables
var datalid = document.getElementById('datalid').innerHTML;

var gameMenuApp = angular.module('gameMenuApp', ['ngAnimate']);
/*DANGEROUS*/
/*gameMenuApp.filter("trustUrl", ['$sce', function ($sce) {
    return function (recordingUrl) {
        return $sce.trustAsResourceUrl(recordingUrl);
    };
}]);*/

/*DANGEROUS*/
//gameMenuApp.controller('gameMenuCtrl', ['$scope','$sce', '$http', '$timeout', function($scope, $sce, $http, $timeout) {
gameMenuApp.controller('gameMenuCtrl', function($scope, $http){
    
    //Nik's edits
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length,c.length);
            }
        }
        return "";
    }

    var id_cookie = getCookie("user_id");
    console.log(id_cookie);

    var data = $.param({
        id : id_cookie
    });

    var config = {
        headers : {
            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
    };

    var url = "/db/get_user_profile.php";

    $http.post(url, data, config)
        .then(function (response) {
        console.log(response);
        //console.log(response);
        //$scope.names = response.data.records;
        $scope.capsules = response.data.records;
        //console.log($scope.names);
        //alert($scope.names);
    });


    //end NIk's edits

    function gotoChallenge(url){
        window.location = url;
    }

    $scope.getNotifications = function(){
        var username = getCookie('username');

        var data = $.param({
            user : username
        });

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        var url = "/db/get_notifications.php";

        $http.post(url, data, config)
            .then(function (response) {
            console.log(response);

            $('#notificationIndicator').html(response.data.records.length);
            //if theres no challenges dont show anything
            if(!response.data.records.length){
                $('#notificationIndicator').css({'display':'none'});
            }else{
                $('#noNotificationsText').css({'display':'none'});
                $('#notificationsBlock').css({'display':'block'});
                for(var notif in response.data.records){
                    var _url = response.data.records[notif]['url'];
                    var elemm = document.createElement('p');
                    elemm.innerHTML = 'challenge:' + response.data.records[notif]['challengegame'] + ', bet:'+ response.data.records[notif]['bet'] + ', who:' + response.data.records[notif]['user1'];
                    elemm.className = 'notificationText';
                    elemm.onclick = function() {
                        window.location = _url
                    };
                    document.getElementById("notificationsBlock").appendChild(elemm);
                }
            }
        });

    }
    $scope.getNotifications();



/*DANGEROUS*/
//    $scope.queryBy = '$';
//    $scope.trustAsHtml = $sce.trustAsHtml;

    $scope.createChallenge = function(dagame, challengeFlag){

        
        var usr1 = getCurrentUser();
        var usr2 = challengeUser;
        var data = $.param({
            user1: usr1,
            user2: usr2,
            game: challengeGame,
            bet: challengeBet
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        var theurl = "/db/create_challenge.php";
        //var theurl = '/db/get_drugs.php'
        $http.post(theurl, data, config)
            .then(function (response) {
            console.log(response);
            $scope.response = response;
            challengeId = response.data[0].challengeid;
            window.location = window.location.origin + "/mvc/public/games/"+dagame+"/" + datalid + "/" + challengeFlag + "/" + challengeGame + "/" + usr1 + "/" + challengeUser + "/" + challengeBet + "/" + challengeId;
        });

    }

});

function gotoGame1(challengeFlag){
    //normal play, not challenge mode
    if(challengeFlag == undefined){
        window.location = window.location.origin + "/mvc/public/games/game1/" + datalid;
    }else{
        //challenge mode
        angular.element(document.getElementById('main_app_module')).scope().createChallenge('game1', challengeFlag);
    }
}


function gotoGame2(challengeFlag){
    //normal play, not challenge mode
    if(challengeFlag == undefined){
        window.location = window.location.origin + "/mvc/public/games/game2/" + datalid;
    }else{
        //challenge mode
        angular.element(document.getElementById('main_app_module')).scope().createChallenge('game2', challengeFlag);
    }
}

function gotoFlashcard(challengeFlag){
    //normal play, not challenge mode
    if(challengeFlag == undefined){
        window.location = window.location.origin + "/mvc/public/games/flashcard/" + datalid;
    }else{
        //challenge mode
        angular.element(document.getElementById('main_app_module')).scope().createChallenge('flashcard', challengeFlag);
    }
}

function gohome(){
    window.location = window.location.origin + "/mvc/public/home/";
}

function golistManager(){
    window.location = window.location.origin + "/mvc/public/home/listManager";
}

function listManager(){
    window.location = window.location.origin + "/mvc/public/home/listManager";
}

function getCurrentUser(){
    return getCookie('username');
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}

function challenge(game){
    //alert(game);
    //$("#challenge-"+game).css({"background":"white","color":"#ff3333"});
    if(game == 'matching'){
        gotoGame1('challenge');
    }else if(game == 'pill'){
        gotoGame2('challenge');
    }
}

function selectChallengeGame(game){
    challengeGame = game;
}

function selectChallengeUser(){
    challengeUser = $('#findUser').val();
}

function challengeSubmit(){
    challengeBet = $('#capsulesQuantity').val();
    console.log("game is:" + challengeGame);
    console.log("user is:" + challengeUser);
    console.log("bet is:" + challengeBet);

    if(challengeGame == 'matching'){
        gotoGame1('challenge');
    }else if(challengeGame == 'pill'){
        gotoGame2('challenge');
    }
}

function toggleMenuNav(){
    //$('#menu-popup').css({'visibility':'visible','opacity':'1.0'});
    $('#menu-popup').toggleClass('navOpen');
}

$(document).ready(function () {
    $('#challenge-block').on('click',function(){
        if(!showingSelectGame){
            var innerChallenge = $("#innerChallenge");
            innerChallenge.slideDown("fast");
            $('#challengeText').slideUp("fast");
            showingSelectGame = true;
        }
    });

    $('.challengeButton').on('click', function(){
        $(this).css({"background":"#8d99ae","color":"white"});

    });

    $('.SelectChallengeGameButton').on('click', function(){
        $('#innerChallengeFindFriend').slideDown('fast');
        $('#innerChallenge').slideUp("fast");
    });

    $('#challengeUserButton').on('click', function(){
        if(!showingSelectUser){
            $(this).css({"background":"#8d99ae","color":"white"});
            $('#innerChallengePlaceBet').slideDown('fast');
            $('#innerChallengeFindFriend').slideUp("fast");
            showingSelectUser = true;
        }
    });

    $('#challengeSubmit').on('click', function(){
        if(!showingPlaceBet){
            $('#innerChallengePlaceBet').slideUp("fast");
            $('#innerChallengeLoading').slideDown("fast");
            showingPlaceBet = true;
        }
    });

    function openChallenge(url){
        alert(url);
    }


});
