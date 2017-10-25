<head>
    <meta charset="utf-8">
</head>

<body>

    <script src='/mvc/public/js/home/homeCtrl.js'></script>
    <script src='/mvc/public/js/payment/paymentCtrl.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" media="screen" title="no title">
    <link rel="stylesheet" href="/mvc/public/css/pricing.css" media="screen" title="no title">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
    <link rel="stylesheet" href="/mvc/public/assets/css/style.css">
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
    <!-- Load PayPal's checkout.js Library. -->
    <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4 log-level="warn"></script>
    <!-- Load the dropin -->
    <script src="https://js.braintreegateway.com/web/dropin/1.4.0/js/dropin.min.js"></script>
    <!-- Load the client component. -->
    <script src="https://js.braintreegateway.com/web/3.19.1/js/client.min.js"></script>
    <!-- Load the PayPal Checkout component. -->
    <script src="https://js.braintreegateway.com/web/3.19.1/js/paypal-checkout.min.js"></script>
    <!-- Collecting device data for Paypal -->
    <script src="https://js.braintreegateway.com/web/3.19.1/js/data-collector.min.js"></script>

    <!-- <div ng-app="databaseApp" ng-controller="databaseCtrl"> -->
    <!-- </div> -->

    <div id=app_content ng-app="myApp" ng-controller="homeCtrl">
        <div id=app_header>
            <a ng-click="gobackhome()"><button class = 'back'>Home</button></a>
            <a ng-click="drugDatabase()"><button class = 'database'>Database</button></a>
            <a ng-click="listManager()"><button class = 'study'>Study</button></a>
            <a ng-click='gobackhome()'><img id="toplogo" src="/mvc/public/images/logo_without_words_version_1.png"></a>

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
                        <a href="#" onclick="logout()">
                            <div class=logout-btn>logout</div>
                        </a>
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
                            <h5><span>$ 3.99</span>
                                <lable> / month</lable>
                            </h5>
                            <div class="sale-box two">
                            </div>

                        </div>
                        <div class="price-bg">
                            <ul>
                                <li class="whyt"><a href="#">Access to over 300+ drugs </a></li>
                                <li><a href="#">Edit and submit your own drug hints</a></li>
                                <li class="whyt"><a href="#">Study with your friends </a></li>
                                <li><a href="#">Eligible for rewards awarded to the top users each semester</a></li>
                                <li class="whyt"><a href="#">$ 3.99 / month </a></li>
                            </ul>
                            <div class="cart2">
                                <!--<a class="popup-with-zoom-anim" href="#small-dialog" onclick="subscription('month')">Purchase</a>-->
                                <a onclick="subscription('monthly')">Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="pricing-grid2">
                        <div class="price-value two">
                            <h3><a href="#">Semi-Annually</a></h3>
                            <h5><span>$ 12.99</span>
                                <lable> / Semester</lable>
                            </h5>
                            <div class="sale-box two">

                            </div>

                        </div>
                        <div class="price-bg">
                            <ul>
                                <li class="whyt"><a href="#">Access to over 300+ drugs</a></li>
                                <li><a href="#">Edit and submit your own drug hints</a></li>
                                <li class="whyt"><a href="#">Study with your friends </a></li>
                                <li><a href="#">Eligible for rewards awarded to the top users each semester</a></li>
                                <li class="whyt"><a href="#">$ 2.59 / month </a></li>
                            </ul>
                            <div class="cart2">
                                <!--<a class="popup-with-zoom-anim" href="#small-dialog" onclick="subscription('semester')">Purchase</a>-->
                                <a onclick="subscription('semi-annual')">Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="pricing-grid2">
                        <div class="price-value two">
                            <h3><a href="#">Annually</a></h3>
                            <h5><span>$ 19.99</span>
                                <lable> / year</lable>
                            </h5>
                            <div class="sale-box two">

                            </div>

                        </div>
                        <div class="price-bg">
                            <ul>
                                <li class="whyt"><a href="#">Access to over 300+ drugs </a></li>
                                <li><a href="#">Edit and submit your own drug hints</a></li>
                                <li class="whyt"><a href="#">Study with your friends</a></li>
                                <li><a href="#">Eligible for rewards awarded to the top users each semester</a></li>
                                <li class="whyt"><a href="#">$ 1.67 / month </a></li>
                            </ul>
                            <div class="cart2">
                                <!--<a class="popup-with-zoom-anim" href="#small-dialog" onclick="subscription('year')">Purchase</a>-->
                                <a onclick="subscription('annual')">Purchase</a>
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

                </div>
                <div class="clear"> </div>

            </div>

        </div>
        <!--         <footer>
            <a href="#" onclick="logout()"> Log Out</a>
        </footer> -->
    </div>

    <div id="modal_wrapper" style="visibility:hidden;">
        <div id="pop_up">
            <div class="payment-online-form-left">
                <header class="popupHeader socialHeader">
                    <span class="header_title">Make a Payment</span>
                    <span id="login_close" class="modal_close" onclick="hidePopup()"><i class="fa fa-times"></i></span>
                </header>
                <div id="payment-container">
                    <div id="making_payment">
                        <div id="dropin-container"></div>
                        <button class="payment-button" onclick="hidePopup()">Cancel</button>
                        <button class="payment-button" id="choose">Next</button>
                        <button class="payment-button" id="purchase" style="display:none;">Process</button>
                        <div class="clear"> </div>
                        <br>
                    </div>
                    <div id="payment_made" style="display:none;  font-family: 'Raleway', sans-serif; text-align:center;">
                        <p id="success" style="font-size:18px; margin-bottom:10px;"> </p>
                        <button class="payment-button" onclick="goHome()">Okay</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="lean_overlay"></div>
    </div>


    <!--class="mfp-hide"id="small-dialog"-->

</body>
