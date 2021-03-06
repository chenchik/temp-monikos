<!-- Created by Zhenwei Zhang Monikos LLC -->


<link rel="stylesheet" type="text/css" href="/mvc/public/css/listM.css">
<!-- <link rel="stylesheet" type="text/css" href="/mvc/public/css/modal/component.css"> -->


<meta name='viewport' content="width=device-width, initial-scale=1" />

<script src = '/mvc/public/js/listManager/listManagerFunctions.js'>
</script>
    <script src = '/mvc/public/js/payment/paymentCtrl.js'></script>

<style media="screen">
#modal-background {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: white;
  opacity: .50;
  -webkit-opacity: .5;
  -moz-opacity: .5;
  filter: alpha(opacity=50);
  z-index: 1000;
}

#modal-content {
  background-color: white;
  border-radius: 10px;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  box-shadow: 0 0 20px 0 #222;
  -webkit-box-shadow: 0 0 20px 0 #222;
  -moz-box-shadow: 0 0 20px 0 #222;
  display: none;
  height: 240px;
  left: 50%;
  margin: -120px 0 0 -160px;
  padding: 10px;
  position: absolute;
  top: 50%;
  width: 320px;
  z-index: 1000;
}

#modal-background.active, #modal-content.active {
  display: block;
}
    
.drug {
    font-family: 'Raleway',sans-serif;
    text-align:center;
    margin-left:20px;           
}
    
[id^="view-list"] {
    display:none;
}
</style>


<body ng-app="myApp" ng-controller="myCtrl" id="main_app_module">

  <div id=app_header>
      <a onclick="home()"><button class = 'back'>Home</button></a>
      <a onclick="drugDatabase()"><button class = 'database'>Database</button></a>
      <a ng-click="listManager()"><button class = 'study'>Study</button></a>
      <a onclick = 'home()'><img id="toplogo" src="/mvc/public/images/logo_without_words_version_1.png"></a>
      <a style="display: none" id="payment" ng-click="payment()"><button class = 'upgrade'>Upgrade</button></a>
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
              <img src="/mvc/public/images/landing_page/logo2.png">
              <div class=user-info-sub>
                  <div class=username-info>{{capsules[0].username}}</div>
                  <div class=email-info>({{capsules[0].email}})</div>
                  <div class=capsule-info>{{capsules[0].capsules}} Capsules</div>
                  <!--test cancel subscription button -->
                                                <a onclick="cancel()" ng-show="premium" style="color: #CCC;font-size: 10px;cursor: pointer;">Cancel Subscription</a>
                                            <!-- end --->
                  <a href="#" onclick="logout()"><div class=logout-btn>logout</div></a>
              </div>
          </div>
      </div>
  </div>




    <div id='app_content'>

        <div class='add-list-block'>
            <!--create new list button go here -->

            <button class="listButton" onclick="openNav()">
                <label>CREATE NEW LISTS</label>
            </button>
            <input type="search" class="form-control listButton" id="searchlist" placeholder="SEARCH LISTS">
        </div>

        <div id="errorMessage" style="display:none">
            <p id="errorMessageText">You haven't selected a list.</p>
            <div class="errorButton" id="errorButton">OKAY</div>
        </div>

        <h1 class="list-m-header your-list">Your List</h1>
        <hr class="hr-red">
        <div class='custom-list-collection-block'>
            <div ng-class="list_block" class="list_block" ng-repeat="list in lists track by $index">
                <h1 class = "list_name_header">
                    {{list.name}}</h1>
                <br>
                
                <div id="view-list-{{list.list_id}}" >
                    <p class="drug" ng-repeat="drug in drugList" >
                        {{drug}} <br>
                    </p>
                </div>
                
            
                <br>
                <button class ='selectList' ng-click='selectList($index)'>SELECT</button>
                <button id="deleteList" class='deleteList' ng-click='deleteList($index)' ng-show="premium">DELETE</button>
                <!-- <button id='viewList'>VIEW</button>

                <div id="modal-background"></div>
                <div id="modal-content">
                    <button id="modal-close">Close Modal Window</button>
                </div> -->
                <button id="button-view-{{list.list_id}}" ng-click='viewList(list.list_id)'>VIEW</button>

                <div id="modal-background"></div>
                <div id="modal-content">
                </div>

            </div>
        </div>

        <br>
        <br>
        <h1 class="list-m-header clear">School's List</h1>
        <!-- <button class="md-trigger" data-modal="modal-8">Fade</button>

        <div class="md-modal md-effect-9" id="modal-8">
          <div class="md-content">
            <h3>Modal Dialog</h3>
            <div>
              <p>This is a modal window. You can do the following things with it:</p>
              <ul>
                <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget to read what they say.</li>
                <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and appreciate its presence.</li>
                <li><strong>Close:</strong> click on the button below to close the modal.</li>
              </ul>
              <button class="md-close">Close me!</button>
            </div>
          </div>
        </div> -->

        <hr class="hr-red">

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

                <br>

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
                                        <div class="item col-xs-3 col-sm-3">
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

<!-- LIST CREATOR END -->

    </div>

    <div class = 'play' ng-click="launchGame()">
        <p>PLAY</p>
        <br>
    </div>


    <!-- <script src='/mvc/public/js/modal/classie.js'></script>
    <script src='/mvc/public/js/modal/modalEffects.js'></script>  -->

</body>
