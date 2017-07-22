//Created by Dana Elhertani Monikos LLC

var app = angular.module('myApp', []);
app.controller('flashCtrl', function($scope, $http) {
  var nextIndex;
  $scope.select = [];
  $scope.names = [];
  $scope.finalList = [];
  $scope.front = "";
  $scope.back = "";
  $scope.percent;
  var index = 1;
  var tempFront = "";
  var tempBack = "";
  var list = "<ul>"; //for jsonParser
  var counter = 0;

  //dcedits
  $scope.firstLoad = true;

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
  $scope.getlid = function(thelid, schoolrequest) {

      var config = {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
      };
      var data = $.param({
        lid: thelid
      });

      var listurl = "";
      if (!schoolrequest) {
        listurl = "/db/get_specific_list.php";
      } else {
        listurl = "/db/get_specific_school_list.php";
      }
      $http.post(listurl, data, config)
        .then(function(response) {
          if (response.data.drugnames == undefined) {
            $scope.getlid(thelid, true);
            if (schoolrequest) {
              $scope.firstLoad = false;
              alert("We could not load your list");
              return -1;
            }
          } else {

            $scope.select = response.data.drugnames.split(",");
            console.log("we are about to print select");
            console.log($scope.select);
            $scope.percent = index + "/" + $scope.select.length;
            $scope.percentSign = Math.ceil((index / $scope.select.length) *
              100) + "%";
            document.getElementById("pb").style.width = $scope.percentSign;
            console.log($scope.percentSign);
            $scope.getallTheDrugs();
          }
        });
      $scope.firstLoad = false;



    }
    //end dcedits

  $scope.home = function() {
    window.location = window.location.origin + "/mvc/public/home/";
  }


  $(document).ready(function() {
    $('.flashcard').on('click', function() {
      $('.flashcard').toggleClass('flipped');
    });
  });


  $scope.premiumCheck=function(){
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
              var premium=response.data.records[0]["premium"];
          if(!premium){
              $("#payment").show();
              $("#toplogo").attr("src","/mvc/public/images/litelogo.png");
          }

          else{
              $("#payment").hide();
          }   
          });
  }
  $scope.premiumCheck();
  $scope.payment = function() {
    //create list manager controller
    window.location = window.location.origin +
      "/mvc/public/home/pricing";
  }
  $scope.getallTheDrugs = function() {



    var url = "/db/get_drugs.php";
    $http.get(url)
      .then(function(response) {
        $scope.names = response;
        $scope.allDrugs = response.data.records;
        for (d = 0; d < $scope.select.length; d++) {
          for (var x = 0; x < $scope.allDrugs.length; x++) {
            if ($scope.allDrugs[x].Generic == $scope.select[d]) {
              var a = $scope.allDrugs[x];
              $scope.finalList.push($scope.allDrugs[x]);
            }
          }
        }

        $scope.names = $scope.finalList;
        console.log($scope.names);

        nextCard = function() {
          if (index < $scope.select.length) {
            index++;

            jsonParser($scope.finalList[index - 1]["Indication"]); //indication json->li
            var indicationList = list + "</ul>";
            list = "<ul>";
            counter = 0; //reset list and counter
            jsonParser($scope.finalList[index - 1]["Side Effects"]);
            var sideList = list + "</ul>";
            console.log(list);
            list = "<ul>";
            counter = 0; //reset list and counter


            document.getElementById("brand_b").innerHTML = $scope.finalList[
              index - 1]["Brand"];
            document.getElementById("generic_b").innerHTML = $scope.finalList[
              index - 1]["Generic"];
            document.getElementById("class_b").innerHTML = $scope.finalList[
              index - 1]["Class"];
            document.getElementById("indication_b").innerHTML =
              indicationList;
            document.getElementById("renal_b").innerHTML = $scope.finalList[
              index - 1]["Renal Adjustment"];
            document.getElementById("hepatic_b").innerHTML = $scope.finalList[
              index - 1]["Hepatic Adjustment"];
            document.getElementById("moa_b").innerHTML = $scope.finalList[
              index - 1]["Mechanism of Action"]
            document.getElementById("bbw_b").innerHTML = $scope.finalList[
              index - 1]["Black Box Warning"];
            document.getElementById("sideEffect_b").innerHTML =
              sideList;

            $scope.percent = index + "/" + $scope.select.length;
            $scope.percentSign = Math.ceil((index / $scope.select.length) *
              100) + "%";
            document.getElementById("pb").style.width = $scope.percentSign;
            console.log($scope.percentSign);

            document.getElementById("percentpb").innerHTML = $scope.percent;
          }
        }

        redo = function() {
          index = 1;
          tempBack = "";
          tempFront = "";
          $scope.percent = index + "/" + $scope.select.length;
          $scope.percentSign = Math.ceil((index / $scope.select.length) *
            100) + "%";

          document.getElementById("pb").style.width = $scope.percentSign;
          document.getElementById("percentpb").innerHTML = $scope.percent;
          if (document.getElementById('fBrand').checked) {
            tempFront += "Brand: " + $scope.finalList[index - 1].Brand +
              "<br />"
          }
          if (document.getElementById('fGeneric').checked) {
            tempFront += "Generic: " + $scope.finalList[index - 1].Generic +
              "<br />"

          }
          if (document.getElementById('fClass').checked) {
            tempFront += "Class: " + $scope.finalList[index - 1].Class +
              "<br />"
          }
          if (document.getElementById('fBlackBoxWarning').checked) {
            tempFront += "BBW: " + $scope.finalList[index - 1].BlackBoxWarning +
              "<br />"
          }
          if (document.getElementById('fIndication').checked) {
            tempFront += "Indication: " + $scope.finalList[index - 1]
              .Indication + "<br />"
          }

          if (document.getElementById('bBrand').checked) {
            tempBack += "Brand: " + $scope.finalList[index - 1].Brand +
              "<br />"
          }
          if (document.getElementById('bGeneric').checked) {
            tempBack += "Generic: " + $scope.finalList[index - 1].Generic +
              "<br />"

          }
          if (document.getElementById('bClass').checked) {
            tempBack += "Class: " + $scope.finalList[index - 1].Class +
              "<br />"
          }
          if (document.getElementById('bBlackBoxWarning').checked) {
            tempBack += "BBW: " + $scope.finalList[index - 1].BlackBoxWarning +
              "<br />"
          }
          if (document.getElementById('bIndication').checked) {
            tempBack += "Indication: " + $scope.finalList[index - 1].Indication +
              "<br />"
          }

          document.getElementById("front").innerHTML = tempFront;
          document.getElementById("back").innerHTML = tempBack;

          document.getElementById("toggle").click();

        }

        prevCard = function() {
          if (index > 1) {
            index--;


            jsonParser($scope.finalList[index - 1]["Indication"]); //indication json->li
            var indicationList = list + "</ul>";
            list = "<ul>";
            counter = 0; //reset list and counter
            jsonParser($scope.finalList[index - 1]["Side Effects"]);
            var sideList = list + "</ul>";
            console.log(list);
            list = "<ul>";
            counter = 0; //reset list and counter


            document.getElementById("brand_b").innerHTML = $scope.finalList[
              index - 1]["Brand"];
            document.getElementById("generic_b").innerHTML = $scope.finalList[
              index - 1]["Generic"];
            document.getElementById("class_b").innerHTML = $scope.finalList[
              index - 1]["Class"];
            document.getElementById("indication_b").innerHTML =
              indicationList;
            document.getElementById("renal_b").innerHTML = $scope.finalList[
              index - 1]["Renal Adjustment"];
            document.getElementById("hepatic_b").innerHTML = $scope.finalList[
              index - 1]["Hepatic Adjustment"];
            document.getElementById("moa_b").innerHTML = $scope.finalList[
              index - 1]["Mechanism of Action"]
            document.getElementById("bbw_b").innerHTML = $scope.finalList[
              index - 1]["Black Box Warning"];
            document.getElementById("sideEffect_b").innerHTML =
              sideList;



            $scope.percent = index + "/" + $scope.select.length;
            $scope.percentSign = Math.ceil((index / $scope.select.length) *
              100) + "%";
            document.getElementById("pb").style.width = $scope.percentSign;
            console.log($scope.percentSign);
            document.getElementById("percentpb").innerHTML = $scope.percent;


          }
        }

        //iterator for finalist
        function makeIterator(array) {
          return {
            next: function() {
              return nextIndex < array.length ? {
                value: array[nextIndex++],
                done: false
              } : {
                done: true
              };
            }
          }
        }



        function jsonParser(input) { //parse json to list element
          for (var key in input) {
            list += "<li class='item'>";
            if (input[key] instanceof Object) {
              list += key + "</li><ul class='item2'>";
              counter++;
              jsonParser(input[key], list, counter);
            } else if (input[key] == false) {
              list += key + "</li>";
            } else {
              list += input[key] + "</li>";
            }
          }
          for (var i = 0; i < counter; i++) {
            list += "</ul>";
            counter--;
          }
        }

        var it = makeIterator($scope.finalList);
        var card = it.next().value;

        // var test={"adult":{"1st":["123","345"],"2nd":["345","234"]},"child":{"diyi":["hshs","sldaf"],"dier":["3asf45","23df4"]}};

        // jsonParser(test);

        jsonParser($scope.finalList[index - 1]["Indication"]); //indication json->li
        var indicationList = list + "</ul>";
        list = "<ul>";
        counter = 0; //reset list and counter
        jsonParser($scope.finalList[index - 1]["Side Effects"]);
        var sideList = list + "</ul>";
        list = "<ul>";
        counter = 0; //reset list and counter
        jsonParser($scope.finalList[index - 1]["Renal Adjustment"]);
        var renalList = list + "</ul>";
        list = "<ul>";
        counter = 0;


        document.getElementById("brand_b").innerHTML = $scope.finalList[
          index - 1]["Brand"];
        document.getElementById("generic_b").innerHTML = $scope.finalList[
          index - 1]["Generic"];
        document.getElementById("class_b").innerHTML = $scope.finalList[
          index - 1]["Class"];
        document.getElementById("indication_b").innerHTML =
          indicationList;
        document.getElementById("renal_b").innerHTML = renalList;
        document.getElementById("hepatic_b").innerHTML = $scope.finalList[
          index - 1]["Hepatic Adjustment"];
        document.getElementById("moa_b").innerHTML = $scope.finalList[
          index - 1]["Mechanism of Action"]
        document.getElementById("bbw_b").innerHTML = $scope.finalList[
          index - 1]["Black Box Warning"];
        document.getElementById("sideEffect_b").innerHTML = sideList;


      });

  }


});
