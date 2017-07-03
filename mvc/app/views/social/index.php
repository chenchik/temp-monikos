<!-- Created by Joseph Son, Zhenwei Zhang Monikos LLC -->

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
        
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-address-book" aria-hidden="true"></i>  &nbsp Manage Friends</a></li>
            <li><a data-toggle="tab" href="#menu1" ng-click="getNatlRank() ; getSchoolRank() ; getFriendRank()"><i class="fa fa-trophy" aria-hidden="true"></i> &nbsp Rankings</a></li>

        </ul>
        
    </div>

    <div class="container">

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class='add-list-block'>
                    <button ng-click=showPopup("add") | $event.stopPropagation()> Add a Friend </button>
                    <input type="search" class="form-control listButton" id="searchlist" placeholder="Search for your Friends" ng-model="searchText">
                </div>

                <div class="friends" ng-repeat="friend in friends | filter:searchText">
                    <div class="friend">
                        <p>
                            {{friend.username}}
                        </p>
                        <button class='selectList' ng-click="showPopup(friend.username)">VIEW</button>
                        <button class='selectList' ng-click="deleteFriend(friend.username);showResult('deleted')">DELETE</button>
                        <div id="view-friend" style="visibility:hidden;">
                            <div id="modal" class="add-friend" ng-click='$event.stopPropagation()'>
                                <header class="popupHeader socialHeader">
                                    <span class="header_title">Friend Profile</span>
                                    <span id="login_close" class="modal_close" ng-click="hidePopup()"><i class="fa fa-times"></i></span>
                                </header>
                                <section class="popupBody" id="friend-profile">
                                    <b>Username:</b> <span ng-bind="friend_username"></span> <br>
                                    <b>School:</b> <span ng-bind="friend_school"></span> <br>
                                    <b>Year:</b> <span ng-bind="friend_year"></span><br>
                                    <b>Capsules:</b> <span ng-bind="friend_caps"></span> 
                                </section>
                            </div>
                            <div id='lean_overlay_social' ng-click='$event.stopPropagation()'> </div>
                        </div>
                    </div>
                </div>

                <div id="errorMessage" class="deleted" style="visibility:hidden;">
                    <img id="errorLogo" src="/mvc/public/images/white_logo.png">
                    <p class="errorText" ng-bind="deleted"></p>
                    <div id='errorBtn'><button id="innerErrorBtn" class="button button5" ng-click="hideResult('deleted')">Okay</button></div>
                </div>

            </div>
            <div id="menu1" class="tab-pane fade">

                <div class='add-list-block'>
                    <button ng-click=showNatl()> National </button>
                    <button ng-click=showSchool() class="form-control listButton" ng-bind="user_school" style="width:auto;"> </button>
                    <button ng-click=showFriendRank() class="form-control listButton"> Friends </button>
                </div>

                <div class="ranking-list natl" ng-repeat="x in national" style="display:none;">
                    <div class="ranking-item natl">
                        <br>
                        <p>{{x.content}}<span class="badge ranking-circle">{{x.number}}</span></p>
                    </div>
                </div>

                <div class="ranking-list school" ng-repeat="y in school" style="display:none;">
                    <div class="ranking-item">
                        <br>
                        <p>{{y.content}}<span class="badge ranking-circle">{{y.number}}</span></p>
                    </div>
                </div>

                <div class="ranking-list pals" ng-repeat="z in friend_rank" style="display:none;">
                    <div class="ranking-item">
                        <br>
                        <p>{{z.content}}<span class="badge ranking-circle">{{z.number}}</span></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- add friends popup -->
    <div id="modal-wrapper" style="visibility:hidden;">
        <div id="modal" class="add-friend" ng-click='$event.stopPropagation()'>
            <header class="popupHeader socialHeader">
                <span class="header_title">Add a Friend</span>
                <span id="login_close" class="modal_close" ng-click="hidePopup('add')"><i class="fa fa-times"></i></span>
            </header>
            <section class="popupBody">
                <!-- fr_un means friend's username -->
                <form name="login_form">
                    <input placeholder="Username" type="text" id="fr_un" />
                </form>
            </section>
            <div id="container">
                <button ng-click="addFriend();showResult('added')" id="submit"> Add Friend </button>
            </div>
        </div>
        <div id='lean_overlay_social' ng-click='$event.stopPropagation()'> </div>
        <div id="errorMessage" class="added" style="visibility:hidden;">
            <img id="errorLogo" src="/mvc/public/images/white_logo.png">
            <p class="errorText" ng-bind="result"></p>
            <div id='errorBtn'><button id="innerErrorBtn" class="button button5" ng-click="hideResult('added')">Okay</button></div>
        </div>
    </div>
</body>
