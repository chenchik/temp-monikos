<!-- Created by Jenny Zhang, Nik Gunawan Monikos LLC -->

<link rel="stylesheet" type="text/css" href="/mvc/public/css/listM.css">

<meta name='viewport' content="width=device-width, initial-scale=1" />

<script src = '/mvc/public/js/listManager/listManagerFunctions.js'></script>


<body ng-app="myApp" ng-controller="myCtrl" id="main_app_module">

    <div id='app_header'>
        <a href = '#' ng-click='home()'><button class = 'back'>Back</button></a>
        <a href ="#" ng-click="home()"><img id="toplogo" src="/mvc/public/images/logo_without_words_version_1.png"></a>

        <div onclick="toggleMenuNav()" class=menu-info>
            <span id="notificationIndicator"></span>
            <img src=/mvc/public/images/man-user.png>
        </div>
        <div id='menu-popup' class='menu-popup'>
            <div class=notif-info>
                <h2>Notifications</h2>
                <p id="noNotificationsText">There are no notifications at this moment.</p>
                <div style="display:none" id="notificationsBlock">
                    <!--append notifications in here-->
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




    <div id='app_content'>

        <div class='add-list-block'>
            <!--create new list button go here -->

            <button onclick="openNav()">
                <label>CREATE NEW LIST</label>
            </button>
        </div>

        <div id="errorMessage" style="display:none">
            <p id="errorMessageText">You haven't selected a list.</p>
            <div class="errorButton" id="errorButton">OKAY</div>
        </div>

        <h1 class="list-m-header your-list">Your List</h1>
        <div class='list-collection-block custom-list-collection-block'>
            <div ng-class="list_block" class="list_block" ng-repeat="list in lists track by $index">

                <h1 class = "list_name_header">
                    {{list.name}}</h1>

                <div class='list-info-block' >
                    <div class='list-drugs'>
                        {{list.drugs}}
                        <br>
                    </div>
                </div>

                <!--<button class ='select' ng-click='selectlist($index, this)'>SELECT</button>-->
                <button class ='selectList' ng-click='selectList($index)'>SELECT</button>

                <button class='deleteList' ng-click='deleteList($index)'>DELETE LIST</button>
            </div>

        </div>

        <h1 class="list-m-header school-list">School's List</h1>

        <div class='list-collection-block'>

            <div ng-class="list_block" class="list_block" ng-repeat="list2 in school_lists track by $index">

                <h1 class = "list_name_header">
                    {{list2.name}}</h1>

                <div class='list-info-block' >
                    <div class='list-drugs'>
                        {{list2.drugs}}
                        <br>
                    </div>
                </div>

                <!--<button class ='select' ng-click='selectlist($index, this)'>SELECT</button>-->
              <button class ='selectList' ng-click='selectSchoolList($index)'>SELECT</button>

            </div>

        </div>

        <!-------LIST CREATOR--------->

        <!-- The overlay -->
        <div id="createList_overlay" class="overlay">

            <!-- Button to close the overlay navigation -->
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

            <!-- Overlay content -->
            <div class="overlay-content">
                <div class ='text-container'>
                    <div class=field-name>LIST TITLE: </div>
                    <input id = 'listName' ng-model=listform.name type="text" required>
                </div>
                <!-------LIST CREATOR--------->
                <div class="list-container">
                    <div class="form-group">
                        <div class="col-xs-8 col-sm-8 col-xs-offset-2 col-sm-offset-2">
                            <input type="search" class="form-control" id="search" placeholder="Search for your drug..">
                        </div>
                    </div>
                    <div class = 'drug-container'>
                        <div class="form-group">
                            <div class="searchable-container">

                                <div class= 'scrollableCreateDrugList'>

                                    <div ng-repeat="drug in drugs">
                                        <div class="item col-xs-6 col-sm-6">
                                            <div class = 'checkboxes'>

                                                <input type="checkbox" name="var_id[]" autocomplete="off" checklist-model="listform.drugs" checklist-value="drug.Generic" id='drug-{{$index}}' required>

                                                <label class = 'drug_name' for = 'drug-{{$index}}'>{{drug.Generic}}</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button id ='addbtn' ng-click=addList()>Add List</button>

            </div> <!--overlay content end-->

        </div><!--overlay end-->

        <!-------LIST CREATOR END--------->

    </div>

    <div class = 'play' ng-click="launchGame()">
        <p>PLAY</p>
    </div>

</body>
