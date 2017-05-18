//Nik Gunawan, Danusha Chenchick

var app = angular.module('databaseApp', ['ngAnimate']);

//filter to validate audio file path
app.filter("trustUrl", ['$sce', function ($sce) {
    return function (recordingUrl) {
        return $sce.trustAsResourceUrl(recordingUrl);
    };
}]);

app.controller('databaseCtrl', ['$scope','$sce', '$http', '$timeout', function($scope, $sce, $http, $timeout) {

    //go to challenge from header popup
    function gotoChallenge(url){
        window.location = url;
    }

    //get browser cookie: to get user_id
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
    
    //get notif info in header
    $scope.getNotifications = function(){
        var username = getCookie('username');
        var data = $.param({user : username});
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

    //hint popup controls
    $scope.showPopup = function(x) {
        var y = x.toString();
        var temp_name = "show-" + y;
        document.getElementsByClassName(temp_name)[0].style.visibility = "visible";
    }

    $scope.hidePopup = function(x) {
        var y = x.toString();
        var temp_name = "show-" + y;
        document.getElementsByClassName(temp_name)[0].style.visibility = "hidden";
    }
    
    //mnemonic suggestion popup controls
    $scope.showPopup2 = function() {
        var temp_obj = document.getElementsByClassName("show2")[0];
        temp_obj.style.visibility = "visible";
    }
    $scope.hidePopup2 = function() {
        document.getElementsByClassName("show2")[0].style.visibility = "hidden";
    }

    //getting user profile info for header popup
    var id_cookie = getCookie("user_id");
    console.log(id_cookie);
    var data = $.param({id : id_cookie });
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
   
    }); 
    
    
    $scope.queryBy = '$'; //sets queryBy for search bar
    $scope.trustAsHtml = $sce.trustAsHtml; //put trustashtml in scope for mnemonic hint
    
    //get drug list
    var url = "/db/get_drugs.php";
    $scope.loading = true; //loading animation
    $http.get(url)
        .then(function (response) {
        console.log(response);
        $('#cssload-pgloading').css({'opacity':'0.0'});
        $(".dark-load").css({'opacity':'0.0'})
        $scope.loading = false;
        $scope.names = response.data.records;
        console.log($scope.names);
        
    });


    //header home button
    $scope.home = function(){
        //create new database controller
        window.location = window.location.origin + "/mvc/public/home";
    }


    //audio controls
    $scope.playAudio = function(myAudio) {
        var myAudio = 'myAudio-' + myAudio;
        var x = document.getElementById(myAudio);
        x.play();
    }
    $scope.pauseAudio = function(myAudio) {
        var x = document.getElementById(myAudio);
        x.pause(myAudio);
    }
    

    $scope.updateLikes = function(likeCount, id){        
        //plus one animation
        $('.plusone-like').fadeIn(400).fadeOut(400);
        
        var url = "/db/update_drug_likes.php";
        
        var likes = parseInt(likeCount, 10);
        likes = likes + 1;
        likes = likes.toString();
        
        //id is index of drug in get_drugs json: also drugid
        //update like count in view
        var id = parseInt(id, 10);
        var i = id - 1; //because need index in array counting that starts with 0
        var tempHintLikes = parseInt($scope.names[i].HintLikes, 10);
        $scope.names[i].HintLikes = tempHintLikes + 1;
        id = id.toString();

        var data = $.param({
            likes: likes,
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
            $scope.response = response;

        }); 
        
    }


    $scope.updateDislikes = function(dislikeCount, id){
        //plus one animation
        $('.plusone-dislike').fadeIn(400).fadeOut(400);

        var url = "/db/update_drug_dislikes.php";
        
        var dislikes = parseInt(dislikeCount, 10);
        dislikes = dislikes + 1;
        dislikes = dislikes.toString();

        //id is index of drug in get_drugs json: also drugid
        //update like count in view
        var id = parseInt(id, 10);
        var i = id - 1; //because need index in array counting that starts with 0
        var tempHintDislikes = parseInt($scope.names[i].HintDislikes, 10);
        $scope.names[i].HintDislikes = tempHintDislikes + 1;
        id = id.toString();

        var data = $.param({
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
            $scope.response = response;
        }); 


    }


}]);