<!-- Created by Danila Chenchik, Jenny Zhang Monikos LLC -->
    <body ng-app="loginApp" ng-controller="loginCtrl"  id="usr_mng_module">
        <div id="loginIconContainer">
            <img id="loginIcon" src="/mvc/public/images/monikos_login_icon.png">
        </div>
        
        <div class="dark-load" ng-show="loading"></div>
        <div id="cssload-pgloading" ng-show="loading">
            <div class="cssload-loadingwrap">
                <ul class="cssload-bokeh">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </div>
        <div class="wrapper">
            <input id="un" type="text" placeholder="username">
            <input id="pw" type="password" placeholder="password">
            <button ng-click="login()">Login</button>
            <a class=sub-link ng-click="create()">Create Account</a>
        </div>
        <div id="errorMessage" style="display:none">
            <img id="errorLogo" src="/mvc/public/images/white_logo.png">

            <p class="errorText"></p>

            <div id='errorBtn'><button id="innerErrorBtn" class = "button button5">Okay</button></div>

       </div>

    </body>
<script src ='/mvc/public/js/account/loginCtrl.js' ></script>