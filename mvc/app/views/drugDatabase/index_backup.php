<!-- Created by Nik Gunawan Monikos LLC -->

<body id="database_module">
    <script>
      
        
        var app = angular.module('myApp', ['ngAnimate']);

        app.filter("trustUrl", ['$sce', function ($sce) {
            return function (recordingUrl) {
                return $sce.trustAsResourceUrl(recordingUrl);
            };
        }]);


        app.directive('modalDialog', function() {

            return {
                restrict: 'E',
                scope: {
                    show: '='
                },
                replace: true, // Replace with the template below
                transclude: true, // we want to insert custom content inside the directive
                link: function(scope, element, attrs) {
                    scope.dialogStyle = {};
                    if (attrs.width)
                        scope.dialogStyle.width = attrs.width;
                    if (attrs.height)
                        scope.dialogStyle.height = attrs.height;
                    scope.hideModal = function() {
                        scope.show = false;
                    };
                },
                template: "<div class='ng-modal' ng-show='show'><div class='ng-modal-overlay' ng-click='hideModal()'></div><div class='ng-modal-dialog' ng-style='dialogStyle'><div class='ng-modal-close' ng-click='hideModal()'>X</div><div class='ng-modal-dialog-content' ng-transclude></div></div></div>"
            };
        });

        app.directive('modalDialogTwo', function() {

            return {
                restrict: 'E',
                scope: {
                    show: '='
                },
                replace: true, // Replace with the template below
                transclude: true, // we want to insert custom content inside the directive
                link: function(scope, element, attrs) {
                    scope.dialogStyle = {};
                    if (attrs.width)
                        scope.dialogStyle.width = attrs.width;
                    if (attrs.height)
                        scope.dialogStyle.height = attrs.height;
                    scope.hideModal = function() {
                        scope.show = false;
                    };
                },
                template: "<div class='ng-modal' ng-show='show'><div class='ng-modal-overlay mnemonic-modal-overlay' ng-click='hideModal()'></div><div class='ng-modal-dialog-two' ng-style='dialogStyle'><div class='ng-modal-close-two' ng-click='hideModal()'>X</div><div class='ng-modal-dialog-content' ng-transclude></div></div></div>"
            };
        });







        app.controller('showCtrl', ['$scope', function($scope) {
            $scope.modalShown = false;
            $scope.toggleModal = function() {
                $scope.modalShown = !$scope.modalShown;
            };

            //             $scope.modalShown2 = false;
            //            $scope.toggleModal2 = function() {
            //                $scope.modalShown2 = !$scope.modalShown2;
            //            };

        }]);

        app.controller('showCtrl2', ['$scope', function($scope) {
            $scope.modalShown2 = false;
            $scope.toggleModal2 = function() {
                $scope.modalShown2 = !$scope.modalShown2;
            };

        }]);



        app.controller('customersCtrl', ['$scope','$sce', '$http', '$timeout', function($scope, $sce, $http, $timeout) {

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

            var url = "/db/get_capsule_info.php";

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


            $scope.queryBy = '$';
            //            $scope.modalShown = false;
            //            $scope.toggleModal = function() {
            //                $scope.modalShown = !$scope.modalShown;
            //            };

            $scope.trustAsHtml = $sce.trustAsHtml;
            //            $scope.trustAs = $sce.trustAs;


            //var url = "http://testmonikos.us-east-1.elasticbeanstalk.com/sql_result.php"
            //var url = "http://danilachenchik.com/sql_result.php";
            var url = "/db/get_drugs.php";

            $scope.loading = true;

            $http.get(url)
                .then(function (response) {
                console.log(response);
                //console.log(response);
                $scope.names = response.data.records;

                //                    $scope.names = $sce.trustAsHtml(response.data.records);
                console.log($scope.names);
                            $scope.loading = false;

                //alert($scope.names);
            });



            $scope.home = function(){
                //create new database controller
                window.location = window.location.origin + "/mvc/public/home/";
            }

            $scope.showInfo = function() {
                //show drug content in database
                //$
            }



            $scope.playAudio = function(myAudio) {
                var myAudio = 'myAudio-' + myAudio;
                var x = document.getElementById(myAudio);
                x.play();
            }

            $scope.pauseAudio = function(myAudio) {
                var x = document.getElementById(myAudio);
                x.pause(myAudio);
            }

            $scope.updateLikes = function(likeCount, dislikeCount, id){

                var url = "/db/update_drugs.php";
                var likes = parseInt(likeCount, 10);
                var dislikes = parseInt(dislikeCount, 10);
                var id = parseInt(id, 10);
                likes = likes + 1;
                likes = likes.toString();
                dislikes = dislikes.toString();

                var i = id - 1;
                var tempHintLikes = parseInt($scope.names[i].HintLikes, 10);
                $scope.names[i].HintLikes = tempHintLikes + 1;

                id = id.toString();


                var data = $.param({
                    likes: likes,
                    dislikes: dislikes,
                    drugid: id
                });
                var config = {
                    headers : {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                };



                $http.post(url, data, config)
                    .then(function (response) {
                    console.log(response);
                    //console.log(response);
                    //$scope.names = response.data.records;
                    $scope.response = response;
                    //console.log($scope.names);
                    //alert($scope.names);
                }); 


                var tempString = "plusone-like d" + id;
                $scope.plusone_obj = document.getElementsByClassName(tempString)[0];
                //                $scope.plusone_obj = document.querySelectorAll(tempString);
                $scope.plusone_obj.className += " plusone-animate";

                //                $timeout($scope.removeAnimateLike(id), 5000);

                //                $scope.id = id;
                setTimeout(function(){
                    var i = id;
                    //                    id = id.toString();
                    var tempString2 = "plusone-like d" + i + " plusone-animate";
                    $scope.plusone_obj = document.getElementsByClassName(tempString2)[0];
                    //                  $scope.plusone_obj = document.querySelectorAll(tempString2)
                    $scope.plusone_obj.className = "plusone-like d" + i;

                }, 500);

            }

            //            $scope.removeAnimateLike = function(id) {
            //                //                var i = id - 1;
            //                id = id.toString();
            //                //                var plusone_obj = document.getElementsByClassName('plusone-like')[i];
            //                plusone_obj.className = " plusone-like";
            //
            //
            //            }



            $scope.updateDislikes = function(likeCount, dislikeCount, id){

                var url = "/db/update_drugs.php";
                var likes = parseInt(likeCount, 10);
                var dislikes = parseInt(dislikeCount, 10);
                var id = parseInt(id, 10);
                dislikes = dislikes + 1;
                dislikes = dislikes.toString();
                likes = likes.toString();

                var i = id - 1;
                var tempHintDislikes = parseInt($scope.names[i].HintDislikes, 10);
                $scope.names[i].HintDislikes = tempHintDislikes + 1;

                id = id.toString();

                var data = $.param({
                    likes: likes,
                    dislikes: dislikes,
                    drugid: id
                });
                var config = {
                    headers : {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                };
                $http.post(url, data, config)
                    .then(function (response) {
                    console.log(response);
                    //console.log(response);
                    //$scope.names = response.data.records;
                    $scope.response = response;
                    //console.log($scope.names);
                    //alert($scope.names);
                }); 

                var tempString = "plusone-dislike d" + id;
                $scope.plusone_obj = document.getElementsByClassName(tempString)[0];
                //                $scope.plusone_obj = document.querySelectorAll(tempString);
                $scope.plusone_obj.className += " plusone-animate";

                //                $timeout($scope.removeAnimateLike(id), 5000);

                //                $scope.id = id;
                setTimeout(function(){
                    var i = id;
                    //                    id = id.toString();
                    var tempString2 = "plusone-dislike d" + i + " plusone-animate";
                    $scope.plusone_obj = document.getElementsByClassName(tempString2)[0];
                    //                  $scope.plusone_obj = document.querySelectorAll(tempString2)
                    $scope.plusone_obj.className = "plusone-dislike d" + i;

                }, 500);

            }


        }]);




    </script>


    <div ng-app="myApp" ng-controller="customersCtrl">
        <!--

<audio id="myAudio">
<source src="/mvc/public/audio/Abilify.wav" type="audio/wav">
</audio>    
-->




        <!--
<div id="app_header">
<button class=back-btn ng-click="home()">Back</button>
<h1>Database
</h1>


<button ng-model="showSearch" ng-click="showSearch=!showSearch" class=search-btn><img src="/mvc/public/images/searchicon_white.png"></button>
</div>
-->

        <div id=app_header>
            <a ng-click="home()"><button class = 'back'>Back</button></a>

            <a ng-click = 'home()'><img id="toplogo" src="/mvc/public/images/logo_without_words_version_1.png"></a>

             <div onclick="toggleMenuNav()" class=menu-info><img src=/mvc/public/images/man-user.png></div>
        <div id='menu-popup' class='menu-popup'>
            <div class=notif-info>
                <h2>Notifications</h2>
                <p>There are no notifications at this moment.</p>
            </div>
            <div class=user-info>
                <img src="/mvc/public/images/user_icon.png">
                <div class=username-info>{{capsules[0].username}}</div>
                <div class=email-info>({{capsules[0].email}})</div>
                <div class=capsule-info>{{capsules[0].capsules}} Capsules</div>
            </div>
        </div>

        </div>

            <div class="search-bar-wrapper">
                    <input class="search-bar" type=text ng-model=searchText[queryBy]>
                    <div class="search-by-wrapper">
                        <select class="search-by-drop-down" ng-model="queryBy">
                            <option selected disabled value="$">Search By</option>
                            <option value="$">All</option>
                            <option value="Generic">Generic</option>
                            <option value="Brand">Brand</option>
                        </select>  
                    </div>
                </div>

        <div id="content_wrapper">

            <div class="loadingDiv" ng-show="loading">
                <p class="loadingText">LOADING...</p>
                <img class="loadingGif" src="/mvc/public/images/loading.gif">

            </div>

<!--            <div ng-show="showSearch">-->
            

<!--
                <div class="search-by-bar">
                    <input type="radio" name="All" ng-model="queryBy" value="$"> <label>All</label>
                    <input type="radio" name="Generic" ng-model="queryBy" value="generic">
                    <label>Generic</label>

                    <input type="radio" name="Brand" ng-model="queryBy" value="brand"> 
                    <label>Brand</label>
                </div>
-->
<!--            </div>-->
            <div class="drug-block" ng-model="collapsed" ng-click="collapsed=!collapsed" ng-repeat="x in names | filter:searchText" ng-controller='showCtrl'>
                <div class=drug-content>
                    <div class="visible-info">
                        <div class="drug-generic">
                            {{x.Generic}}
                            <audio id="{{'myAudio-' + x['Generic']}}">
                                <source src="{{x['Generic Audio'] | trustUrl}}" type="audio/wav">
                            </audio>


                            <div class=speaker-icon-wrapper><button ng-click="playAudio(x.Generic);$event.stopPropagation()" href=#><img src="/mvc/public/images/speaker.svg"></button></div>

                        </div>


                        <div class="hint-info"><button ng-click='toggleModal();$event.stopPropagation()'>Hint</button>
                            <div class="button-shadow"></div></div>        
                        <modal-dialog ng-click='$event.stopPropagation()' show='modalShown' width='90vw'>
                            <!--                                <div class=ng-modal-content-head>Moniko's Hint</div>-->
                            <div class=hint-message>
                                <div ng-bind-html="trustAsHtml(x.Mnemonic)"></div>
                            </div>
                            <!--                            <div class=like-count>({{x.HintLikes}} Likes, {{x.HintDislikes}} Dislikes)</div>-->
                            <!--                            <div class="sub-message">Do you have a better hint? <a href=mnemonics-form.php>Earn 200 Capsules</a></div>-->
                            <div class=ng-modal-content-footer>
                                <div class=plusone-wrapper>
                                    <div class="plusone-like d{{x.DrugId}}">+1</div>
                                    <div class="plusone-dislike d{{x.DrugId}}">+1</div>

                                </div>
                                <div class=btn-wrapper>
                                    <button ng-click="updateLikes(x.HintLikes, x.HintDislikes, x.DrugId)" class=like-btn><img src=/mvc/public/images/thumb-up-button.png> Like</button> <button ng-click="updateDislikes(x.HintLikes, x.HintDislikes, x.DrugId)" class=dislike-btn><img src=/mvc/public/images/thumb-down-button.png>Dislike</button>
                                </div>
                                <div class=btn-shadow-wrapper>
                                    <div class=like-btn-shadow></div> <div class=dislike-btn-shadow></div>
                                </div>
                                <div class=likes-dislikes-wrapper>
                                    <div class=likes-count>{{x.HintLikes}}</div>
                                    <div class=dislikes-count>{{x.HintDislikes}}</div>
                                </div>
                            </div>
                            <div ng-controller="showCtrl2" class=ng-modal-content-footer-bar>
                                Do you have a better hint? <a class="earn200link" ng-click=toggleModal2()>Earn 200 Capsules</a>

                                <modal-dialog-two ng-click='$event.stopPropagation()' show='modalShown2' width='90vw'>




                                    <form method="post" action="../../../db/email_hint.php" id="mnemonic-form">
                                        <label>Name:</label><input name='name' type="text">
                                        <label>Drug:                           </label>
                                        <select class=drug-form-list name='drug'>
                                            <option ng-repeat="x in names">{{x.Generic}}</option>

                                        </select>
                                        <label>Mnemonic:</label>
                                        <textarea name='mnemonic' placeholder="Example"></textarea>

                                        <input type="submit" name="submit" id='submit' value="Submit">
                                        <div class="submit-shadow"></div>
                                    </form>




                                </modal-dialog-two>

                            </div>







                        </modal-dialog>
                    </div>
                    <div class="expand-info" ng-show="collapsed">
                        <audio id="{{'myAudio-' + x['Brand']}}">
                            <source src="{{x['Brand Audio'] | trustUrl}}" type="audio/wav">
                        </audio>

                        <div class="drug-info-wrap"><label>Brand:</label> {{x.Brand}}<div  ng-click='$event.stopPropagation()' class=speaker-icon-wrapper><button ng-click="playAudio(x.Brand);$event.stopPropagation()" href=#><img src="/mvc/public/images/speaker.svg"></button></div></div>
                        <div class="drug-info-wrap"><label>Class:</label> {{x.Class}}</div>
                        <div class="drug-info-wrap"><label>Indication:</label> {{x.Indication}}</div>
                        <!--                        <div class="drug-info-wrap"><label>Side Effects:</label>{{ x['Side Effects'] }}</div>-->

                        <div class="drug-info-wrap"><label>Black Box Warning:</label> {{ x['Black Box Warning'] }}</div>

                        <!--
<div class="drug-info-wrap"><label>Hint Likes:</label> {{x.HintLikes}}</div>
<div class="drug-info-wrap"><label>Hint Dislikes:</label> {{x.HintDislikes}}</div>
-->
                    </div>
                </div>
            </div>
        </div>

        <!--
<table id="searchTextResults">
<tr ng-repeat="x in names | filter:searchText">
<td>Generic: {{ x.Generic }}</td>
<td>Brand: {{ x.Brand }}</td>
<td>Class: {{ x.Class }}</td>
<td>Indication: {{ x.Indication }}</td>
<td>HintLikes: {{ x.HintLikes }}</td>
<td>HintDislikes: {{ x.HintDislikes }}</td>
</tr>
</table>
-->

    </div>



</body>