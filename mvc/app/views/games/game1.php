<!-- Created by Dana Elhertani, Nik Gunawan, Danila Chenchik Monikos LLC -->

<link rel="stylesheet" type="text/css" href="/mvc/public/css/style.css">

<meta name='viewport' content="width=device-width, initial-scale=1" />

<body id="game1" ng-app="myApp" ng-controller="matchingCtrl" >

    <!--HTML STUFF HERE-->
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
                <img src="/mvc/public/images/user_icon.png">
                <div class=user-info-sub>
                    <div class=username-info>{{capsules[0].username}}</div>
                    <div class=email-info>({{capsules[0].email}})</div>
                    <div class=capsule-info>{{capsules[0].capsules}} Capsules</div>
                </div>
            </div>
        </div>

    </div>

    <div id=app_content>
        <div id="completeMessage" style="display:none">
            <p id="completeMessageText">Congratulations, you finished this round. </p>
            <div class="completeButton" id="finishedPlayNewRoundButton" onclick="window.location.reload()">NEW ROUND</div>
            <div class="completeButton" id="finishedBackToMenuButton" onclick="gotoGamelist()">MENU</div>
        </div>
        <p id="challengeFlag" style="display:none"><?=$data['challengeFlag']?></p>
        <p id="datalid" style="display:none"><?=$data['lid']?></p>

        <div id="challengeInfoBar" ng-show="checkIfInChallengeMode() && !checkIfBeingChallenged()">
            <p class="col-md-4 col-sm-4 col-xs-4 challengeInfoText userText">Challenging: <?=$data['user2']?></p>
            <p class="col-md-4 col-sm-4 col-xs-4 challengeInfoText timerText"></p>
            <p class="col-md-4 col-sm-4 col-xs-4 challengeInfoText betQuantityText">Bet Quantity: <?=$data['bet']?></p>
            <p style="display:none" class="col-md-12 col-sm-12 col-xs-12 challengeInfoText outcomeMessage"></p>
        </div>
        <div id="challengeInfoBar" ng-show="checkIfBeingChallenged()">
            <p class="col-md-4 col-sm-4 col-xs-4 challengeInfoText userText">Challenged By: <?=$data['user1']?></p>
            <p class="col-md-4 col-sm-4 col-xs-4 challengeInfoText timerText"></p>
            <p class="col-md-4 col-sm-4 col-xs-4 challengeInfoText betQuantityText">Bet Quantity: <?=$data['bet']?></p>
            <p style="display:none" class="col-md-12 col-sm-12 col-xs-12 challengeInfoText outcomeMessage"></p>
        </div>

        <div id=app_body>
            <div id="cssload-pgloading">
                <div class="cssload-loadingwrap">
                    <ul class="cssload-bokeh">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>



            <div ng-if="firstLoad">{{getlid(<?=$data['lid']?>, false)}}</div>

            <div id="challengeCompleteMessage" style="display:none">
                <img id="challengeCompleteLogo" src="/mvc/public/images/white_logo.png">

                <p class="challengeCompleteText" ng-show="checkIfInChallengeMode() && !checkIfBeingChallenged()">Your challenge has been sent to <?=$data['user2']?>. Once they answer it, you'll either lose or win <?=$data['bet']?> capsules. Click the button below to return to the game menu.</p>

                <p class="challengeCompleteText" ng-show="checkIfBeingChallenged()"></p>

                <div id='challenge_complete_btn'><button id="inner_challenge_complete_btn" class = "button button5" onclick="gotoGamelist()" >Game Menu</button></div>

           </div>

            <img id="finished" src="" style="margin-top: 25px; margin-left: 2%">
            <div ng-if="numClicked < 2" >
                <div ng-repeat="product in names" ng-if="$index % 4 == 0" class="row drugGridRow">
                    <div class="col-xs-3 drugGridCell"><button class="btnBlue"  ng-click="clicked(names[$index].front);" ng-hide = "names[$index].correct == 'Y' "
                                                               ng-style="{'background-color' : (names[$index].clicked == 'Y') && (numClicked <=2) ? '#0099ff' : '#6C7A89'}"  >{{names[$index].front}}</button>                    </div>
                    <div class="col-xs-3 drugGridCell" ng-if="names.length > ($index + 1)"><button class="btnBlue"  ng-click="clicked(names[$index+1].front);" ng-hide = "names[$index+1].correct == 'Y' "
                                                                                                   ng-style="{'background-color' : (names[$index+1].clicked == 'Y') && (numClicked <=2)  ? '#0099ff' : '#6C7A89'}">{{names[$index +1].front }}</button>
                    </div>
                    <div class="col-xs-3 drugGridCell" ng-if="names.length > ($index + 2)"><button class="btnBlue"  ng-click="clicked(names[$index+2].front);" ng-hide = "names[$index+2].correct == 'Y' "
                                                                                                   ng-style="{'background-color' : (names[$index+2].clicked == 'Y') && (numClicked <=2)? '#0099ff' : '#6C7A89'}"  >{{names[$index+2].front}}</button>                    </div>
                    <div class="col-xs-3 drugGridCell " ng-if="names.length > ($index + 3)"><button class="btnBlue"  ng-click="clicked(names[$index+3].front);" ng-hide = "names[$index+3].correct == 'Y' "
                                                                                                    ng-style="{'background-color' : (names[$index+3].clicked == 'Y') && (numClicked <=2) ? '#0099ff' : '#6C7A89'}"  >{{names[$index+3].front}}</button>                    </div>
                </div>
            </div>
            <div ng-if="numClicked==2 && correct == 'Y' ">
                <div ng-repeat="product in names" ng-if="$index % 4 == 0" class="row drugGridRow">
                    <div class="col-xs-3 drugGridCell"><button class="btnBlue"  ng-click="clicked(names[$index].front);" ng-hide = "names[$index].active == 'W' "
                                                               ng-style="{'background-color' : (names[$index].clicked == 'Y') && (numClicked <=2) ? '#2ECC71' : '#6C7A89'}"  >{{names[$index].front}}</button>                    </div>
                    <div class="col-xs-3 drugGridCell" ng-if="names.length > ($index + 1)"><button class="btnBlue"  ng-click="clicked(names[$index+1].front);" ng-hide = "names[$index+1].active == 'W' "
                                                                                                   ng-style="{'background-color' : (names[$index+1].clicked == 'Y') && (numClicked <=2)  ? '#2ECC71' : '#6C7A89'}">{{names[$index +1].front }}</button></div>
                    <div class="col-xs-3 drugGridCell" ng-if="names.length > ($index + 2)"><button class="btnBlue"  ng-click="clicked(names[$index+2].front);" ng-hide = "names[$index+2].active == 'W' "
                                                                                                   ng-style="{'background-color' : (names[$index+2].clicked == 'Y') && (numClicked <=2)? '#2ECC71' : '#6C7A89'}"  >{{names[$index+2].front}}</button></div>
                    <div class="col-xs-3 drugGridCell" ng-if="names.length > ($index + 3)"><button class="btnBlue"  ng-click="clicked(names[$index+3].front);" ng-hide = "names[$index+3].active == 'W' "
                                                                                                   ng-style="{'background-color' : (names[$index+3].clicked == 'Y') && (numClicked <=2) ? '#2ECC71' : '#6C7A89'}"  >{{names[$index+3].front}}</button></div>
                </div>
            </div>
            <div ng-if="numClicked==2 && correct == 'N' ">
                <div ng-repeat="product in names" ng-if="$index % 4 == 0" class="row drugGridRow">
                    <div class="col-xs-3 drugGridCell"><button class="btnBlue"  ng-click="clicked(names[$index].front);" ng-hide = "names[$index].active == 'W' "
                                                               ng-style="{'background-color' : (names[$index].clicked == 'Y') && (numClicked <=2) ? '#ff3333' : '#6C7A89'}"  >{{names[$index].front}}</button></div>
                    <div class="col-xs-3 drugGridCell" ng-if="names.length > ($index + 1)"><button class="btnBlue"  ng-click="clicked(names[$index+1].front);" ng-hide = "names[$index+1].active == 'W' "
                                                                                                   ng-style="{'background-color' : (names[$index+1].clicked == 'Y') && (numClicked <=2)  ? '#ff3333' : '#6C7A89'}">{{names[$index +1].front }}</button></div>
                    <div class="col-xs-3 drugGridCell" ng-if="names.length > ($index + 2)"><button class="btnBlue"  ng-click="clicked(names[$index+2].front);" ng-hide = "names[$index+2].active == 'W' "
                                                                                                   ng-style="{'background-color' : (names[$index+2].clicked == 'Y') && (numClicked <=2)? '#ff3333' : '#6C7A89'}"  >{{names[$index+2].front}}</button></div>
                    <div class="col-xs-3 drugGridCell" ng-if="names.length > ($index + 3)"><button class="btnBlue"  ng-click="clicked(names[$index+3].front);" ng-hide = "names[$index+3].active == 'W' "
                                                                                                   ng-style="{'background-color' : (names[$index+3].clicked == 'Y') && (numClicked <=2) ? '#ff3333' : '#6C7A89'}"  >{{names[$index+3].front}}</button></div>
                </div>
            </div>


        </div> <!-- /app_body -->
    </div>



    <div id = "foot" class = 'footer'>

        <!--<input onClick="tryAgain()" id = "tryagain" type= "button" value="Next">-->

        <div ng-if="numClicked==2 && correct == 'Y' ">{{isGameFinished()}}</div>

        <button id ='new_round' onClick="window.location.reload()">PLAY NEW ROUND</button>

    </div>



</body>
<!--</html>-->

<script src="/mvc/public/js/games/matchingCtrl.js"></script>
