<head>
  <meta charset="utf-8">
</head>
<body>
  <script src = '/mvc/public/js/home/homeCtrl.js'></script>
  <link rel="stylesheet" href="/mvc/public/css/pricing.css" media="screen" title="no title">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
  	<script>
  						$(document).ready(function() {
  						$('.popup-with-zoom-anim').magnificPopup({
  							type: 'inline',
  							fixedContentPos: false,
  							fixedBgPos: true,
  							overflowY: 'auto',
  							closeBtnInside: true,
  							preloader: false,
  							midClick: true,
  							removalDelay: 300,
  							mainClass: 'my-mfp-zoom-in'
  						});

  						});
  	</script>

	<!-- <div ng-app="databaseApp" ng-controller="databaseCtrl"> -->
	<!-- </div> -->

    <div id=app_content ng-app="myApp" ng-controller="homeCtrl">
			<div id=app_header>
					<a ng-click="gobackhome()"><button class = 'back'>Home</button></a>
					<a ng-click="drugDatabase()"><button class = 'database'>Database</button></a>
					<a ng-click="listManager()"><button class = 'study'>Study</button></a>
					<a ng-click = 'gobackhome()'><img id="toplogo" src="/mvc/public/images/logo_without_words_version_1.png"></a>

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

      <div class="pricing-plans">
     					 <div class="wrap">

     						<div class="pricing-grids">
     						<div class="pricing-grid2">
     							<div class="price-value two">
     								<h3><a href="#">Monthly</a></h3>
     								<h5><span>$ 2.99</span><lable> / month</lable></h5>
     								<div class="sale-box two">
     							</div>

     							</div>
     							<div class="price-bg">
     							<ul>
     								<li class="whyt"><a href="#">200 Words </a></li>
     								<li><a href="#">Learn With Friends</a></li>
     								<li class="whyt"><a href="#">Challenge with your Friend </a></li>
     								<li><a href="#">Fully Support</a></li>
     							</ul>
     							<div class="cart2">
     								<a class="popup-with-zoom-anim" href="#small-dialog">Purchase</a>
     							</div>
     							</div>
     						</div>
     						<div class="pricing-grid2">
     							<div class="price-value two">
     								<h3><a href="#">Semi-Annually</a></h3>
     								<h5><span>$ 12.99</span><lable> / 6 month</lable></h5>
     								<div class="sale-box two">

     							</div>

     							</div>
     							<div class="price-bg">
                    <ul>
       								<li class="whyt"><a href="#">200 Words </a></li>
       								<li><a href="#">Learn With Friends</a></li>
       								<li class="whyt"><a href="#">Challenge with your Friend </a></li>
       								<li><a href="#">Fully Support</a></li>
       							</ul>
     							<div class="cart2">
     								<a class="popup-with-zoom-anim" href="#small-dialog">Purchase</a>
     							</div>
     							</div>
     						</div>
     						<div class="pricing-grid2">
     							<div class="price-value two">
     								<h3><a href="#">Annually</a></h3>
     								<h5><span>$ 19.99</span><lable> / year</lable></h5>
     								<div class="sale-box two">

     							</div>

     							</div>
     							<div class="price-bg">
                    <ul>
       								<li class="whyt"><a href="#">200 Words </a></li>
       								<li><a href="#">Learn With Friends</a></li>
       								<li class="whyt"><a href="#">Challenge with your Friend </a></li>
       								<li><a href="#">Fully Support</a></li>
       							</ul>
     							<div class="cart2">
     								<a class="popup-with-zoom-anim" href="#small-dialog">Purchase</a>
     							</div>
     							</div>
     						</div>
     						<!-- <div class="pricing-grid3">
     							<div class="price-value three">
     								<h4><a href="#">PREMIUM</a></h4>
     								<h5><span>$ 49.99</span><lable> / month</lable></h5>
     								<div class="sale-box three">
     							<span class="on_sale title_shop">NEW</span>
     							</div>

     							</div>
     							<div class="price-bg">
     							<ul>
     								<li class="whyt"><a href="#">50GB Disk Space </a></li>
     								<li><a href="#">50 Domain Names</a></li>
     								<li class="whyt"><a href="#">20 E-Mail Address </a></li>
     								<li><a href="#">300GB Monthly Bandwidth </a></li>
     								<li class="whyt"><a href="#">Fully Support</a></li>
     							</ul>
     							<div class="cart3">
     								<a class="popup-with-zoom-anim" href="#small-dialog">Purchase</a>
     							</div>
     							</div>
     						</div> -->
     							<div class="clear"> </div>
     							<!--pop-up-grid-->
     								 <div id="small-dialog" class="mfp-hide">
     									<div class="pop_up">
     									 	<div class="payment-online-form-left">
     											<form>
     												<h4><span class="shipping"> </span>Shipping</h4>
     												<ul>
     													<li><input class="text-box-dark" type="text" value="Frist Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Frist Name';}"></li>
     													<li><input class="text-box-dark" type="text" value="Last Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Last Name';}"></li>
     												</ul>
     												<ul>
     													<li><input class="text-box-dark" type="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}"></li>
     													<li><input class="text-box-dark" type="text" value="Company Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Company Name';}"></li>
     												</ul>
     												<ul>
     													<li><input class="text-box-dark" type="text" value="Phone" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Phone';}"></li>
     													<li><input class="text-box-dark" type="text" value="Address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Address';}"></li>
     													<div class="clear"> </div>
     												</ul>
     												<div class="clear"> </div>
     											<ul class="payment-type">
     												<h4><span class="payment"> </span> Payments</h4>
     												<li><span class="col_checkbox">
     													<input id="3" class="css-checkbox1" type="checkbox">
     													<label for="3" name="demo_lbl_1" class="css-label1"> </label>
     													<a class="visa" href="#"> </a>
     													</span>

     												</li>
     												<li>
     													<span class="col_checkbox">
     														<input id="4" class="css-checkbox2" type="checkbox">
     														<label for="4" name="demo_lbl_2" class="css-label2"> </label>
     														<a class="paypal" href="#"> </a>
     													</span>
     												</li>
     												<div class="clear"> </div>
     											</ul>
     												<ul>
     													<li><input class="text-box-dark" type="text" value="Card Number" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Card Number';}"></li>
     													<li><input class="text-box-dark" type="text" value="Name on card" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name on card';}"></li>
     													<div class="clear"> </div>
     												</ul>
     												<ul>
     													<li><input class="text-box-light hasDatepicker" type="text" id="datepicker" value="Expiration Date" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Expiration Date';}"><em class="pay-date"> </em></li>
     													<li><input class="text-box-dark" type="text" value="Security Code" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Security Code';}"></li>
     													<div class="clear"> </div>
     												</ul>
     												<ul class="payment-sendbtns">
     													<li><input type="reset" value="Cancel"></li>
     													<li><input type="submit" value="Process order"></li>
     												</ul>
     												<div class="clear"> </div>
     											</form>
     										</div>
     						  			</div>
     								</div>
     								<!--pop-up-grid-->
     							</div>
     						<div class="clear"> </div>

     					</div>

     				</div>
		<footer>
			<a href="#" onclick="logout()"> Log Out</a>
		</footer>

    </div>

</body>
