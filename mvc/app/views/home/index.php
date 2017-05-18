<!-- Created by Jenny Zhang, Danila Chenchik Monikos LLC -->

<link rel="stylesheet" type="text/css" href="/mvc/public/css/home_style.css"/>

<body id="home_page">

	<script src = '/mvc/public/js/home/homeCtrl.js'></script>

    <div id=app_content ng-app="myApp" ng-controller="homeCtrl">
			<a href="#" ng-click="drugDatabase()"> <div class="top-block">
				<div class="database-block">DATA<br>BASE
    </div> </div> </a> <a href="#" ng-click="listManager()"> <div
    class="bottom-block"> <div class=study-block> STUDY </div> </div> </a>

		<a href="#"  onclick="logout()"> <div class=logout-block> <div class =
		'logout'>LOGOUT</div> </div> </a>

    </div> 
</body>
