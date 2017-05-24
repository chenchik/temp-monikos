<!-- Created by Danila Chenchik, Jenny Zhang, Joseph Son Monikos LLC -->

<body id="usr_mng_module">
    <script src = '/mvc/public/js/account/accountCtrl.js'></script>

    <div ng-app="myApp" ng-controller="accountCtrl" id="usr_mng_module">
        <div class="wrapper">
            <input id="un_reg" type="text" name="username" placeholder="username">
            <input id="email_reg" type="text" name="email" placeholder="email">
            <input id="pw_reg" type="password" name="password" placeholder="password">
            
            <select id="program" ng-click="findSchool()">
                <option selected disabled>select a program</option>
                <option ng-repeat="x in programs" id="a{{x.program}}" value="{{x.program}}">{{x.program}}</option>
            </select>
            
            <select id="school">
                <option selected disabled>select a school</option>
                <option ng-repeat="x in schoolnames" id="a{{x.schoolid}}" value="{{x.schoolid}}">{{x.schoolname}}</option>
            </select>
            
            <button ng-click="checkUsername()">Create Account</button>

            <a class="sub-link" ng-click="login()">Back to Login</a>

        </div>
    </div>

    <div id="errorMessage" style="display:none">
        <img id="errorLogo" src="/mvc/public/images/white_logo.png">

        <p class="errorText"></p>

        <div id='errorBtn'><button id="innerErrorBtn" class = "button button5">Okay</button></div>

   </div>
</body>
