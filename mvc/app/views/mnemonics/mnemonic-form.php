<!-- Created by Nik Gunawan Monikos LLC -->

  <body id="database_module">
        <script src = '/mvc/public/js/Mnemonics/Mnemonics.js'></script>

        <div ng-app="myApp" ng-controller="customersCtrl">
            <form id="mnemonic-form">
            <label>Name:<input type="text" placeholder="Name"></label>
            <label>Drug:<select>
                <option ng-repeat="x in names">{{x.Generic}}</option>

                </select>
                </label>
                <label>Mnemonic:</label>
                <textarea placeholder="Example"></textarea>

                <button type="submit">Submit</button>
            </form>


    </body>
