<!-- Created by Dana Elhertani Monikos LLC -->

<head>
  <meta charset="utf-8">
    <meta name='viewport' content="width=device-width, initial-scale=1" />

    <script src = '/mvc/public/js/games/pendingCtrl.js'></script>
    <link href="/mvc/public/css/metro-responsive.css" rel="stylesheet">
    <link href='/mvc/public/css/rotating-card.css' rel='stylesheet' />

   <title>Challenge</title>

  <link rel="stylesheet" href="/mvc/public/css/flashcardstyle.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" media="screen" title="no title">

  <script>
function gotoGamelist(lid){
  var lid = lid;
  window.location = window.location.origin + "/mvc/public/games/menu/" + lid;
}
</script>

</head>

<body ng-app="myApp" ng-controller="pendingCtrl" id="main_app_module" style="width:100%;">

    <div id=app_header>
        <a onclick="gotoGamelist()"><button class = 'back'>Back</button></a>

        <a ng-click = 'home()'><img id="toplogo" src="/mvc/public/images/logo_without_words_version_1.png"></a>

        <div onclick="toggleMenuNav()" class=menu-info>
            <span id="updated-capsules-indicator" style="display:none;float:left"></span>
            <span id="notificationIndicator"></span>
            <img src=/mvc/public/images/man-user.png>

        </div>
        <div id='menu-popup' class='menu-popup'>
            <div class=notif-info>
                <h2>Notifications</h2>
                <p id="noNotificationsText">There are no notifications at this moment.</p>
                <div style="display:none" id="notificationsBlock">
                    <!--append notifications in here-->
                </div>
            </div>
            <div class=user-info>
                <img src="/mvc/public/images/landing_page/logo2.png">
                <div class=user-info-sub>
                    <div class=username-info>{{capsules[0].username}}</div>
                    <div class=email-info>({{capsules[0].email}})</div>
                    <div class=capsule-info>{{capsules[0].capsules}} Capsules</div>
                </div>
            </div>
        </div>
    </div>


        <div >
            <p>Oops, seems your challenger hasn’t finished the challenge yet. Come back later or Delete this challenge. 
            </p>
        </div>
        <div class="btn col-md-3" id="delete_challenge" ng-click='deleteChallenge("<?=$data['challengeid']?>")'>
            <h1><?=$data['challengeid']?></h1>
        </div>
        


</body>
