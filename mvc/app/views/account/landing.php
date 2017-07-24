
<head>
    <!-- angular js -->
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <!-- jQuery js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- ngSanitize -->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-sanitize.js"></script>
    <!-- anuglar controllers -->
    <script src="/mvc/public/js/myCtrl.js"></script>
    <script src="/mvc/public/js/checklist-model.js"></script>
    <script src="/mvc/public/js/global-script.js"></script>
    <script src='/mvc/public/js/account/loginCtrl.js'></script>
    <script src='/mvc/public/js/account/accountCtrl.js'></script>

    <script src="assets/vendor/jquery.leanModal.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-select/0.20.0/select.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/es5-shim/2.2.0/es5-shim.js"></script>
    <script>
        document.createElement('ui-select');
        document.createElement('ui-select-match');
        document.createElement('ui-select-choices');

    </script>
    <!-- Title -->
    <title>Monikos</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Responsive One Page HTML5 Website Template">
    <meta name="keywords" content="HTML5, CSS3, Bootsrtrap, Responsive, One Page, Template, Theme, Website" />
    <meta name="author" content="themetorium.net">

    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon (http://www.favicon-generator.org/) -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google font (https://www.google.com/fonts) -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Mono:400,300,500,700' rel='stylesheet' type='text/css'>
    <!-- Body font -->
    <link href='http://fonts.googleapis.com/css?family=Black+Ops+One' rel='stylesheet' type='text/css'>
    <!-- Alternative font -->

    <!-- Bootstrap CSS (http://getbootstrap.com) -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">

    <!-- Libs and Plugins CSS -->
    <link rel="stylesheet" href="assets/vendor/animate.min.css">
    <!-- Animations CSS (more info: http://daneden.github.io/animate.css) -->
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Font Icons (more info: http://fortawesome.github.io/Font-Awesome) -->
    <link rel="stylesheet" href="assets/vendor/ytplayer/css/jquery.mb.YTPlayer.min.css">
    <!-- YTPlayer JS (more info: https://github.com/pupunzi/jquery.mb.YTPlayer) -->
    <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.carousel.css">
    <!-- Owl Carousel CSS (more info: http://www.owlcarousel.owlgraphic.com) -->
    <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.carousel.plugins.css">
    <!-- Owl Carousel plugins CSS (more info: http://www.owlcarousel.owlgraphic.com) -->
    <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.theme.default.css">
    <!-- Owl Carousel default theme CSS (more info: http://www.owlcarousel.owlgraphic.com) -->
    <link rel="stylesheet" href="assets/vendor/magnific-popup/css/magnific-popup.css">
    <!-- Magnific Popup CSS (more info: http://dimsemenov.com/plugins/magnific-popup/) -->

    <!-- Theme master CSS -->
    <link rel="stylesheet" href="assets/css/helper.css">
    <link rel="stylesheet" href="assets/css/theme.css">

    <!-- Theme styles CSS (comment or uncomment below lines to enable/disable styles) -->
    <!-- <link rel="stylesheet" media="screen" title="blue-theme" href="assets/css/styles/blue.css"> -->
    <!-- <link rel="stylesheet" media="screen" title="brown-theme" href="assets/css/styles/brown.css"> -->
    <!-- <link rel="stylesheet" media="screen" title="green-theme" href="assets/css/styles/green.css"> -->
    <!-- <link rel="stylesheet" media="screen" title="purple-theme" href="assets/css/styles/purple.css"> -->
    <!-- <link rel="stylesheet" media="screen" title="yellow-theme" href="assets/css/styles/yellow.css"> -->

    <!-- Theme custom CSS (all your CSS customizations) -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- ui select css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-select/0.20.0/select.css" />

    <style media="screen">
      #modal{
        width:400px;
        margin-top: 5%;
        display: flex;
        justify-content: center;
      }

      /*.ui-select-match{
        border: 1px solid #DDD !important;
        color: #666;
        width: 90%;
        margin-left: 5%;
        padding: 10px;
      }*/
    </style>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
	   <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	   <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	   <![endif]-->

</head>




<!-- Additional information
	============================
	* You are free to use extra helper classes to customize your website (look into "helper.css" file).
	* To use scrolling animations please read more information here: http://mynameismatthieu.com/WOW/index.html.
	-->


<!-- =================
	///// Begin body /////
	======================
	* Add class="boxed" to use boxed layout (example: <body class="boxed" data-spy="scroll" data-target="#scrollspy">).
	* Use backgroun classes to change boxed layout background color. example: <body class="boxed bg-dark" data-spy="scroll" data-target="#scrollspy"> (look into "helper.css" file for more info).
	-->

<body data-spy="scroll" data-target="#scrollspy">
    <!-- POPUP -->
    <div id="modal" class="popupContainer" style="display:none;">
        <header class="popupHeader">
            <span class="header_title">Login</span>
            <span id="login_close" class="modal_close"><i class="fa fa-times"></i></span>
        </header>

        <section class="popupBody">

            <!-- Username & Password Login form -->
            <div id="errorMessage">
                <p class="errorText text-center"></p>
            </div>
            <div class="social_login" ng-app="loginApp" ng-controller="loginCtrl" id="login_form">
                <form name="login_form">
                    <input name="unVal" placeholder="Username" type="text" id="un" />
                    <!-- <p ng-if="!login_form.unVal.$valid" class="control-label" for="inputError1">Username can not be empty</p> -->
                    <br />
                    <input name="pwVal" ng-model="pwVal" ng-required="true" placeholder="Password" type="password" id="pw" />
                    <!-- <p ng-if="!login_form.pwVal.$valid" class="control-label" for="inputError1">Password can not be empty</p> -->
                    <!-- <div class       ="checkbox">
                                    <input id        ="remember" type="checkbox" />
                                    <label for       ="remember">Remember me </label>
                                </div> -->

                    <br />
                    <div class="action_btns">
                        <div id="loginBtn" class="one_half"><a ng-model="submit" class="btn btn-primary margin-top-10 wow bounceIn" data-wow-delay="0.5s" ng-click="login()">Log in</a></div>
                        <div class="last_half"><a id="register_button" class="btn btn-primary margin-top-10 wow bounceIn" data-wow-delay="0.5s">Create Account</a></div>
                    </div>
                </form>

                <!-- <a href          ="#" class="forgot_password">Forgot password?</a> -->
            </div>

            <!-- Register Form -->
            <div class="user_register" ng-app="myApp" ng-controller="accountCtrl" id="register_app">
                <form id="register_form">

                    <input placeholder="Username" type="text" id="un_reg" />
                    <br />
                    <input placeholder="Email" type="text" id="email_reg" />
                    <br />
                    <input placeholder="Password" type="password" id="pw_reg" />
                    <br />
                    <input placeholder="Confirm Password" type="password" id="pw2_reg" />
                    <br />
                    <!-- <p id="program">Nursing</p> -->

                    <!-- <div id="reg_form" > -->
                    <ui-select ng-model="selectedProgram">
                        <ui-select-match placeholder="Program">
                            <span ng-bind="$select.selected.program" id="program"></span>
                        </ui-select-match>
                        <ui-select-choices repeat="x in (programs | filter: $select.search) track by x.programId">
                            <span ng-bind="x.program"></span>
                        </ui-select-choices>
                    </ui-select>

                    <ui-select ng-model="selectedSchool" ng-click=findSchool()>
                        <ui-select-match placeholder="School">
                            <span id="school" ng-bind="$select.selected.schoolname"></span>
                            <span style="display: none" id="schoolid" ng-bind="$select.selected.schoolid"></span>
                        </ui-select-match>
                        <ui-select-choices repeat="x in (schoolnames | filter: $select.search) track by x.schoolid">
                            <span ng-bind="x.schoolname"></span>
                        </ui-select-choices>
                    </ui-select>

                    <ui-select ng-model="selectedYear" ng-click=findYear()>
                        <ui-select-match placeholder="Graduation Year">
                            <span id="year">{{$select.selected}}</span>
                        </ui-select-match>
                        <ui-select-choices repeat='x in years | filter: $select.search'>
                            {{x}}
                        </ui-select-choices>
                    </ui-select>


                    <!--  <select id="program" class= "reg_select">
						                <option selected disabled>select a program</option>
						                <option ng-repeat="x in programs" id="a{{x.program}}" value="{{x.program}}">{{x.program}}</option>
						            </select> -->
                    <!-- </br> -->
                    <!-- <select id="school" ng-click="findSchool()" class= "reg_select">
										<option selected disabled>select a school</option>
						                <option ng-repeat="x in schoolnames" id="a{{x.schoolid}}" value="{{x.schoolid}}">{{x.schoolname}}</option>
									</select> -->
                    <!-- </div> -->



                    <div class="action_btns">
                        <div class="one_half"><a href="#" class="btn back_btn btn-primary margin-top-10" id="back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
                        <div class="one_half last"><a href="" id="register" class="btn btn-primary margin-top-10" ng-click="checkUsername()">Register</a></div>
                    </div>
                </form>

            </div>


        </section>
    </div>
    <!-- End Popup  -->


    <!-- Begin preloader -->
    <div id="preloader">
        <div class="pulse"></div>
    </div>
    <!-- End preloader -->

    <!-- Begin body content -->
    <div id="body-content">
        <!-- ==============
			///// Begin header
			=================== -->
        <header id="header-wrap">

            <!-- Begin Header content
				==========================
				* Use class "show-hide-on-scroll" to hide header on scroll down and show on scroll up.
				* Use class "fixed-top" to set header to fixed position.
				* Use class "transparent" for transparent header.
				* Use class "transparent-border" to enable bottom border on transparent header (class "transparent" is still required).
				* Use class "semi-transparent" for semi-transparent header.
				* Use class "header-fluid" for full width header.
				* Use class "header-dark" for dark header.
				* Use class "header-color" for header custom background color. By default theme main color is used, but you ca use custom background color classes (class "header-color" is still required!). Look into "helper.css" file for more info.
				* Use class "header-shadow" to enable header bottom shadow.
				* Use class "header-md", "header-lg" or "header-xlg" to change header size.
				-->
            <div id="header" class="header-md header-shadow show-hide-on-scroll transparent eader-shadow">
                <div id="scrollspy" class="container header-container">

                    <!-- Begin logo  -->

                    <div class="logo font-alter-1">
                        <a href="index.html">
                            <h1>
                                <!-- MONIKOS -->
                            </h1>
                        </a>
                    </div>
                    <!-- End logo -->

                    <!-- Begin navbar
						================== -->
                    <nav class="navbar pull-right">

                        <!-- Begin toggle button (get grouped for better mobile display) -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-main" aria-expanded="false">
								  <span class="sr-only">Toggle navigation</span>
								  <span class="icon-bar"></span>
								  <span class="icon-bar"></span>
								  <span class="icon-bar"></span>
								</button>
                        </div>
                        <!-- End toggle button-->

                        <!-- Begin nav main
							====================
							* Use class "nav-separator" to enable nav links separators.
							* Use class "nav-uppercase" to enable nav uppercase letters.
							* Use class "mob-navbar-collapse-dark" to enable dark mobile menu.
							* Use class "mob-navbar-align-center" to enable dark mobile menu.
							* Note-1: class "mlc" in menu links = close mobile menu when clicking menu link (for one page template version only).
							* Note-2: class "sm-scroll" in menu links = enable smooth scrolling when clicking menu link (for one page template version only).
							-->
                        <div id="nav-main" class="collapse navbar-collapse nav-uppercase mob-navbar-collapse-dark">

                            <!-- Begin navbar-nav
								======================
								* Use class "nav-pills" to enable nav pills.
								* Use class "pills-rounded", "pills-rounded-2x", "pills-rounded-3x" or "pills-rounded-4x" for rounded pills (class "nav-pills" is required).
								* Use class "pills-gradient" to enable gradient pills (class "nav-pills" is required).
								* Use class "nav-border-bottom" to enable menu links with bottom border (class "nav-pills" is required).
								-->
                            <ul class="nav navbar-nav navbar-right nav-pills pills-rounded-4x ">

                                <li class="active"><a class="mlc sm-scroll" href="#intro">Home</a></li>
                                <li><span class="nav-link-separator">/</span></li>
                                <li><a class="mlc sm-scroll" href="#section-about">Our Story</a></li>
                                <li><span class="nav-link-separator">/</span></li>
                                <li><a class="mlc sm-scroll" href="#section-product">Our Product</a></li>
                                <li class="dropdown dropdown-uppercase dropdown-menu-color dropdown-hover">
                                    <a href="#0" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
											About Us<span class="caret-2"><i class="fa fa-angle-down"></i></span>
										</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="mlc sm-scroll" href="#section-team">Our Team</a></li>
                                        <li><a class="mlc sm-scroll" href="#section-video">Video Promo</a></li>
                                        <li><a class="mlc sm-scroll" href="#section-test">Testimonials</a></li>
                                        <li><a class="mlc sm-scroll" href="#section-clients">Our Clients</a></li>
                                        <!--
											 Begin dropdown (submenu)
											==============================
											* Use class "dropdown-hover" to make navigation toggle on desktop hover.
											* Use class "dropdown-uppercase" to enable dropdown menu uppercase letters.
											* Use class "dropdown-menu-dark" to enable dark dropdown menu.
											* Use class "dropdown-menu-color" to enable custom colored dropdown menu.
											* Use class "dropdown-submenu" for dropdown submenu. -->
                                        <!-- End dropdown -->

                                    </ul>
                                    <!-- /.dropdown-menu -->
                                </li>
                                <!-- End dropdown -->
                                <li><span class="nav-link-separator">/</span></li>

                                <li><span class="nav-link-separator">/</span></li>

                                <li><a class="mlc sm-scroll" href="#section-sponsors">Sponsors</a></li>

                                <li><span class="nav-link-separator">/</span></li>
                                <li><a class="mlc sm-scroll" href="#section-contact">Contact</a></li>

                            </ul>
                            <!-- End navbar-nav -->

                        </div>
                        <!-- End nav main -->

                    </nav>
                    <!-- End navbar -->

                </div>
                <!-- /.container -->
            </div>
            <!-- End header content -->

        </header>
        <!-- End header -->


        <!-- ==========================
			///// Begin intro section /////
			===============================
			* Use class "full-height" to full screen intro.
			* Use class "angle-left-bottom" or "angle-right-bottom" to change intro bottom angle.
			* Use class "bg-image-parallax" to enable background image parallax effect (otherwise use class "bg-image").
			-->
        <section id="intro" class="bg-image-parallax" style="background-image: url(images/landing_page/intro.jpg);">

            <div class="intro-inner">

                <!-- Element cover
					===================
					* Use background transparent color classes for colored opacity (example: "bg-transparent-6-dark", "bg-transparent-8-5-red" ... 1 to 95). Look into "helper.css" file for more info.
					-->
                <!-- <span class="cover bg-transparent-2-dark bg-transparent-gradient-2"></span> -->
                <span class="cover"></span>
                <!-- Begin intro caption -->
                <div class="intro-caption vertical-align-center text-center text-white">
                    <img class="wow fadeIn" style="height:50%; width: 50%" src="images/landing_page/logo2.png">
                    <!-- <p class="intro-description wow fadeIn" data-wow-delay="2.2s">est. 2015</p> -->
                    <div id="sign_up" class="margin-top-30">
                        <a id="modal_trigger" href="#modal" class="btn btn-primary margin-top-10 wow bounceIn" data-wow-delay="1s">START HERE</a>
                    </div>
                    <br>
                    <a style="font-size:120%;color:white;">Helping healthcare students learn and study better.</a>
                </div>
                <!-- End intro caption -->

                <!-- Made with love :) -->
                <div class="made-with-love hidden-xs">
                    <p class="text-gray">Made with <span class="text-main"><i class="fa fa-heart-o"></i></span></p>
                </div>

                <!-- Scroll down arrow -->
                <a class="scroll-down-arrow sm-scroll text-center text-white" href="#section-about"><span><i class="fa fa-chevron-down"></i></span></a>

            </div>

        </section>
        <!-- End intro section -->


        <!-- ===================================
			///// Begin call to action section /////
			========================================
			* Use class "angle-left-bottom" or "angle-right-bottom" to change intro bottom angle.
			* Use class "bg-image-fixed" to make background image fixed (otherwise use class "bg-image").
			* Use class "bg-image-parallax" to enable background image parallax effect (otherwise use class "bg-image").
			* Use class "bg-pattern" if you use background patterns (example: http://subtlepatterns.com/). Combine with class "bg-image-fixed".
			-->



        <!-- 			 =================================
			///// Begin section 1 (about us) /////
			==================================  -->
        <section id="section-about" class="about-section">
            <div class="container">
                <div class="row wow fadeIn">

                    <!-- Left column -->
                    <div class="col-md-6">

                        <!-- Begin heading
							===================
							* Use class "heading-center" or "heading-right" to align heading.
							* Use class "heading-xs", "heading-sm", "heading-md", "heading-lg" or "heading-xlg" to shange heading size.
							* Use class "heading-hover" to enable heading hover effect.
							* Use class "heading-uppercase" to enable uppercase letters.
							-->
                        <div class="heading heading-md heading-uppercase heading-hover">
                            <span class="heading-title-ghost">About Us</span>
                            <h2 class="heading-title">About Us</h2>

                            <!-- Begin divider
								===================
								* Use class "hr-width-1", "hr-width-2" -> up to "hr-width-10" to shange divider width.
								* Use class "hr-1x", "hr-2x", "hr-3x", "hr-4x" or "hr-5x" to shange divider size.
								* Use class "hr-dotted", "hr-dashed" or "hr-double" to shange divider style.
								-->
                            <hr class="hr-width-1 hr-5x border-main">
                            <!-- End divider -->
                            <img class="img-responsive" src="assets/img/ourst.jpg" alt="team_img" id='our_str' style="height: 100%;width: 100%; padding-right: 20px;padding-top: 20px" />
                        </div>
                        <!-- End heading -->

                    </div>
                    <!-- /.col -->

                    <!-- Right column -->
                    <div class="col-md-6">

                        <p class="lead">
                            Healthcare is changing more now than ever before. With so much uncertainty with looming healthcare reform, Monikos is attempting to do something novel in the healthcare realm. As healthcare students, we understand that collaboration is the key providing value based care to patients. We also understand that healthcare professionals have to be students first. We want to make our impact on healthcare students while they are still learning the information they need to be successful; we also want them to have fun doing it.
                        </p>
                        <p class="lead">
                            We understand that healthcare professionals will always have some sort of pharmacology, drug-based class within their curriculum. Monikos is here to supplement the learning for these drug-based facts to help healthcare students not only learn, but also retain different drug facts.
                        </p>
                        <!-- 							<p class="lead">
								v
							</p> -->

                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- End section 1 -->



        <!-- =================================
			///// Begin section 2 (services) /////
			======================================
			* Use class "angle-left-top", "angle-right-top", "angle-left-bottom", "angle-right-bottom" to change section angle.
			* Use class "bg-image-fixed" to make background image fixed (otherwise use class "bg-image").
			* Use class "bg-image-parallax" to enable background image parallax effect (otherwise use class "bg-image").
			* Use class "bg-pattern" if you use background patterns (example: http://subtlepatterns.com/). Combine with class "bg-image-fixed".
			-->
        <section id="section-product" class="services-section bg-dark bg-image-parallax" style="background-image: url(assets/img/unc_med.jpeg);">
            <span class="cover bg-transparent-6-5-dark"></span>
            <div class="row">
                <div class="heading heading-md heading-uppercase text-white heading-hover wow fadeIn" data-wow-delay="0.2s">

                    <span class="heading-title-ghost" id='our_pro'>Our Product</span>
                    <h2 class="heading-title" id='our_pro'>Our Product</h2>
                </div>

                <!-- Element cover
				===================
				* Use background transparent color classes for colored opacity (example: "bg-transparent-6-dark", "bg-transparent-8-5-red" ... 1 to 95). Look into "helper.css" file for more info.
				-->

                <div class="container margin-top-20">
                    <div class="row" data-wow-delay="0.3s" style="visability: visible; animation-delay: 0.3s; animation-name: fadeIn">
                        <!--first-->
                        <div class="col-sm-6 col-md-4">
                            <div class="portfolio-item wow fadeInLeft">
                                <a class="item-link inline-popup-trigger" href="">
                                    <span class="cover bg-transparent-9-main"></span>
                                    <img class="item-img" src="images/landing_page/app2.jpeg" alt="Matching Game">
                                    <div class="item-info text-white">
                                        <h3 class="item-info-title">Matching game</h3>
                                        <p class="item-info-text">Matching game</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!--end first-->
                        <!--second-->
                        <div class="col-sm-6 col-md-4">
                            <div class="portfolio-item wow fadeInUp">
                                <a class="item-link inline-popup-trigger" href="">
                                    <span class="cover bg-transparent-9-main"></span>
                                    <img class="item-img" src="images/landing_page/app3.jpeg" alt="Friend">
                                    <div class="item-info text-white">
                                        <h3 class="item-info-title">Compete with Friends</h3>
                                        <p class="item-info-text">Compete with Friends</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!--end second-->
                        <!--third-->
                        <div class="col-sm-6 col-md-4">
                            <div class="portfolio-item wow fadeInRight">
                                <a class="item-link inline-popup-trigger" href="">
                                    <span class="cover bg-transparent-9-main"></span>
                                    <img class="item-img" src="images/landing_page/app1.jpeg" alt="Flash Card">
                                    <div class="item-info text-white">
                                        <h3 class="item-info-title">Flash Card</h3>
                                        <p class="item-info-text">Flash Card</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!--end third-->
                    </div>
                </div>
            </div>

        </section>
        <!-- End section 2 -->

        <!-- ===========================================
			///// Begin section team /////
			============================================ -->
        <section id="section-team" class="blog-section padding-top-100">

            <div class="container">
                <div class="row wow fadeIn">

                    <!-- Left column -->
                    <div class="col-md-6">

                        <!-- Begin heading
							===================
							* Use class "heading-center" or "heading-right" to align heading.
							* Use class "heading-xs", "heading-sm", "heading-md", "heading-lg" or "heading-xlg" to shange heading size.
							* Use class "heading-hover" to enable heading hover effect.
							* Use class "heading-uppercase" to enable uppercase letters.
							-->
                        <div class="heading heading-md heading-uppercase heading-hover">
                            <span class="heading-title-ghost">The Team</span>
                            <h2 class="heading-title">The Team</h2>

                            <!-- Begin divider
								===================
								* Use class "hr-width-1", "hr-width-2" -> up to "hr-width-10" to shange divider width.
								* Use class "hr-1x", "hr-2x", "hr-3x", "hr-4x" or "hr-5x" to shange divider size.
								* Use class "hr-dotted", "hr-dashed" or "hr-double" to shange divider style.
								-->
                            <hr class="hr-width-1 hr-5x border-main">
                            <!-- End divider -->

                        </div>
                        <!-- End heading -->

                    </div>
                    <!-- /.col -->

                    <!-- Right column -->
                    <div class="col-md-6">

                        <p class="lead">
                            <strong>At Monikos,</strong> we understand that healthcare is changing, and we want to make sure that we do our part in providing a platform that supplements the training of healthcare students to streamline their process in becoming healthcare professionals.
                        </p>

                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->

            <div class="container">

                <!-- Begin blog list
					=====================
					* Use class "blog-list-classic" to enable classic blog list layout.
					-->
                <div class="blog-list margin-top-80">
                    <div class="blog-wrap">

                        <!-- Begin blog list item 1
							============================ -->
                        <div class="blog-list-item row">

                            <!-- Left column -->
                            <div class="col col-md-3 no-padding wow fadeInLeft">
                                <div class="team-box team-box-hover ">
                                    <div class="team-image">
                                        <a class="item-link inline-popup-trigger" href="#portfolio-1"><img src="images/landing_page/patrick.jpg" alt="Patrick"></a>
                                    </div>

                                </div>
                            </div>
                            <!-- /.col -->

                            <!-- Right column -->
                            <div class="col col-md-9 no-padding wow fadeInRight">
                                <div class="bco blog-list-info">
                                    <h2 class="blog-list-title"><a class="tem-link inline-popup-trigger" href="#portfolio-1" title="Aenean Odio Metus">Patrick</a></h2>
                                    <div class="blog-list-meta">
                                        <p class="article-time">Co-founder</p>
                                    </div>
                                    <p class="blog-list-desc  text-center">
                                        Patrick is originally from Austin, Texas. He attended Duke University on a full athletic football scholarship. Before he left for college, his mother was diagnosed with type 2 diabetes. It was during this time period that Patrick started to take notice into what medications she took to control her diabetes and this is what motivated him to want to attend Pharmacy school...
                                        <a class="tem-link inline-popup-trigger" href="#portfolio-1"> read more...</a>
                                    </p>
                                </div>
                            </div>
                            <!-- /.col -->
                            <!-- Begin inline popup content. Class "mfp-hide" is required to make dialog hidden -->
                            <div id="portfolio-1" class="inline-popup mfp-hide">
                                <div class="inline-popup-inner">

                                    <!-- 					<div class="inline-popup-image bg-image" style="background-image: url(assets/img/portfolio/v.2/big/portfolio-img-1.jpg); background-position: 50% 50%;"></div> -->

                                    <div class="row margin-top-40">
                                        <div class="col-md-8 margin-bottom-20">
                                            <h2 class="no-margin-top">Patrick</h2>
                                            <p>Patrick is originally from Austin, Texas. He attended Duke University on a full athletic football scholarship. Before he left for college, his mother was diagnosed with type 2 diabetes. It was during this time period that Patrick started to take notice into what medications she took to control her diabetes and this is what motivated him to want to attend Pharmacy school. Upon graduation, he took a two-year hiatus to enter the work force and complete a post-bac to make himself an eligible candidate for pharmacy school. </p>

                                            <p>He originally thought he would be heading back to Texas for Pharmacy school to be closer to his family, but when he was accepted into the UNC Eshelman School of Pharmacy, it was hard for him to turn down the then #2 ranked pharmacy school in the country. One of the promise Patrick’s mother made him keep was that no matter what school he chose to attend, that he leaves a positive impact. Hopefully Monikos will fulfill this promise to her.</p>
                                        </div>
                                        <div class="col-md-4 margin-bottom-20 padding-left-40">
                                            <img src="images/landing_page/patrick.jpg" alt="patrick">

                                            <ul class="social-icons">
                                                <li><a class="btn btn-social-min btn-default btn-sm" href="" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                                <li><a class="btn btn-social-min btn-default btn-sm" href="" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                                <li><a class="btn btn-social-min btn-default btn-sm" href="" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                                <li><a class="btn btn-social-min btn-default btn-sm" href="" target="_blank"><i class="fa fa-dribbble"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.row -->

                                </div>
                                <!-- /.inline-popup-inner -->

                                <a class="inline-popup-close" href="#"><i class="fa fa-times"></i></a>

                            </div>
                        </div>
                        <!-- End blog list item 1 -->

                        <!-- Begin blog list item 2
							============================ -->
                        <div class="blog-list-item row">

                            <!-- Right column -->
                            <div class="col col-md-3 col-md-push-9 no-padding wow fadeInRight">
                                <div class="team-box team-box-hover ">
                                    <div class="team-image">
                                        <a class="item-link inline-popup-trigger" href="#portfolio-2"><img src="images/landing_page/riley.jpg" alt="Patrick"></a>
                                    </div>

                                </div>
                            </div>
                            <!-- /.col -->
                            <!-- Left column -->
                            <div class="col col-md-9 col-md-pull-3 no-padding wow fadeInLeft">
                                <div class="bco blog-list-info">
                                    <h2 class="blog-list-title text-right"><a class="tem-link inline-popup-trigger" href="#portfolio-2" title="Aenean Odio Metus">Riley</a></h2>
                                    <div class="blog-list-meta text-right">
                                        <p class="article-time">Co-founder</p>
                                    </div>
                                    <p class="blog-list-desc text-center">
                                        Riley always wanted to work in healthcare, but she was never one to take the traditional path. She graduated from Tufts University with a double degree in Economics and International Relations with a minor in Spanish. During her undergrad years, she took every opportunity to travel, including a year in Buenos Aires during her Junior year. Upon graduation,...
                                        <a class="tem-link inline-popup-trigger" href="#portfolio-2"> read more...</a>
                                    </p>
                                </div>
                            </div>
                            <!-- /.col -->

                        </div>
                        <!-- End blog list item 2 -->

                        <!-- Begin inline popup content. Class "mfp-hide" is required to make dialog hidden -->
                        <div id="portfolio-2" class="inline-popup mfp-hide">
                            <div class="inline-popup-inner">

                                <!-- 					<div class="inline-popup-image bg-image" style="background-image: url(assets/img/portfolio/v.2/big/portfolio-img-1.jpg); background-position: 50% 50%;"></div> -->

                                <div class="row margin-top-40">
                                    <div class="col-md-8 margin-bottom-20">
                                        <h2 class="no-margin-top">Riley</h2>
                                        <p>Riley always wanted to work in healthcare, but she was never one to take the traditional path. She graduated from Tufts University with a double degree in Economics and International Relations with a minor in Spanish. During her undergrad years, she took every opportunity to travel, including a year in Buenos Aires during her Junior year. Upon graduation, she moved to her favorite place, New York City, to work in international finance at a Korean investment fund. As an investment banker, Riley was able to learn about international finance and business, but she didn’t feel that her mentors, especially her female mentors were leading lives that she wanted for herself. </p>

                                        <p>Conjuring up her true passion for helping people, making an impact and interest in healthcare, she decided to take another career turn. After much contemplation, she took a leap of faith and started taking post-bac courses at the nearest community college to prepare for pharmacy school. Since that one brave day when she chose to register for the first Biology course, Riley has been blessed to have made it all the way to UNC Eshelman School of Pharmacy, the best pharmacy school in the nation. Now, with her interest entrepreneurship and startups, she is launching Monikos to help fellow pharmacy students better learn and retain drug information.</p>
                                    </div>
                                    <div class="col-md-4 margin-bottom-20 padding-left-40">
                                        <img src="" alt="riley">

                                        <ul class="social-icons">
                                            <li><a class="btn btn-social-min btn-default btn-sm" href="" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                            <li><a class="btn btn-social-min btn-default btn-sm" href="" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                            <li><a class="btn btn-social-min btn-default btn-sm" href="" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                            <li><a class="btn btn-social-min btn-default btn-sm" href="" target="_blank"><i class="fa fa-dribbble"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.inline-popup-inner -->

                            <a class="inline-popup-close" href="#"><i class="fa fa-times"></i></a>

                        </div>
                        <!-- End popup item2 -->
                    </div>
                    <!-- /.blog-wrap -->
                </div>
                <!-- End blog-list -->

            </div>
            <!-- /.container -->

        </section>
        <!-- End section team -->

        <!-- ====================================
			///// Begin section-video (video promo) /////
			=========================================
			* Use class "angle-left-top", "angle-right-top", "angle-left-bottom", "angle-right-bottom" to change section angle.
			-->

        <!-- Youtube video background
			NOTE: Replace videoURL with your own (videoURL:'your-youtube-video-URL').
			Do not forget to add your background image for mobile devices (because the video background doesn't work on mobile devices).
			More info about YTPlayer: https://github.com/pupunzi/jquery.mb.YTPlayer -->
        <!-- <section id="section-video" class="video-section youtube-bg text-white"
				style="background-image: url(assets/img/video-bg/promo-video-bg-2.jpg); background-position: 50% 50%;"
				data-property="{
			      videoURL: 'https://youtu.be/shmACcIxdUA',
			      containment: 'self',
			      startAt: 0,
			      stopAt: 0,
			      autoPlay: true,
			      loop: true,
			      mute: true,
			      showControls: false,
			      showYTLogo: false,
			      realfullscreen: true,
			      addRaster: false,
			      optimizeDisplay: true,
			      stopMovieOnBlur: true
				}"> -->

        <!-- Element cover
				===================
				* Use background transparent color classes for colored opacity (example: "bg-transparent-6-dark", "bg-transparent-8-5-red" ... 1 to 95). Look into "helper.css" file for more info.
				-->
        <!-- <span class="cover bg-transparent-8-dark"></span>

				<div class="video-section-caption vertical-align-center"> -->

        <!-- Begin heading
					===================
					* Use class "heading-center" or "heading-right" to align heading.
					* Use class "heading-xs", "heading-sm", "heading-md", "heading-lg" or "heading-xlg" to shange heading size.
					* Use class "heading-hover" to enable heading hover effect.
					* Use class "heading-uppercase" to enable uppercase letters.
					-->
        <!-- <div class="heading heading-md heading-uppercase heading-center heading-hover wow fadeIn">
						<span class="heading-title-ghost">Video Promo</span>
						<h2 class="heading-title">Video Promo</h2>
						<a class="video-btn bg-main" href="https://www.youtube.com/channel/UCXnvLHEf5t4ncz2DCLRMmpQ" target="_blank"><i class="fa fa-play"></i></a>
						<p class="heading-tescription lead text-gray-2">
							Try out Monikos!
						</p>
					</div> -->
        <!-- End heading -->
        <iframe width="1280" height="720" src="https://www.youtube.com/embed/shmACcIxdUA?rel=0?ecver=1" frameborder="0" allowfullscreen></iframe>

    </div>
    <!-- /.vertical-align-center -->

    </section>
    <!-- End section vedio -->


    <!-- =================================
			///// Begin section clients (clients) /////
			================================== -->
    <section id="section-clients" class="clients-section">

        <div class="container">
            <div class="row">

                <div class="col-md-12">

                    <!-- Begin heading
							===================
							* Use class "heading-center" or "heading-right" to align heading.
							* Use class "heading-xs", "heading-sm", "heading-md", "heading-lg" or "heading-xlg" to shange heading size.
							* Use class "heading-hover" to enable heading hover effect.
							* Use class "heading-uppercase" to enable uppercase letters.
							-->
                    <div class="heading heading-md heading-uppercase heading-center heading-hover wow fadeIn">
                        <span class="heading-title-ghost">Our Clients</span>
                        <h2 class="heading-title">Our Clients</h2>

                        <!-- Begin divider
								===================
								* Use class "hr-width-1", "hr-width-2" -> up to "hr-width-10" to shange divider width.
								* Use class "hr-1x", "hr-2x", "hr-3x", "hr-4x" or "hr-5x" to shange divider size.
								* Use class "hr-dotted", "hr-dashed" or "hr-double" to shange divider style.
								-->
                        <hr class="hr-width-1 hr-5x border-main">
                        <!-- End divider -->

                        <p class="heading-tescription lead max-width-800 margin-auto">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                    </div>
                    <!-- End heading -->

                </div>
                <!-- /.col -->

                <!-- Left column -->
                <div class="col-md-12 margin-top-60 wow fadeIn" data-wow-delay="0.3s">

                    <!-- Begin content carousel (http://www.owlcarousel.owlgraphic.com)
							====================================================================
							* Use class "nav-outside" for outside nav.
							* Use class "nav-outside-top" for outside top nav.
							* Use class "nav-rounded" for rounded nav.
							* Use class "dots-outside" for outside dots.
							* Use class "dots-left" or "dots-right" to align dots.
							* Use class "dots-rounded" for rounded dots.
							* Available carousel data attributes:
									data-items="5".......................(items visible on desktop)
									data-tablet-landscape="4"............(items visible on mobiles)
									data-tablet-portrait="3".............(items visible on mobiles)
									data-mobile-landscape="2"............(items visible on tablets)
									data-mobile-portrait="1".............(items visible on tablets)
									data-loop="true".....................(true/false)
									data-margin="10".....................(space between items)
									data-center="true"...................(true/false)
									data-start-position="0"..............(item start position)
									data-animate-in="fadeIn".............(more animations: http://daneden.github.io/animate.css/)
									data-animate-out="fadeOut"...........(more animations: http://daneden.github.io/animate.css/)
									data-mouse-drag="false"..............(true/false)
									data-touch-drag="false"..............(true/false)
									data-autoheight="true"...............(true/false)
									data-autoplay="true".................(true/false)
									data-autoplay-timeout="5000".........(milliseconds)
									data-autoplay-hover-pause="true".....(true/false)
									data-autoplay-speed="800"............(milliseconds)
									data-drag-end-speed="800"............(milliseconds)
									data-lazy-load="true"................(true/false)
									data-nav="true"......................(true/false)
									data-nav-speed="800".................(milliseconds)
									data-dots="false"....................(true/false)
									data-dots-speed="800"................(milliseconds)
							-->
                    <div class="owl-carousel clients-carousel dots-outside" data-items="5" data-margin="40" data-tablet-landscape="4" data-tablet-portrait="3" data-mobile-landscape="2" data-mobile-portrait="1">

                        <!-- Begin carousel item
								========================= -->
                        <div class="cc-item">
                            <a target="_blank" href="#" class="client"><img src="assets/img/clients/client-1.png" alt="image"></a>
                        </div>
                        <!-- End carousel item -->

                        <!-- Begin carousel item
								========================= -->
                        <div class="cc-item">
                            <a target="_blank" href="#" class="client"><img src="assets/img/clients/client-2.png" alt="image"></a>
                        </div>
                        <!-- End carousel item -->

                        <!-- Begin carousel item
								========================= -->
                        <div class="cc-item">
                            <a target="_blank" href="#" class="client"><img src="images/landing_page/user_unc.png" alt="image"></a>
                        </div>
                        <!-- End carousel item -->

                        <!-- Begin carousel item
								========================= -->
                        <div class="cc-item">
                            <a target="_blank" href="#" class="client"><img src="assets/img/clients/client-4.png" alt="image"></a>
                        </div>
                        <!-- End carousel item -->

                        <!-- Begin carousel item
								========================= -->
                        <div class="cc-item">
                            <a target="_blank" href="#" class="client"><img src="assets/img/clients/client-5.png" alt="image"></a>
                        </div>
                        <!-- End carousel item -->


                    </div>
                    <!-- End content carousel -->

                </div>
                <!-- /.col-->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->

    </section>
    <!-- End section clients -->

    <!-- =====================================
			///// Begin section test (testimonials) /////
			==========================================
			* Use class "angle-left-top", "angle-right-top", "angle-left-bottom", "angle-right-bottom" to change section angle.
			* Use class "bg-image-fixed" to make background image fixed (otherwise use class "bg-image").
			* Use class "bg-image-parallax" to enable background image parallax effect (otherwise use class "bg-image").
			* Use class "bg-pattern" if you use background patterns (example: http://subtlepatterns.com/). Combine with class "bg-image-fixed".
			-->
    <section id="section-test" class="testimonials-section bg-dark bg-image-parallax" style="background-image: url(images/landing_page/bg-2.jpg);">

        <!-- Element cover
				===================
				* Use background transparent color classes for colored opacity (example: "bg-transparent-6-dark", "bg-transparent-8-5-red" ... 1 to 95). Look into "helper.css" file for more info.
				-->
        <span class="cover bg-transparent-5-1-dark"></span>

        <div class="container">
            <div class="row wow fadeIn" data-wow-delay="0.3s">
                <div class="col-md-12">

                    <!-- Begin testimonials
							========================
							* Use class "tm-hide-image" to hide testimonial image.
							* Use class "tm-center" or "tm-right" to align testimonials.
							-->
                    <div class="testimonial-wrap tm-center max-width-800 margin-auto">

                        <!-- Begin content carousel (http://www.owlcarousel.owlgraphic.com)
								====================================================================
								* Use class "nav-outside" for outside nav.
								* Use class "nav-outside-top" for outside top nav.
								* Use class "nav-rounded" for rounded nav.
								* Use class "dots-outside" for outside dots.
								* Use class "dots-left" or "dots-right" to align dots.
								* Use class "dots-rounded" for rounded dots.
								* Available carousel data attributes:
										data-items="5".......................(items visible on desktop)
										data-tablet-landscape="4"............(items visible on mobiles)
										data-tablet-portrait="3".............(items visible on mobiles)
										data-mobile-landscape="2"............(items visible on tablets)
										data-mobile-portrait="1".............(items visible on tablets)
										data-loop="true".....................(true/false)
										data-margin="10".....................(space between items)
										data-center="true"...................(true/false)
										data-start-position="0"..............(item start position)
										data-animate-in="fadeIn".............(more animations: http://daneden.github.io/animate.css/)
										data-animate-out="fadeOut"...........(more animations: http://daneden.github.io/animate.css/)
										data-mouse-drag="false"..............(true/false)
										data-touch-drag="false"..............(true/false)
										data-autoheight="true"...............(true/false)
										data-autoplay="true".................(true/false)
										data-autoplay-timeout="5000".........(milliseconds)
										data-autoplay-hover-pause="true".....(true/false)
										data-autoplay-speed="800"............(milliseconds)
										data-drag-end-speed="800"............(milliseconds)
										data-lazy-load="true"................(true/false)
										data-nav="true"......................(true/false)
										data-nav-speed="800".................(milliseconds)
										data-dots="false"....................(true/false)
										data-dots-speed="800"................(milliseconds)
								-->
                        <div class="owl-carousel testimonial-carousel dots-outside text-white" data-items="1" data-loop="true">

                            <!-- Begin testimonial item -->
                            <div class="testimonial-item text-gray-2">
                                <img src="assets/img/testimonial/client-1.png" alt="image">
                                <blockquote>
                                    <p>"Duis vel ligula non neque varius eleifend quis id elit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse lacus dui, pellentesque ut porta et, consequat sit amet suscipit lacus."</p>
                                    <small>Anna Clarkson</small>
                                </blockquote>
                            </div>
                            <!-- End testimonial item -->

                            <!-- Begin testimonial item -->
                            <div class="testimonial-item text-gray-2">
                                <img src="assets/img/testimonial/client-2.png" alt="image">
                                <blockquote>
                                    <p>"Maecenas sit amet diam iaculis, lobortis tortor sed, bibendum quam. Nam mauris odio, sodales interdum facilisis in, dignissim et massa. In suscipit quam nisi."</p>
                                    <small>John Smith</small>
                                </blockquote>
                            </div>
                            <!-- End testimonial item -->

                            <!-- Begin testimonial item -->
                            <div class="testimonial-item text-gray-2">
                                <img src="assets/img/testimonial/client-3.png" alt="image">
                                <blockquote>
                                    <p>"Proin at tincidunt leo. Morbi ut metus sit amet purus molestie sollicitudin. Maecenas convallis est vitae neque feugiat, in accumsan odio vestibulum. Pellentesque sodales fermentum porttitor."</p>
                                    <small>Jack Paterson</small>
                                </blockquote>
                            </div>
                            <!-- End testimonial item -->

                        </div>
                        <!-- End testimonials carousel -->

                    </div>
                    <!-- End testimonials -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->

    </section>
    <!-- End section test -->



    <!-- =================================
			///// Begin section clients (clients) /////
			================================== -->
    <section id="section-clients" class="clients-section">

        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="heading heading-md heading-uppercase heading-center heading-hover wow fadeIn">
                        <span class="heading-title-ghost">Friends of Monikos</span>
                        <h2 class="heading-title">Friends of Monikos</h2>
                        <hr class="hr-width-1 hr-5x border-main">
                        <!-- End divider -->

                        <p class="heading-tescription lead max-width-800 margin-auto">
                            Join Us
                        </p>
                    </div>
                    <!-- End heading -->

                </div>
                <!-- /.col -->

                <!-- Left column -->
                <div class="col-md-12 margin-top-60 wow fadeIn" data-wow-delay="0.3s">

                    <div class="owl-carousel clients-carousel dots-outside row" data-items="5" data-margin="40" data-tablet-landscape="4" data-tablet-portrait="3" data-mobile-landscape="2" data-mobile-portrait="1">
                        <!-- Begin carousel item
								========================= -->
                        <div class="cc-item">
                            <a target="_blank" href="" class="client"><img src="images/landing_page/cube.png" alt="image"></a>
                        </div>
                        <!-- End carousel item -->

                        <!-- Begin carousel item
								========================= -->
                        <div class="cc-item">
                            <a target="_blank" href="" class="client"><img src="images/landing_page/launch.png" alt="image"></a>
                        </div>
                        <!-- End carousel item -->

                    </div>
                    <!-- End content carousel -->

                </div>
                <!-- /.col-->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->

    </section>
    <!-- End section clients -->


    <!-- ================================
			///// Begin section 8 (contact) /////
			=====================================
			* Use class "angle-left-top", "angle-right-top", "angle-left-bottom", "angle-right-bottom" to change section angle.
			* Use class "bg-image-fixed" to make background image fixed (otherwise use class "bg-image").
			* Use class "bg-image-parallax" to enable background image parallax effect (otherwise use class "bg-image").
			* Use class "bg-pattern" if you use background patterns (example: http://subtlepatterns.com/). Combine with class "bg-image-fixed".
			-->
    <section id="section-contact" class="contact-section bg-dark bg-image-parallax" style="background-image: url(assets/img/misc/bg-1.jpg);">

        <!-- Element cover
				===================
				* Use background transparent color classes for colored opacity (example: "bg-transparent-6-dark", "bg-transparent-8-5-red" ... 1 to 95). Look into "helper.css" file for more info.
				-->
        <span class="cover bg-transparent-9-dark bg-transparent-gradient-1"></span>

        <div class="container">
            <div class="row wow fadeIn">

                <!-- Left column -->
                <div class="col-md-7">

                    <!-- Begin heading
							===================
							* Use class "heading-center" or "heading-right" to align heading.
							* Use class "heading-xs", "heading-sm", "heading-md", "heading-lg" or "heading-xlg" to shange heading size.
							* Use class "heading-hover" to enable heading hover effect.
							* Use class "heading-uppercase" to enable uppercase letters.
							-->
                    <div class="heading heading-md heading-uppercase heading-hover">
                        <span class="heading-title-ghost">Contact Us</span>
                        <h2 class="heading-title text-white">Contact Us</h2>

                        <!-- Begin divider
								===================
								* Use class "hr-width-1", "hr-width-2" -> up to "hr-width-10" to shange divider width.
								* Use class "hr-1x", "hr-2x", "hr-3x", "hr-4x" or "hr-5x" to shange divider size.
								* Use class "hr-dotted", "hr-dashed" or "hr-double" to shange divider style.
								-->
                        <hr class="hr-width-1 hr-5x border-main">
                        <!-- End divider -->

                        <p class="heading-tescription lead text-gray-2">
                            Pease feel free to eamil us if you have questions.
                        </p>
                    </div>
                    <!-- End heading -->

                </div>
                <!-- /.col -->

                <!-- Right column -->
                <div class="col-md-5 text-gray-2 padding-left-40">

                    <div class="contact-info">
                        <p><i class="fa fa-home"></i> 321 W Rosemary St, Chapel Hill, NC 27516</p>
                        <p><i class="fa fa-phone"></i> phone: +123 456 789 00</p>
                        <p><i class="fa fa-envelope"></i> <a href="mailto:company.email@info.com" target="_blank">monikos.llc@gmail.com</a></p>
                    </div>

                    <h5 class="margin-top-40 margin-bottom-20">Follow Us:</h5>

                    <!-- Begin social icons -->
                    <ul class="social-icons margin-bottom-20">
                        <li><a class="btn btn-social-min btn-white-bordered btn-lg" href="" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="btn btn-social-min btn-white-bordered btn-lg" href="" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="btn btn-social-min btn-white-bordered btn-lg" href="" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                        <li><a class="btn btn-social-min btn-white-bordered btn-lg" href="" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                        <li><a class="btn btn-social-min btn-white-bordered btn-lg" href="" target="_blank"><i class="fa fa-dribbble"></i></a></li>
                    </ul>
                    <!-- End social icons -->

                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">

                    <!-- Begin contact form
							========================= -->
                    <form id="contact-form" class="margin-top-80 text-white wow fadeIn" data-wow-delay="0.3s">

                        <!-- Begin hidden required fields (https://github.com/agragregra/uniMail) -->
                        <input type="hidden" name="project_name" value="monikos.org">
                        <!-- Change value to your site name -->
                        <input type="hidden" name="admin_email" value="monikos.llc@gmail.com">
                        <!-- Change value to your email address (where a message will be sent) -->
                        <input type="hidden" name="form_subject" value="MONIKOS CONTACT">
                        <!-- Change value to your own message subject -->
                        <!-- End Hidden Required Fields -->

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="text" class="form-control no-rounded" name="Name:" placeholder="Your Name" required="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="email" class="form-control no-rounded" name="Email:" placeholder="Your Email" required="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="text" class="form-control no-rounded" name="Subject:" placeholder="Subject" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea class="form-control no-rounded" name="Message:" rows="8" placeholder="Your Message (text only)" required=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">Send Message</button>
                            </div>
                        </div>
                    </form>
                    <!-- End contact form -->

                </div>
                <!-- /.col-->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->

    </section>
    <!-- End section 8 -->


    <!-- ===================
			///// Begin footer /////
			========================
			* Use class "angle-left-top" or "angle-right-top" to change footer top angle.
			-->
    <footer id="footer" class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright small">
                        <a href="#">MONIKOS</a>
                        <p>Copyright 2016 / All rights reserved</p>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </footer>
    <!-- End footer -->


    <!-- Scroll to top button -->
    <a href="#body-content" class="scrolltotop sm-scroll bg-main"><i class="fa fa-chevron-up"></i></a>

    </div>
    <!-- End body content -->






    <!-- ====================
		///// Scripts below /////
		===================== -->

    <!-- Core JS -->
    <script src="assets/vendor/jquery/jquery-1.11.1.min.js"></script>
    <!-- jquery JS (more info: https://jquery.com) -->
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- bootstrap JS (more info: http://getbootstrap.com) -->

    <!-- Libs and Plugins JS -->
    <script src="assets/vendor/ytplayer/js/jquery.mb.YTPlayer.min.js"></script>
    <!-- YTPlayer JS (more info: https://github.com/pupunzi/jquery.mb.YTPlayer) -->
    <script src="assets/vendor/wow.min.js"></script>
    <!-- WOW animations JS (more info: http://mynameismatthieu.com/WOW/index.html) -->
    <script src="assets/vendor/owl-carousel/js/owl.carousel.js"></script>
    <!-- Owl Carousel JS (more info: http://www.owlcarousel.owlgraphic.com) -->
    <script src="assets/vendor/owl-carousel/js/owl.carousel.plugins.js"></script>
    <!-- Owl Carousel plugins JS (more info: http://www.owlcarousel.owlgraphic.com) -->
    <script src="assets/vendor/magnific-popup/js/jquery.magnific-popup.min.js"></script>
    <!-- Magnific Popup JS (more info: http://dimsemenov.com/plugins/magnific-popup/) -->

    <script src="assets/vendor/isotope.pkgd.min.js"></script>
    <!-- isotope JS (more info: http://isotope.metafizzy.co) -->
    <script src="assets/vendor/imagesloaded.pkgd.min.js"></script>
    <!-- ImagesLoaded JS (https://github.com/desandro/imagesloaded) -->
    <script src="assets/vendor/smoothscroll.js"></script>
    <!-- YTPlayer JS (more info: https://gist.github.com/theroyalstudent/4e6ec834be19bf077298) -->
    <script src="assets/vendor/jquery.easing.min.js"></script>
    <!-- Easing JS (more info: http://gsgd.co.uk/sandbox/jquery/easing/) -->

    <!-- Theme master JS -->
    <script src="assets/js/theme.js"></script>

    <!-- Theme custom JS (all your JS customizations) -->
    <script src="assets/js/custom.js"></script>

    <!-- modal popup -->
    <script src="assets/vendor/jquery.leanModal.min.js"></script>
    <script type="text/javascript">
        $("#modal_trigger").leanModal({
            top: 200,
            closeButton: ".modal_close"
        });
        
        $(".modal_close").click(function(){
            $(".header_title").text('Login');
            $("#register_app").hide();
            $("#login_form").show();
        });

        $(function() {

            // Calling Register Form
            $("#register_button").click(function() {
                $("#errorMessage").hide();
                $("#login_form").hide();
                $("#register_app").show();
                $(".header_title").text('Register');
                return false;
            });

            //Going back to Login Forms
            $("#back_btn").click(function() {
                //$(".user_login").hide();
                $("#register_app").hide();
                $("#login_form").show();
                $(".header_title").text('Login');
                return false;
            });


            // $("#program").blur(function(){
            // 	// $("#school").addClass("wow fadeInUp")
            // 	$("#school").show();

            // 	return false;
            // });

            // $("#loginBtn").click(function(){
            // 	$("input [name='unVal']").attr("ng-model='unVal' ng-required='true'");
            // 	$("input [name='pwVal']").attr("ng-model='pwVal' ng-required='true'");

            // 	return false;
            // });


        })

    </script>

    <!--==============================
	   ///// Begin Google Analytics /////
	   ============================== -->

    <!-- Paste your Google Analytics code here.
	   Go to http://www.google.com/analytics/ for more information. -->

    <!--==============================
	   ///// End Google Analytics /////
	   ============================== -->
    <script src="/mvc/public/js/myCtrl.js"></script>
    <script src='/mvc/public/js/account/loginCtrl.js'></script>
    <script src='/mvc/public/js/account/accountCtrl.js'></script>

</body>
<!-- End body -->
