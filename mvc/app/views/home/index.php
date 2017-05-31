

<!-- <link rel="stylesheet" type="text/css" href="/mvc/public/css/home_style.css"/> -->

<body id="home_page">

	<script src = '/mvc/public/js/home/homeCtrl.js'></script>

	<!-- <div ng-app="databaseApp" ng-controller="databaseCtrl"> -->
	<!-- </div> -->

    <div id=app_content ng-app="myApp" ng-controller="homeCtrl">
			<div id=app_header>
					<a ng-click="indextest()"><button class = 'back'>Home</button></a>
					<a ng-click="drugDatabase()"><button class = 'database'>Database</button></a>
					<a ng-click="listManager()"><button class = 'study'>Study</button></a>
					<a ng-click = 'home()'><img id="toplogo" src="/mvc/public/images/logo_without_words_version_1.png"></a>

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
											<a href="#" onclick="logout()"><div class=logout-btn>logout</div></a>
									</div>
							</div>
					</div>
			</div>


			<div class="flex-container">
				<div ng-click="drugDatabase()" class="flex-item">
					<img class="flex-image" src="/mvc/public/images/study.png" width="130px" height="140px">
					<br>DATABSE<br>
					<p class="intro-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer elementum in sem id congue. Sed vehicula eros</p>
				</div>

				<div ng-click="listManager()" class="flex-item">
					<img class="flex-image" src="/mvc/public/images/study.png" width="130px" height="140px">
					<br>STUDY<br>
					<p class="intro-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer elementum in sem id congue. Sed vehicula eros</p>
				</div>

				<div ng-click="social()" class="flex-item">
					<img class="flex-image" src="/mvc/public/images/study.png" width="130px" height="140px">
					<br>SOCIAL<br>
					<p class="intro-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer elementum in sem id congue. Sed vehicula eros</p>
				</div>

			</div>

			<!-- <a href="#" ng-click="drugDatabase()">
				<div class="top-block">
					<div class="database-block">DATA<br/><br/>BASE</div>
				</div>
			</a>
			<a href="#" ng-click="listManager()">
				<div class="bottom-block">
					<div class=study-block> STUDY </div>
				</div>
			</a>

		<a href="#"  onclick="logout()">
			<div class=logout-block>
				<div class ='logout'>LOGOUT</div>
			</div>
		</a> -->
		<footer>
			<a href="#" onclick="logout()"> Log Out</a>
		</footer>

    </div>
</body>
