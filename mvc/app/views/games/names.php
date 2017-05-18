<!-- Created by Dana Elhertani Monikos LLC -->

<link rel="stylesheet" type="text/css" href="/mvc/public/css/names.css">

<body>
    <script>

        var app = angular.module('myApp', []);
        app.controller('customersCtrl', function($scope, $http) {
        
        
            //var url = "http://monikos.xpyapvzutk.us-east-1.elasticbeanstalk.com/sql_result.php";
            var url = "/db/get_drugs.php";
            $http.get(url)
            .then(function (response) {
                console.log(response);
                //console.log(response);
                $scope.names = response.data.records.slice(1,10);
                console.log($scope.names);
                //alert($scope.names);
                
            var objects = [];
        	for (var i = 0; i < $scope.names.length*2; i++){
        		if (i < $scope.names.length){
        		    objects[i] = {drug: $scope.names[i], front: $scope.names[i].Generic, clicked: 'N'};
        		}
        		else if (i >= $scope.names.length){
        		    objects[i] = {drug: $scope.names[i - $scope.names.length], front: $scope.names[i - $scope.names.length].Brand, clicked:'N'};
        		}
       		 }

       		 		console.log("length of names - " + $scope.names.length);
       		 		console.log("length of objects- " + objects.length);

  					console.log(objects);


					var shuffledObjects = objects.slice();
					
					    var j, x, i;
    					for (i = shuffledObjects.length; i; i--) {
      					  j = Math.floor(Math.random() * i);
       					  x = shuffledObjects[i - 1];
       					  shuffledObjects[i - 1] = shuffledObjects[j];
        				  shuffledObjects[j] = x;
   					 }
  					
  					console.log("length of shuffled objects----- " + shuffledObjects.length);
  					console.log(shuffledObjects);

					$scope.names = shuffledObjects;
      		

        $('button.toggler').on("click",function(){  
  //$('button').not(this).removeClass();
  $(this).toggleClass('active');
  
  });
  
              $scope.clicked = function(drug){
                console.log("before " +drug.clicked);
                console.log("before " +drug.drug.Brand);

                for(var i = 0; i < shuffledObjects.length;i++){
                	if(drug.drug.Brand == shuffledObjects[i].drug.Brand){
                	if (shuffledObjects[i].clicked == "Y"){
                		shuffledObjects[i].clicked = "N";

                	} else{
                		shuffledObjects[i].clicked = "Y";
                		console.log("after " +shuffledObjects[i].clicked);
                		}
                	}
                }
            }

            });
            

        });
        
      



		
    </script>
    <h1>Matching Game
    <button ng-click="home()">Back To Home</button>
    </h1>
    
    <button class="toggler">hi</button>


    <div ng-app="myApp" ng-controller="customersCtrl">
    

        <span ng-repeat="(index, value) in names">
   			<button class="btnBlue" ng-click="clicked(value);"ng-style="{ 'background-color' : (value.clicked == 'Y') ? 'green' : '#550000' }"
 >{{value.front}}</button><br ng:show="(index+1)%3==0" />
   			 
		</span>




    </div>
</body>