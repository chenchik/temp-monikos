var app = angular.module('myApp', ['checklist-model']);

app.controller('myCtrl', function($scope, $http) {

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
    var data = $.param({id : id_cookie});
    var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}};

    var url = "/db/get_user_profile.php";
    $http.post(url, data, config).then(function (response) {
        console.log(response);$scope.capsules = response.data.records;
    }); 

    $scope.getSchoolLists = function(){
        var url_getschools = "/db/get_schools_list.php";
    //    $http.post(url_getschools, data, config).then(function (response) {
    //        console.log(response);$scope.school_list = response.data.records;
    //    }); 
        
        $scope.school_listId = [];
        $scope.school_lists = [];
        $http.post(url_getschools, data, config)
            .then(function (response) {
            console.log(response); 

            $scope.school_listId = response.data.records;

            if(response.data.records.length < 1){
                $(".list-collection-block").append('<p id="noListsMessage">This school does not have any lists.</p>');
            }else{
                for(var i in response.data.records){
                    $scope.school_lists.push({
                        name: response.data.records[i].list_name.toString(),
                        drugs: response.data.records[i].drugnames.toString().split(",")
                    });
                }
            }

        });
    }

    $scope.getSchoolLists();



    //end NIk's edits


    $scope.listId = [];
    $scope.passedId = undefined;

    $scope.lists = [];

    $scope.getCookie = function(cname) {
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

    //var url = "http://monikos.xpyapvzutk.us-east-1.elasticbeanstalk.com/sql_result.php";
    var url = "/db/get_drugs.php";
    $http.get(url)
        .then(function (response) {
        console.log(response);
        //console.log(response);
        $scope.drugs = response.data.records;
        //console.log($scope.names);
        //alert($scope.names);
    });

    //var getListsUrl = "http://monikos.xpyapvzutk.us-east-1.elasticbeanstalk.com/get_lists.php";
    var getListsUrl = "/db/get_lists.php";
    var getListsConfig = {
        headers : {
            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
    };


    var getListsData = $.param({
        user_id: $scope.getCookie("user_id")
    });

    $http.post(getListsUrl, getListsData, getListsConfig)
        .then(function (response) {
        console.log(response); 

        $scope.listId = response.data.records

        if(response.data.records.length < 1){
            $(".custom-list-collection-block").append('<p id="noListsMessage">Please create a list</p>');
        }else{
            for(var i in response.data.records){
                $scope.lists.push({
                    name: response.data.records[i].list_name.toString(),
                    drugs: response.data.records[i].drugnames.toString().split(",")
                });
            }
        }
        //$scope.drugs = response.data.records;
        //console.log($scope.names);
        //alert($scope.names);
    });







    /*$scope.tempdrugs = [{Brand: "tylenol",
                        Generic: "tylenolgeneric"},
                       {Brand: "advil",
                        Generic: "advilgeneric"}];
    */
    $scope.listform = {name: "",
                       drugs: []};


    $scope.addList = function() {
        console.log($scope.listform);
        $scope.lists.push($scope.listform);


        var createListUrl = "http://monikos.xpyapvzutk.us-east-1.elasticbeanstalk.com/create_list.php";
        var createListUrl = "/db/create_list.php";
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };


        var listData = $.param({
            name: $scope.listform.name,
            drugs: $scope.listform.drugs,
            user_id: $scope.getCookie("user_id")
        });


        $scope.listform.drugs;
        $http.post(createListUrl, listData, config)
            .then(function (response) {
            console.log(response);

            //console.log(response);
            //$scope.names = response.data.records;
            //$scope.response = response;
            if(response.data[0].response == 200){
                //    window.location = window.location.origin + "/mvc/public/account/login";
                $("#noListsMessage").remove();
            }
            //    alert("error in creating account");
            //}
            //console.log($scope.names);
            //alert($scope.names);
        });

        $scope.listform = {name: "",
                           drugs: []};
        closeNav();
        window.location.reload(); 
    }

    $scope.home = function(){
        window.location = window.location.origin + "/mvc/public/home/";
    }

    $scope.launchGame = function(){
        if($scope.passedId != undefined){  
            window.location = window.location.origin + "/mvc/public/games/menu/" + $scope.passedId;
        }else{
            $('#errorMessage').slideDown();
        }

    }

    $scope.listManager = function(){
        window.location = window.location.origin + "/mvc/public/home/listManager/";
    }

    /***SELECT LIST ID*********/

    $scope.list_block = "list-block";

    $scope.selectList = function(index, thisElem){
        $scope.passedId = $scope.listId[index]['list_id'];
        console.log($scope.passedId);
    }
    
    $scope.selectSchoolList = function(index, thisElem){
        $scope.passedId = $scope.school_listId[index]['list_id'];
        console.log($scope.passedId);
    }

    $scope.deleteList = function(index){
        $scope.passedId = $scope.listId[index]['list_id'];

        var url = "/db/delete_list.php";

        var data = $.param({
            lid: $scope.passedId
        });

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $http.post(url, data, config)
            .then(function (response) {
            console.log(response);
            $scope.passedId = undefined;
        }); 
    }

});

$( document ).ready(function() {
    $('.list-collection-block').on('click', '.list_block .selectList',function(){
        var parent = $(this).parent();
        if(!parent.hasClass('red')){
            parent.addClass('red');
            $(this).siblings('.list-info-block').children().addClass('whiteTextClass');     
        }else{
            parent.removeClass('red');
            $(this).siblings().removeClass('whiteTextClass');
        }
    });

    $('#addListButton').on('click', function(){
        $('.list-collection-block').addClass('list-collection-block-short');
    });

    $('.list-collection-block').on('click', '.list_block .deleteList',function(){
        $(this).parent().remove();
    });

    $('#errorButton').on('click', function(){
        $('#errorMessage').slideUp();   
    });

    function removePopup(){
        $('#errorMessage').slideUp();
    }
});
