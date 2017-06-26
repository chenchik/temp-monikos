<link rel="stylesheet" type="text/css" href="/mvc/public/css/social.css">
<link rel="stylesheet" type="text/css" href="/mvc/public/css/main.css">
<link rel="stylesheet" href="/mvc/public/assets/css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" media="screen" title="no title">
<script src="/mvc/public/js/social/socialCtrl.js"></script>
<meta name='viewport' content="width=device-width, initial-scale=1" />
<script src="/mvc/public/js/ui-bootstrap-tpls-2.5.0.min.js"></script>



<body id="main_app_module" ng-app='socialApp' ng-controller='socialCtrl'>

    <div id=app_header>
        <a ng-click="indextest()"><button class = 'back'>Home</button></a>
        <a ng-click="drugDatabase()"><button class = 'database'>Database</button></a>
        <a ng-click="listManager()"><button class = 'study'>Study</button></a>
        <a ng-click='home()'><img id="toplogo" src="/mvc/public/images/logo_without_words_version_1.png"></a>

        <div onclick="toggleMenuNav()" class=menu-info>
            <span id="notificationIndicator"></span>
            <img src=/mvc/public/images/man-user.png>
        </div>

        <div id='menu-popup' class='menu-popup'>
            <div class=notif-info>
                <h2>Notifications</h2>
                <p id="noNotificationsText">There are no notifications at this moment.</p>
                <div style="display:none" id="notificationsBlock">

                </div>
            </div>
            <div class=user-info>
                <img src="/mvc/public/images/user_icon.png">
                <div class=user-info-sub>
                    <div class=username-info>{{capsules[0].username}}</div>
                    <div class=email-info>({{capsules[0].email}})</div>
                    <div class=capsule-info>{{capsules[0].capsules}} Capsules</div>
                    <a href="#" onclick="logout()">
                        <div class=logout-btn>logout</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-address-book" aria-hidden="true"></i>  &nbsp Manage Friends</a></li>
            <li><a data-toggle="tab" href="#menu1"><i class="fa fa-trophy" aria-hidden="true"></i> &nbsp Your Ranking</a></li>

        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <h3>Manage Friend</h3>
                <div class='add-list-block'>
                    <button ng-click=showPopup() | $event.stopPropagation()> Add new Friends </button>
                    <input type="search" class="form-control listButton" id="searchlist" placeholder="Search Friends">
                </div>
                <div class="friends" ng-repeat="friend in friends">
                    <div class="friend">
                        <p>
                            {{friend.username}}
                        </p>
                        <button class='selectList'>SELECT</button>

                        <button class='selectList'>VIEW</button>

                        <button class='selectList'>DELETE</button>

                    </div>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">

                <!-- <div class="title"> -->
                <h3 class=challenge-title>Your Ranking<button class="challenge" type="button" name="button">See Ranking with Friends</button></h3>
                <!-- </div> -->

                <div class="ranking-list">
                    <div class="ranking-item">
                        <br>
                        <p>Zhenwei Zhang<span class="badge ranking-circle">1</span></p>
                    </div>

                    <div class="ranking-item">
                        <br>
                        <p>Weijian Li<span class="badge ranking-circle">2</span></p>
                    </div>

                    <div class="ranking-item">
                        <br>
                        <p>Serena Tan<span class="badge ranking-circle">3</span></p>
                    </div>

                    <div class="ranking-item">
                        <br>
                        <p>Shuo Wang<span class="badge ranking-circle">4</span></p>
                    </div>

                    <div class="ranking-item">
                        <br>
                        <p>Joseph<span class="badge ranking-circle">5</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add friends popup -->
    <div id="modal-wrapper" style="visibility:hidden;">
        <div id="modal" class="add-friend" ng-click='$event.stopPropagation()'>
            <header class="popupHeader">
                <span class="header_title">Add a Friend</span>
                <span id="login_close" class="modal_close" ng-click="hidePopup()"><i class="fa fa-times"></i></span>
            </header>
            <section class="popupBody">
                <p id="result-msg" class="text-center" ng-bind="result"></p>
                <!-- fr_un means friend's username -->
                <form name="login_form">
                    <input placeholder="Search by Username" type="text" id="fr_un" />
                </form>
            </section>
            <div id="container">
                <button ng-click=addFriend() | $event.stopPropagation() id="submit"> Add Friend </button>
            </div>
        </div>
        <div id='lean_overlay_social' ng-click='$event.stopPropagation()'> </div>
    </div>

</body>
