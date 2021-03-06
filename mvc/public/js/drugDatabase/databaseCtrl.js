//Nik Gunawan, Danusha Chenchick

var app = angular.module('databaseApp', ['ngAnimate']);

function logout() {
    $.get("../../../../db/logout.php", function (data, status) {
        console.log(data);
    });

    window.location = window.location.origin = "/mvc/public/landing.html";
}
//filter to validate audio file path
app.filter("trustUrl", ['$sce', function ($sce) {
    return function (recordingUrl) {
        return $sce.trustAsResourceUrl(recordingUrl);
    };
}]);

app.controller('databaseCtrl', ['$scope', '$sce', '$http', '$timeout', function (
    $scope, $sce, $http, $timeout) {
    $scope.printCookie = function (cookie) {
        var x = getCookie(cookie);
        return x;
    }
    $scope.goOneMoreLevelDown = function (theString) {

        //is theString is a plain object ? if yes return true : other return false
        return ($.isPlainObject(theString)) ? true : false;
    }
    $scope.isCollapsed = true;
    //go to challenge from header popup
    function gotoChallenge(url) {
        window.location = url;
    }

    //get browser cookie: to get user_id
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

    //get notif info in header
    $scope.getNotifications = function () {
        var username = getCookie('username');
        var data = $.param({
            user: username
        });
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        var url = "/db/get_notifications.php";

        $http.post(url, data, config)
            .then(function (response) {
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
                            notif]['bet'] + ', who:' + response.data.records[
                            notif]['user1'];
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


    $scope.premiumCheck = function () {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        var username = getCookie('username');
        var url = "/db/get_profile_by_user.php";

        var data = $.param({
            un: username
        });
        $http.post(url, data, config)
            .then(function (response) {
                console.log(response);
                $scope.premium = response.data.records[0]["premium"];
                console.log($scope.premium);
                var premium = response.data.records[0]["premium"]; //only within scope
                if (premium) {
                    $("#payment").hide();
                    //get drug list
                    var url = "/db/get_drugs.php";
                    $scope.loading = true; //loading animation
                    $http.get(url)
                        .then(function (response) {
                            console.log(response);
                            $('#cssload-pgloading').css({
                                'opacity': '0.0'
                            });
                            $(".dark-load").css({
                                'opacity': '0.0'
                            })
                            $scope.pg1 = true;
                            $scope.loading = false;
                            $scope.names = response.data.records;
                            $scope.totalPages = $scope.names.length / 50;
                            $scope.pages = [];
                            for (var i = 0; i < $scope.totalPages; i++) {
                                $scope.pages[i] = i + 1;
                            }
                            console.log($scope.pages);
                            console.log($scope.names);
                        });
                } else {
                    $("#payment").show();
                    $("#toplogo").attr("src", "/mvc/public/images/litelogo.png");
                    //get drug list
                    var url = "/db/get_drugs_free.php";
                    $scope.loading = true; //loading animation
                    $http.get(url)
                        .then(function (response) {
                            console.log(response);
                            $('#cssload-pgloading').css({
                                'opacity': '0.0'
                            });
                            $(".dark-load").css({
                                'opacity': '0.0'
                            })
                            $scope.pg1 = true;
                            $scope.loading = false;
                            $scope.names = response.data.records;
                            $scope.totalPages = $scope.names.length / 50;
                            $scope.pages = [];
                            for (var i = 0; i < $scope.totalPages; i++) {
                                $scope.pages[i] = i + 1;
                            }
                            console.log($scope.pages);
                            console.log($scope.names);
                        });
                }
            });
    }
    $scope.premiumCheck();



    $scope.goToPage=function(page) {
        $('#pageNum-'+page).css('font-weight','bold');
        $("[id^='pageNum']:not(#pageNum-"+page+")").css('font-weight','normal');
  
        $('#bottom-pageNum-'+page).css('font-weight','bold');
        $("[id^='bottom-pageNum']:not(#bottom-pageNum-"+page+")").css('font-weight','normal');
        switch (page) {
            case 1:
                $scope.pg1 = true
                $scope.pg2 = false
                $scope.pg3 = false
                $scope.pg4 = false
                $scope.pg5 = false
                $scope.pg6= false
                $scope.pg7= false
                break;
            case 2:
                $scope.pg1 = false
                $scope.pg2 = true
                $scope.pg3 = false
                $scope.pg4 = false
                $scope.pg5 = false
                $scope.pg6= false
                $scope.pg7= false
                break;
            case 3:
                $scope.pg1 = false
                $scope.pg2 = false
                $scope.pg3 = true
                $scope.pg4 = false
                $scope.pg5 = false
                $scope.pg6= false
                $scope.pg7= false
                break;
            case 4:
                $scope.pg1 = false
                $scope.pg2 = false
                $scope.pg3 = false
                $scope.pg4 = true
                $scope.pg5 = false
                $scope.pg6= false
                $scope.pg7= false
                break;
            case 5:
                $scope.pg1 = false
                $scope.pg2 = false
                $scope.pg3 = false
                $scope.pg4 = false
                $scope.pg5 = true
                $scope.pg6= false
                $scope.pg7= false
                break;
            case 6:
                $scope.pg1 = false
                $scope.pg2 = false
                $scope.pg3 = false
                $scope.pg4 = false
                $scope.pg5 = false
                $scope.pg6= true
                $scope.pg7= false
                break;
            case 7:
                $scope.pg1 = false
                $scope.pg2 = false
                $scope.pg3 = false
                $scope.pg4 = false
                $scope.pg5 = false
                $scope.pg6= false
                $scope.pg7= true
                break;
        }
    }


    //hint and drug info popup controls
    $scope.showPopup = function (x) {
        var y = x.toString();
        var temp_name = "show-" + y;
        console.log(temp_name);
        var elem = document.getElementsByClassName(temp_name)[0];
        elem.style.visibility = "visible";

        var css = document.createElement("style");
        css.type = "text/css"
        css.innerHTML =
            ".ng-modal-dialog {-webkit-transform: scale(1); -moz-transform: scale(1); -ms-transform: scale(1); transform: scale(1); opacity: 1; }";
        document.body.appendChild(css);

        var csshint = document.createElement("style");
        csshint.type = "text/css"
        csshint.innerHTML =
            ".ng-modal-dialog-hint {-webkit-transform: scale(1); -moz-transform: scale(1); -ms-transform: scale(1); transform: scale(1); opacity: 1; }";
        document.body.appendChild(csshint);
    }

    $scope.hidePopup = function (x) {
        var y = x.toString();
        var temp_name = "show-" + y;
        document.getElementsByClassName(temp_name)[0].style.visibility =
            "hidden";

        var css = document.createElement("style");
        css.type = "text/css"
        css.innerHTML =
            ".ng-modal-dialog { -webkit-transform: scale(0.8); -moz-transform: scale(0.8);-ms-transform: scale(0.8);transform: scale(0.8);opacity: 0;-webkit-transition: all 0.3s;-moz-transition: all 0.3s;transition: all 0.3s;}";
        document.body.appendChild(css);

        var csshint = document.createElement("style");
        csshint.type = "text/css"
        csshint.innerHTML =
            ".ng-modal-dialog-hint { -webkit-transform: scale(0.8); -moz-transform: scale(0.8);-ms-transform: scale(0.8);transform: scale(0.8);opacity: 0;-webkit-transition: all 0.3s;-moz-transition: all 0.3s;transition: all 0.3s;}";
        document.body.appendChild(csshint);
    }

    //mnemonic suggestion popup controls
    $scope.showPopup2 = function () {
        var temp_obj = document.getElementsByClassName("show2")[0];
        temp_obj.style.visibility = "visible";
    }
    $scope.hidePopup2 = function () {
        document.getElementsByClassName("show2")[0].style.visibility =
            "hidden";
    }


    //getting user profile info for header popup
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
            console.log(response);
            $scope.capsules = response.data.records;

        });


    $scope.queryBy = '$'; //sets queryBy for search bar
    $scope.trustAsHtml = $sce.trustAsHtml; //put trustashtml in scope for mnemonic hint




    //header home button
    $scope.home = function () {
        //create new database controller
        window.location = window.location.origin + "/mvc/public/home";
    }
    $scope.study = function () {
        //create new database controller
        window.location = window.location.origin + "/mvc/public/home/listManager";
    }
    
    $scope.upgrade = function(){
        if($scope.premium == false){
        window.location = window.location.origin + "/mvc/public/home/pricing";
        }
    }

    //audio controls
    $scope.playAudio = function (myAudio) {
        var myAudio = 'myAudio-' + myAudio;
        var x = document.getElementById(myAudio);
        x.play();
    }
    $scope.pauseAudio = function (myAudio) {
        var x = document.getElementById(myAudio);
        x.pause(myAudio);
    }


    $scope.updateLikes = function (likeCount, id) {
        //plus one animation
        $('.plusone-like').fadeIn(400).fadeOut(400);

        var url = "/db/update_drug_likes.php";

        var likes = parseInt(likeCount, 10);
        likes = likes + 1;
        likes = likes.toString();

        id = id.toString();

        var key;
        for (i = 0; i < $scope.names.length; i++) {
            if ($scope.names[i].DrugId == id) {
                key = i;
            }
        }
        $scope.names[key].Likes = likes;

        var data = $.param({
            likes: likes,
            drugid: id
        });
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };


        $http.post(url, data, config)
            .then(function (response) {
                console.log(response);
                $scope.response = response;

            });

    }


    $scope.updateDislikes = function (dislikeCount, id) {
        //plus one animation
        $('.plusone-dislike').fadeIn(400).fadeOut(400);
        var url = "/db/update_drug_dislikes.php";

        var dislikes = parseInt(dislikeCount, 10);
        dislikes = dislikes + 1;
        dislikes = dislikes.toString();

        id = id.toString();

        var key;
        for (i = 0; i < $scope.names.length; i++) {
            if ($scope.names[i].DrugId == id) {
                key = i;
            }
        }

        $scope.names[key].Dislikes = dislikes;

        var data = $.param({
            dislikes: dislikes,
            drugid: id
        });
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };



        $http.post(url, data, config)
            .then(function (response) {
                console.log(response);
                $scope.response = response;
            });

    }


}]);
