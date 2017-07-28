//Created by Danila Chenchik Monikos LLC

var app = angular.module('myApp', []);

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

var config = {
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
  }
};

function logout(){
    $.get("../../../../db/logout.php",function(data,status){
       console.log(data); 
    });
    
    window.location = window.location.origin = "/mvc/public/landing.html";
}

app.controller('homeCtrl', function($scope, $http) {
  
  var id_cookie = getCookie("user_id");
  console.log(id_cookie);

  var data = $.param({
      id: id_cookie
  });

  var config = {
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
  };

  var url = "/db/get_user_profile.php";

  $http.post(url, data, config)
      .then(function (response) {
          user_capsules = response.data.records[0].capsules;
          $scope.capsules = response.data.records;
          //console.log($scope.names);
          //alert($scope.names);
      });
  var url = "/db/get_drugs.php";
  $http.get(url)
    .then(function(response) {
      console.log(response);
      $scope.names = response.data.records;
      console.log($scope.names);
    });

  $scope.getNotifications = function() {

    var url = "/db/get_notifications.php";

    var username = getCookie('username');

    var data = $.param({
      user: username
    });

    $http.post(url, data, config)
      .then(function(response) {
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
            elemm.onclick = function() {
              window.location = _url
            };
            document.getElementById("notificationsBlock").appendChild(
              elemm);
          }
        }
      });

  }
  $scope.getNotifications();

  $scope.premiumCheck = function() {
    var username = getCookie('username');
    var url = "/db/get_profile_by_user.php";
    var data = $.param({
      un: username
    });
    $http.post(url, data, config)
      .then(function(response) {
        console.log(response.data.records);
        var premium = response.data.records[0]["premium"];
        if (!premium) {
          $("#payment").show();
          $scope.img = "/mvc/public/images/socialgrey.png";
          $("#social").css('border', '2px solid #777777');
          $("#social").css('transition', '');
          $("#social").css('color', '#777777');
          $("#toplogo").attr("src","/mvc/public/images/litelogo.png");
          $("#social-text").text("Upgrade now to add friends, challenge them and see your rank among your friends!")
        } else {
          $scope.img = "/mvc/public/images/social.png";
          $("#payment").hide();
        }
      });
  }
  $scope.premiumCheck();

  $scope.getImg = function() {
    return $scope.img;
  }

  $scope.gobackhome = function() {
    //create new database controller
    window.location = window.location.origin +
      "/mvc/public/home";
  }

  $scope.drugDatabase = function() {
    //create new database controller
    window.location = window.location.origin +
      "/mvc/public/home/drugDatabase";
  }

  $scope.listManager = function() {
    //create list manager controller
    window.location = window.location.origin +
      "/mvc/public/home/listManager";
  }
  $scope.payment = function() {
    //create list manager controller
    window.location = window.location.origin +
      "/mvc/public/home/pricing";
  }


  $scope.social = function() {
    var username = getCookie('username');
    var url = "/db/get_profile_by_user.php";
    var data = $.param({
      un: username
    });
    $http.post(url, data, config)
      .then(function(response) {
        console.log(response);
        var premium = response.data.records[0]["premium"];
        if (premium) {
          window.location = window.location.origin +
            "/mvc/public/home/social";
        } else if (!premium) {
          window.location = window.location.origin +
            "/mvc/public/home/pricing";
        }
      });
  }

  $scope.getUser = function() {
    // var username = getCookie('username');
    // var url = "/db/get_profile_by_user.php";
    // var data = $.param({
    //     un: username
    // });
    // $http.post(url, data, config)
    //     .then(function (response) {
    //         console.log(response);
    //         response.data.records[0]["premium"];
    //     });
  }
});
