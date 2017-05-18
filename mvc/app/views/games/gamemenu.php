<!-- Created by Dana Elhertani, Danila Chenchik Monikos LLC -->

<link rel="stylesheet" type="text/css" href="/mvc/public/css/game.css"/>

<meta name='viewport' content="width=device-width, initial-scale=1" />

<body id="main_app_module" ng-app="gameMenuApp" ng-controller="gameMenuCtrl">

    <div id='app_header'>
        <a onclick="golistManager()" ><button class = 'back'>Back</button></a>

        <a onclick="gohome()"><img id="toplogo" src="/mvc/public/images/logo_without_words_version_1.png"></a>

        <div onclick="toggleMenuNav()" class=menu-info>
            <span id="notificationIndicator"></span>
            <img src=/mvc/public/images/man-user.png>
        </div>
        <p id="datalid" style="display:none"><?=$data['lid']?></p>
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
                    <a href="#" onclick="logout()"><div class=logout-btn>logout</div></a>

                </div>
            </div>
        </div>
    </div>

    <div id = app_content>
        <div class = "game-wrapper">

            <a onclick="gotoFlashcard()"><div class = "game-block game-red" id ='game_0'>FLASHCARD</div></a>

            <a onclick="gotoGame1()"><div class = "game-block game-white" id ='game_1'>MATCHING</div></a>

            <a onclick ="gotoGame2()"><div class = "game-block game-red" id ='game_2'>PILL GAME</div></a>

<!--           <a href='#'><div class = "game-block game-white" id ='game_3'>MULTIPLE CHOICE<br>QUIZ</div></a>-->

            <div class = "game-block game-white" id ='challenge-block'><span id='challengeText'>CHALLENGE A<br>FRIEND</span>
                <div id="innerChallenge" style="display:none">
                    <p id="selectGameText">Select a Game</p>
                    <div id="#challenge-matching" class="challengeButton SelectChallengeGameButton" onclick="selectChallengeGame('matching')">MATCHING</div>

					<div id="#challenge-pill" class="challengeButton SelectChallengeGameButton" onclick="selectChallengeGame('pill')">PILL GAME</div>
<!--

                    <div id="#challenge-quiz" class="challengeButton SelectChallengeGameButton" onclick="selectChallengeGame('quiz')">QUIZ</div>
-->

                </div>
                <div id="innerChallengeFindFriend" style="display:none">
                    <p id="selectUserText">Select a User</p>
                    <input type="text" name="findUser" id="findUser" placeholder="username">
                    <div class="challengeButton" id="challengeUserButton" onclick="selectChallengeUser()">Choose</div>
                </div>
                <div id="innerChallengePlaceBet" style="display:none">
                    <p id="placeBetText">Place a Bet</p>
                    <input type="number" name="capsulesQuantity" id="capsulesQuantity" min="0" max="10000000">
                    <div class="challengeButton" id="challengeSubmit" onclick="challengeSubmit()">Challenge</div>
                </div>
                <div id="innerChallengeLoading" style="display:none">
                    <img src="/mvc/public/images/loading.gif">
                </div>

            </div>

        </div>
    </div>

</body>

<script src="/mvc/public/js/games/gameMenuCtrl.js"></script>