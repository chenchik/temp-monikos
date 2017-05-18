<!-- Created by Danila Chenchik, Jenny Zhang Monikos LLC -->

Hello <?=$data['name']?>

<body>
	<p>Email: <?=$data['email']?></p>

	<script src = '/mvc/public/js/account/index_accountCtrl.js'></script>

    <div ng-app="myApp" ng-controller="accountCtrl">
        <div>
            <input id="un" type="text" name="username">
            <input id="email" type="text" name="email">
            <input id="pw" type="text" name="password">
            <button ng-click="createAccount()">submit</button>
            <p>username: {{response.data[0].username}}</p>
            <p>email: {{response.data[0].email}}</p>
        </div>
        <a href="../../mvc/public">login</a>
    </div>
</body>
