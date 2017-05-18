//dc variables
var datalid = document.getElementById('datalid').innerHTML;

//Created by Dana Elhertani, Danila Chenchik Monikos LLC

var app = angular.module('myApp', []);
app.controller('matchingCtrl', function($scope, $http) {
    $scope.numClicked = 0;
    $scope.firstCard = null;
    $scope.secondCard = null;
    $scope.correct = "N";
    $scope.brandNames = [];
    $scope.allDrugs = [];
    $scope.finalList = [];
    $scope.numCorrect = 0;
    $scope.right = 0;
    $scope.finishedGame = false;
    $scope.score = 0;
    var shuffledObjects;
    $scope.initTime = ((new Date).getTime()/1000);

    $scope.selected =[]
    $scope.clear = false;

    $scope.select =[];

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

    function setRequestConfig(){
        return {
          headers : {
            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
          }
        };
    }

    function challengeComplete(){
      $('#challengeCompleteMessage').slideDown('fast');
    }

    $scope.checkIfBeingChallenged = function(){
      if($('#challengeFlag').html() == 'beingchallenged'){
        return true;
      }
      return false;
    }

    $scope.checkIfInChallengeMode = function(){
        //$scope.challengingFlag = true;
        if($('#challengeFlag').html() == 'challenge' || $('#challengeFlag').html() == 'challenge'){
            return true;
        }
        return false;
    }

    $scope.getUser2 = function(){
      var curUrl = window.location.href;
      var urlArr = curUrl.split('/');
      return urlArr[urlArr.length-3];
    }
    $scope.getUser1 = function(){
      var curUrl = window.location.href;
      var urlArr = curUrl.split('/');
      return urlArr[urlArr.length-4];
    }

    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(minutes + ":" + seconds);

            if (++timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

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

    //Begin dc edits

    $scope.checkIfChangedUser = function(){
      if($scope.checkIfBeingChallenged()){
        //check if being challenged
        //if yes, see if there's a cookie present for "username" and "user_id"
        //if the "username" cookie is the same as getUser2();
        //do nothing, and call niks code
        //otherwise
        //, clear those, and do a login with just the username in the backend
        //on the response, get the new username and user_id cookie info
        //set the cookies to that
        if(getCookie("username") == $scope.getUser2()){
          updateCookieFrontEnd();
        } else {

          $scope.logout();
          var usr2 = $scope.getUser2();
          $scope.loginWithChallengedUser(usr2);
        }
      }else{
        updateCookieFrontEnd();
      }
    }

    $scope.logout = function(){
      if(document.cookie.indexOf("user_id") > 0){
        document.cookie = "user_id=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/";
      }
      if(document.cookie.indexOf("username") > 0){
        document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/";
      }
    }

    $scope.loginWithChallengedUser = function(usr2){
      var url = "/db/do_username_login.php";

      var data = $.param({
          username: usr2
      });
      var config = {
          headers : {
              'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
          }
      };

      $http.post(url, data, config)
      .then(
          function (response) {
            //success
            console.log(response);
            document.cookie = "user_id="+response.data[0].user_id+"; expires="+(Date.now()+(86400 * 30))+"; path=/";
            document.cookie = "username="+response.data[0].username+"; expires="+(Date.now()+(86400 * 30))+"; path=/";
            updateCookieFrontEnd();
          },function(response){
            //failure
            handleLoginFailure(response);
      });
    }

    function handleLoginFailure(){
      alert("sorry we couldn't log you in");
    }

    function updateCookieFrontEnd(){

      var id_cookie = getCookie("user_id");

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
          $scope.capsules = response.data.records;
          //console.log("THESE ARE THE CAPSULES" + $scope.capsules);
      });
    }

    $scope.checkIfChangedUser();

    //end dc edits


    $scope.firstLoad = true;
    
    $scope.getlid = function(thelid, schoolrequest){
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        var data = $.param({
            lid: thelid
        });

        //url = window.location.origin + "/fb_login.php";
        //var listurl = "http://monikos.xpyapvzutk.us-east-1.elasticbeanstalk.com/get_specific_list.php";
        var listurl = "";
        if(!schoolrequest){
            listurl = "/db/get_specific_list.php";
        }else{
            listurl = "/db/get_specific_school_list.php";
        }

        $http.post(listurl, data, config)
            .then(function (response) {
            //handle if this is a school list request
            if(response.data.drugnames == undefined){
                $scope.getlid(thelid, true);
                if(schoolrequest){
                    $scope.firstLoad = false;
                    alert("We could not load your list");
                    return -1;
                }
            }else{
                $scope.select = response.data.drugnames.split(",");
                //console.log("SELCT " + $scope.select[0]);
                $scope.getAllTheDrugs();
            }
        });
        $scope.firstLoad = false;

    }
    //end dcedits


    $scope.getAllTheDrugs = function(){
        var url = "/db/get_drugs.php";
        $http.get(url)
            .then(function (response) {
            console.log(response);
            //console.log(response);
            //console.log("IS SELECT STILL THE SAME " + $scope.select);
            $scope.names = response.data.records.slice(1,30);
            $scope.allDrugs = response.data.records;
            //console.log($scope.names);
            //console.log($scope.allDrugs);
            //console.log($scope.allDrugs[0].Brand)

            if($scope.select[0][0].toUpperCase() == $scope.select[0][0]) {
                var d;
                for (d=0; d < $scope.select.length; d++){
                    //console.log("before if statement " + $scope.select[d]);
                    for(var x = 0; x < $scope.allDrugs.length; x++) {
                        if ($scope.allDrugs[x].Brand == $scope.select[d]){
                            //console.log("after if statement " + $scope.allDrugs[x].Generic);
                            var a = $scope.allDrugs[x];
                            $scope.finalList.push($scope.allDrugs[x]);
                            //console.log("final list " + $scope.finalList.length);
                        }

                    }

                }
            }
            else {
                for (d=0; d < $scope.select.length; d++){
                    //console.log("before if statement " + $scope.select[d]);
                    for(var x = 0; x < $scope.allDrugs.length; x++) {
                        if ($scope.allDrugs[x].Generic == $scope.select[d]){
                            //console.log("after if statement " + $scope.allDrugs[x].Generic);
                            var a = $scope.allDrugs[x];
                            $scope.finalList.push($scope.allDrugs[x]);
                            //console.log("final list " + $scope.finalList.length);
                        }

                    }

                }
            }



            //console.log("final list " + $scope.finalList[0]);

            $scope.names = $scope.finalList;


            //console.log("length of names " + $scope.names.length);



            //shuffles original list of just cards
            var a, b, c;
            for (c = $scope.names.length; c; c--) {
                a = Math.floor(Math.random() * c);
                b = $scope.names[c - 1];
                $scope.names[c - 1] = $scope.names[a];
                $scope.names[a] = b;
            }

            if ($scope.names.length > 8) {
                $scope.names = $scope.names.slice(1,9);
                $scope.right = 8;
            }
            else {
                $scope.right = $scope.names.length;
            }


            var objects = [];
            for (var i = 0; i < $scope.names.length*2; i++){
                if (i < $scope.names.length){
                    objects[i] = {drug: $scope.names[i], front: $scope.names[i].Generic, clicked: 'N', correct: 'N', active: 'N'};
                }
                else if (i >= $scope.names.length){
                    objects[i] = {drug: $scope.names[i - $scope.names.length], front: $scope.names[i - $scope.names.length].Brand, clicked:'N', correct: 'N', active: 'N'};
                }
            }

            //console.log("length of names - " + $scope.names.length);
            //console.log("length of objects- " + objects.length);

            //console.log(objects);


            shuffledObjects = objects.slice();

            var j, x, i;
            for (i = shuffledObjects.length; i; i--) {
                j = Math.floor(Math.random() * i);
                x = shuffledObjects[i - 1];
                shuffledObjects[i - 1] = shuffledObjects[j];
                shuffledObjects[j] = x;
            }

            //console.log("length of shuffled objects----- " + shuffledObjects.length);
            //console.log(shuffledObjects);

            $scope.names = shuffledObjects;
            numOfCards = shuffledObjects.length;

            $('#cssload-pgloading').css({'opacity':'0.0'});
            var fiveMinutes = 60 * 5;
            var display = $('.timerText');
            startTimer(0, display);

        });
    }

    $('button.toggler').on("click",function(){
        $(this).toggleClass('active');
    });

    $scope.clicked = function(front){
        $scope.clear = false;
       // console.log( $scope.numClicked);


        for(var i = 0; i < shuffledObjects.length;i++){
            if(front == shuffledObjects[i].front){
            	console.log(shuffledObjects[i].clicked);
                if (shuffledObjects[i].clicked == "Y"){
                    shuffledObjects[i].clicked = "N";
                    $scope.numClicked--;

                } else{
                    shuffledObjects[i].clicked = "Y";
                    $scope.numClicked++;
                    //console.log("afterrr " +shuffledObjects[i].clicked);
                }
            }

        }

                console.log( $scope.numClicked);

		if ($scope.numClicked == 1){
		    console.log("here3");
			for(var i = 0; i < shuffledObjects.length;i++){
            if(front == shuffledObjects[i].front){
            	shuffledObjects[i].clicked = "Y"
            	console.log(front);
            	console.log(shuffledObjects[i].clicked);
				console.log(shuffledObjects[i].active);
            }
            else {
            	shuffledObjects[i].clicked = "N"

            }

        	}
		}

        if ($scope.numClicked > 2) {
            $scope.numClicked = 1;
            console.log("here1");

            for(var i = 0; i < shuffledObjects.length;i++){
            	 if (shuffledObjects[i].clicked == "Y" && shuffledObjects[i].front == front){
                     $scope.firstCard = shuffledObjects[i];
           			 $scope.numClicked = 1;
           			 shuffledObjects[i].clicked = "Y";


                }
                else{

                shuffledObjects[i].clicked = "N";

                }
            }
        }

        if ($scope.numClicked == 2){
            //document.getElementById("tryagain").style.visibility="visible";
            console.log("here2");

            for(var i = 0; i < shuffledObjects.length;i++){
                if (shuffledObjects[i].clicked == "Y" && shuffledObjects[i].front == front){
                    $scope.firstCard = shuffledObjects[i];

                } else if (shuffledObjects[i].clicked == "Y"){
                    $scope.secondCard = shuffledObjects[i];
                } else {
                    if (shuffledObjects[i].active == 'Y') {
                        shuffledObjects[i].active = 'W';
                    }
                }
            }
            //console.log("first card " + $scope.firstCard.front);
            //console.log("second card " + $scope.secondCard.front);

            if ($scope.firstCard.front == $scope.secondCard.drug.Brand || $scope.firstCard.front == $scope.secondCard.drug.Generic){
                $scope.correct = "Y";
                $scope.numCorrect +=2;
                $scope.right++;
                $scope.firstCard.correct = 'Y';
                $scope.secondCard.correct = 'Y';
                $scope.firstCard.active = 'Y';
                $scope.secondCard.active = 'Y';

                $scope.score = $scope.score +2;
                if(!($scope.checkIfInChallengeMode() || $scope.checkIfBeingChallenged())){
                    $scope.increaseCapules(2);
                }


                if ($scope.numCorrect == $scope.names.length){
                    if($scope.checkIfBeingChallenged()){
                      $scope.setOutcomeMessage("DETERMINING RESULTS...");
                      $scope.handleBeingChallengedCompletion();

                    }else if($scope.checkIfInChallengeMode()){
                      $scope.handleChallengeModeCompletion();
                      challengeComplete();
                    }else{
                      $('#completeMessage').slideDown('fast');
                    }

                }
            }
            else {
                $scope.correct = "N";
            }

            setTimeout(function(){ $scope.numClicked==0 ; }, 1050);
        }
        //console.log("numClicked after " + $scope.numClicked);
        //console.log("correct " + $scope.correct);
    }


    $scope.clearBoard = function(){
        $scope.clear = true;
    }

    $scope.home = function(){
        window.location = window.location.origin + "/mvc/public/home/";
    }

  //begin danila chenchik code

  $scope.handleChallengeModeCompletion = function(){
    var curUrl = window.location.href;
    var urlArr = curUrl.split('/');
    var challengeidUrlPosition = urlArr.length-1;
    for(var i in urlArr){
      if(urlArr[i] == "challenge"){
        urlArr[i] = "beingchallenged";
      }
    }
    var challengeid = urlArr[challengeidUrlPosition];
    var senderUrl = urlArr.join("/");
    $scope.updateChallengeChallenging(challengeid, senderUrl);
    console.log(senderUrl);
  }

  $scope.updateChallengeChallenging = function(id, senderUrl){
    console.log("INIT TIME " + $scope.initTime);
    var finalScore = Math.ceil(((new Date).getTime()/1000) - $scope.initTime);
    console.log("THIS IS THE FINAL SCORE " + finalScore);
    var data = $.param({
      challengeid : id,
      user1score: finalScore,
      url: senderUrl
    });

    var config = {
      headers : {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
    };

    var url = "/db/update_challenge_challenging.php";
    $http.post(url, data, config)
    .then(function (response) {
      console.log(response);
      //window.open('mailto:danushac@gmail.com?subject=Monikos_Challenge&body=You have been challenged go to this url to access the challenge ' + senderUrl);
      $scope.sendEmail(senderUrl);
    });
  }

  $scope.sendEmail = function(senderUrl){
    var curUrl = window.location.href;
    var urlArr = curUrl.split('/');
    var gameUrlPosition = urlArr.length-5;
    var betUrlPosition = urlArr.length-2;
    var challengeBet = urlArr[betUrlPosition];
    var challengeGame = urlArr[gameUrlPosition];
    var usr2 = $scope.getUser2();
    var usr1 = $scope.getUser1();

    var data = $.param({
      url: senderUrl,
      user2: usr2,
      user1: usr1,
      bet: challengeBet,
      game: challengeGame
    });

    var config = {
      headers : {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
    };

    var url = "/db/send_email_user2.php";
    $http.post(url, data, config)
    .then(function (response) {
      console.log(response);
    });
  }

  $scope.handleBeingChallengedCompletion = function(){
    var curUrl = window.location.href;
    var urlArr = curUrl.split('/');
    var challengeidUrlPosition = urlArr.length-1;

    var challengeid = urlArr[challengeidUrlPosition];

    $scope.updateChallengeBeingChallenged(challengeid);

  }

  $scope.updateChallengeBeingChallenged = function(id){
    var finalScore = Math.ceil(((new Date).getTime()/1000) - $scope.initTime);
    console.log("final score user 2" + finalScore);
    var data = $.param({
      challengeid : id,
      user2score: finalScore,

    });

    var config = {
      headers : {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
    };
    var winner;
    var url = "/db/update_challenge_being_challenged.php";
    $http.post(url, data, config)
    .then(function (response) {
      console.log(response);
      winner = $scope.determineWinner(id);
    });

  }

  $scope.determineWinner = function(id){
    var data = $.param({
      challengeid : id
    });

    var config = {
      headers : {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
    };

    var url = "/db/determine_winner.php";
    $http.post(url, data, config)
    .then(function (response) {
      console.log(response);
      var user1 = response.data.user1;
      var user2 = response.data.user2;
      var user1score = response.data.user1score;
      var user2score = response.data.user2score;
      var bet = response.data.bet;

      $scope.updatecapsules(id, user1, user2, user1score, user2score, bet);

    });
  }

  $scope.updatecapsules = function(id, usr1, usr2, usr1score, usr2score, thebet){
    var data = $.param({
      challengeid : id,
      user1: usr1,
      user2: usr2,
      user1score: usr1score,
      user2score: usr2score,
      bet: thebet
    });

    var config = {
      headers : {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
    };

    var url = "/db/update_challenge_capsules.php";
    $http.post(url, data, config)
    .then(function (response) {
      console.log("UPDATING CAPSULES....");
      console.log(response);
      console.log("USER1 SCORE = " + usr1score);
      console.log("USER2 SCORE = " + usr2score);
      var score1 = parseInt(usr1score);
      var score2 = parseInt(usr2score);
      $scope.deleteChallenge(id, usr1, usr2, usr1score, usr2score, thebet, score1, score2);

    });
  }

  $scope.deleteChallenge = function(id, usr1, usr2, usr1score, usr2score, thebet, score1, score2){
    var data = $.param({
      challengeid : id
    });

    var config = {
      headers : {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
    };

    var url = "/db/delete_challenge.php";
    $http.post(url, data, config)
    .then(function (response) {
      console.log(response);
      document.getElementById("finished").innerHTML = '';
      if(score1 > score2){
        $('.challengeCompleteText').html("YOU WON " + thebet + " CAPSULES! Looks like you're quicker than "+$scope.getUser1()+". Click the button below to return to the game menu.");
      }else if(score1 < score2){
        $('.challengeCompleteText').html("You lost " + thebet + " capsules against "+$scope.getUser1()+". Click the button below to return to the game menu.");
      }else{
        $('.challengeCompleteText').html("You tied.\nNeither you or "+$scope.getUser1()+" are awarded any capsules for this challenge. Click the button below to return to the game menu.");
      }
      challengeComplete();
    });
  }

  //keeping this, maybbe they ont like the pop up
  $scope.setOutcomeMessage = function(message){
    $('.betQuantityText').css({"display":"none"});
    $('.userText').css({"display":"none"});
    $('.outcomeMessage').css({"display":"block"});
    $('.outcomeMessage').html(message);
  }

  $scope.increaseCapules = function(caps){
    //we are only updating capsules per click on single player
    var curUser = getCookie('username');
    var curUserId = getCookie('user_id');

    var data = $.param({
      capsules: caps,
      id: curUserId,
      user: curUser
    });

    var config = setRequestConfig();

    var url = "/db/update_capsules.php";
    $http.post(url, data, config)
    .then(function (response) {
      console.log(response);
      if(response.data.records != undefined){
        $scope.capsules = response.data.records;
        $scope.flashPills(caps);
      }else{
        alert("there was an error processing the request");
      }

      //alert('updated capsules');
    });
  }

  $scope.flashPills = function(caps){
    $(".menu-info").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
    $("#updated-capsules-indicator").html("+"+caps+" ");
    $("#updated-capsules-indicator").css({'color':'rgb(46, 204, 113)'});
    $("#updated-capsules-indicator").fadeIn(800).fadeOut(800);
  }


  numOfCards = 0;

  function isGameFinished(){
      if($scope.right >= $scope.names.length){
          $scope.finishedGame = true;
          alert("done");
          console.log("done");
      }
  }

  function tryAgain(){
      //alert("test");
      document.getElementById("tryagain").style.visibility="hidden";
      document.getElementById("nextButton").click();
      var x = document.getElementsByClassName("BtnBlue");
      x[0].click();
  }

  

  $('#new_round').on('click', function(){
      $('#completeMessage').slideUp('fast');
  });

  $( document ).ready(function() {
      $('.completeButton').on('click', function(){
          $(this).css({"background":"#777"});
      });
  });


});

function gotoGamelist(){
    window.location = window.location.origin + "/mvc/public/games/menu/" + datalid;
}
