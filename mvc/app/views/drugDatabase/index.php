<!--Nik Gunawan-->

<body id="database_module">
    <script src="/mvc/public/js/drugDatabase/databaseCtrl.js"></script>

    <div ng-app="databaseApp" ng-controller="databaseCtrl">

        <div id=app_header>
            <a ng-click="home()"><button class = 'back'>Home</button></a>
            <a ng-click="database()"><button class = 'database'>Database</button></a>
            <a ng-click="study()"><button class = 'study'>Study</button></a>
            <a ng-click='home()'><img id="toplogo" src="/mvc/public/images/logo_without_words_version_1.png"></a>

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
                        <a href="#" onclick="logout()">
                            <div class=logout-btn>logout</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class = "search-bar form-group row">
        <form class="form-inline">
          <input class="newsearch-bar" type=text placeholder="What are you looking for?" ng-model=searchText[queryBy]>
          <select class="mb-2 mr-sm-2 mb-sm-0 search-by-drop-down" ng-model="queryBy">
              <option selected disabled value="$">Search By</option>
              <option value="$">All</option>
              <option value="Generic">Generic</option>
              <option value="Brand">Brand</option>
          </select>
        </form>
      </div> -->


        <!-- content -->

        <div id="content_wrapper">
            <br>
            <!--loading gif-->
            <div class="loadingDiv" ng-show="loading">
                <img class="loadingGif" src="/mvc/public/images/loading.gif">
            </div>
            <!--<div class="dark-load"></div>
            <div class="with-box" id="cssload-pgloading">
                <div class="cssload-loadingwrap">
                    <ul class="cssload-bokeh">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>-->

            <!-- <div id="search"> -->
            <div class="search-bar-wrapper">
                <form class="form-inline">

                    <select class="mb-2 mr-sm-2 mb-sm-0 search-by-drop-down" ng-model="queryBy">
                      <option selected disabled value="$">Search By</option>
                      <option value="$">All</option>
                      <option value="Generic">Generic</option>
                      <option value="Brand">Brand</option>
                  </select> &nbsp
                    <input class="newsearch-bar" type=text placeholder="What are you looking for?" ng-model=searchText[queryBy]>
                </form>
            </div>
            <!-- </div> -->

            <div class="drug-block" ng-click='showPopup("info" + x.DrugId);$event.stopPropagation()' ng-repeat="x in names | filter:searchText">
                <div class=drug-content>
                    <div class="visible-info">
                        <div class="drug-generic">
                            {{x.Generic}}
                            <audio id="{{'myAudio-' + x['Generic']}}">
                                <source src="{{x['Generic Audio'] | trustUrl}}" type="audio/wav">
                            </audio>
                            <div class=speaker-icon-wrapper>
                                <button ng-click="playAudio(x.Generic);$event.stopPropagation()" href=#><img src="/mvc/public/images/speaker.svg"></button>
                            </div>

                        </div>

                        <div class="hint-info">
                            <button ng-click='showPopup(x.DrugId);$event.stopPropagation()'>Hint</button>
                            <div class="button-shadow"></div>
                        </div>
                    </div>

                    <div style="visibility:hidden;" class='ng-modal show-{{x.DrugId}}'>
                        <div class='ng-modal-overlay' ng-click='$event.stopPropagation()'>
                            <!--creates black background overlay-->
                        </div>
                        <div class='ng-modal-dialog-hint' ng-click="$event.stopPropagation()">
                            <div class='ng-modal-close' ng-click='hidePopup(x.DrugId);$event.stopPropagation()'>X</div>

                            <div class='ng-modal-dialog-content'>
                                <div class=hint-message>
                                    <!--need trustAsHtml because mnemonic has html-->
                                    <div ng-bind-html="trustAsHtml(x.Mnemonic)"></div>
                                </div>
                                <div class=ng-modal-content-footer>
                                    <div class=plusone-wrapper>
                                        <!--for plus one animation-->
                                        <div style="display:none;" class="plusone-like d{{x.DrugId}}">+1</div>
                                        <div style="display:none;" class="plusone-dislike d{{x.DrugId}}">+1</div>
                                    </div>

                                    <div class=btn-wrapper ng-click="$event.stopPropagation()">
                                        <button class=like-btn ng-click="updateLikes(x.HintLikes, x.DrugId);$event.stopPropagation()"><div class="link-wrap"><img src=/mvc/public/images/thumb-up-button.png> Like</div></button> <button ng-click="updateDislikes(x.HintDislikes, x.DrugId);$event.stopPropagation()" class=dislike-btn><div class="link-wrap"><img src=/mvc/public/images/thumb-down-button.png>Dislike</div></button>
                                    </div>
                                    <div class=btn-shadow-wrapper>
                                        <!--button shadow effect-->
                                        <div class=like-btn-shadow></div>
                                        <div class=dislike-btn-shadow></div>
                                    </div>
                                    <div class=likes-dislikes-wrapper>
                                        <div class=likes-count>{{x.HintLikes}}</div>
                                        <div class=dislikes-count>{{x.HintDislikes}}</div>
                                    </div>
                                </div>

                                <div class=ng-modal-content-footer-bar>
                                    Do you have a better hint? <a class="earn200link" ng-click="showPopup2();$event.stopPropagation()">Earn 200 Capsules</a>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div style="visibility:hidden;" class='ng-modal show-info{{x.DrugId}}'>
                        <div class='ng-modal-overlay' ng-click='$event.stopPropagation()'>
                            <!--creates black background overlay-->
                        </div>
                        <div class='ng-modal-dialog' ng-click="$event.stopPropagation()">
                            <div class='ng-modal-close' ng-click='hidePopup("info" + x.DrugId);$event.stopPropagation()'>X</div>

                            <div class=expand-info>
                            <div class = "drug_inner" ng-model="collapsed_brand" ng-click='collapsed_brand=!collapsed_brand'>
                                <audio id="{{'myAudio-' + x['Brand']}}"> <source src="{{x['Brand Audio'] | trustUrl}}" type="audio/wav"></audio>
                                <div class="drug-info-wrap"><label>Brand:</label> </div>
                                 <div class="expand-info" ng-show="collapsed_brand">  &nbsp &nbsp &#8226 {{   x.Brand}}
                                    <div ng-click='$event.stopPropagation()' class=speaker-icon-wrapper><button ng-click="playAudio(x.Brand);$event.stopPropagation()" href=#><img src="/mvc/public/images/speaker.svg"></button></div>
                                </div>

                            </div>




                             <div class = "expand_info" ng-model="collapsed_class" ng-click='collapsed_class=!collapsed_class'>
                                <div class="drug-info-wrap"><label>Class:</label> </div>
                                 <div class="expand-info" ng-show="collapsed_class">   &#8226
                                {{x.Class}}</div>
                             </div>

                            <div class = "drug_inner" ng-model="collapsed_indi" ng-click='collapsed_indi=!collapsed_indi'>
                                <div class="drug-info-wrap"><label>Indication:</label> </div>
                                    <div class="expand-info" ng-show="collapsed_indi">
                                        <!-- ADULT PART -->
                                         <div class = "drug_inner" ng-model="collapsed_adult" ng-click='collapsed_adult=!collapsed_adult; collapsed_indi=True'>
                                            <div class="drug-info-wrap"><label>&#8226 ADULT:</label> </div>
                                            <div class="expand-info" ng-show="collapsed_adult">

                                                <div class = "drug_inner" ng-model="collapsed_AMI" ng-click='collapsed_AMI=!collapsed_AMI; collapsed_indi=True; collapsed_adult=True'>
                                                    <div class="drug-info-wrap"><label>Acute myocardial infarction:</label> </div>
                                                <div class="expand-info" ng-show="collapsed_AMI">   &#8226
                                                AMI</div>
                                                </div>

                                                <div class = "drug_inner" ng-model="collapsed_ADPKD" ng-click='collapsed_ADPKD=!collapsed_ADPKD; collapsed_indi=True; collapsed_adult=True'>
                                                    <div class="drug-info-wrap"><label>Autosomal dominant polycystic kidney:</label> </div>
                                                <div class="expand-info" ng-show="collapsed_ADPKD">   &#8226
                                                ADPKD</div>
                                                </div>

                                                <div class = "drug_inner" ng-model="collapsed_DN" ng-click='collapsed_DN=!collapsed_DN; collapsed_indi=True; collapsed_adult=True'>
                                                    <div class="drug-info-wrap"><label>Diabetic nephropathy:</label> </div>
                                                <div class="expand-info" ng-show="collapsed_DN">   &#8226
                                                DN</div>
                                                </div>

                                                <div class = "drug_inner" ng-model="collapsed_HF" ng-click='collapsed_HF=!collapsed_HF; collapsed_indi=True; collapsed_adult=True'>
                                                    <div class="drug-info-wrap"><label>Hear failure:</label> </div>
                                                <div class="expand-info" ng-show="collapsed_HF">   &#8226
                                                HF</div>
                                                </div>

                                                 <div class = "drug_inner" ng-model="collapsed_Hype" ng-click='collapsed_Hype=!collapsed_Hype; collapsed_indi=True; collapsed_adult=True'>
                                                    <div class="drug-info-wrap"><label>Diabetic nephropathy:</label> </div>
                                                <div class="expand-info" ng-show="collapsed_Hype">   &#8226
                                                Hype</div>
                                                </div>

                                                 <div class = "drug_inner" ng-model="collapsed_HT" ng-click='collapsed_HT=!collapsed_HT; collapsed_indi=True; collapsed_adult=True'>
                                                 <div class="drug-info-wrap"><label>Hypertension – Transplantation:</label> </div>
                                                <div class="expand-info" ng-show="collapsed_HT">   &#8226
                                                HT</div>
                                                </div>

                                                <div class = "drug_inner" ng-model="collapsed_KDN" ng-click='collapsed_KDN=!collapsed_KDN; collapsed_indi=True; collapsed_adult=True'>
                                                <div class="drug-info-wrap"><label>Kidney disease, Nondiabetic:</label> </div>
                                                <div class="expand-info" ng-show="collapsed_KDN">   &#8226
                                                KDN</div>
                                                </div>

                                                 <div class = "drug_inner" ng-model="collapsed_MP" ng-click='collapsed_MP=!collapsed_MP; collapsed_indi=True; collapsed_adult=True'>
                                                <div class="drug-info-wrap"><label>Migraine; Prophylaxis:</label> </div>
                                                <div class="expand-info" ng-show="collapsed_MP">   &#8226
                                                MP</div>
                                                </div>


                                            </div>
                                        </div>
                                        <!-- PEDIATRIC PART -->
                                        <div class = "drug_inner" ng-model="collapsed_P" ng-click='collapsed_P=!collapsed_P; collapsed_indi=True; collapsed_adult=True'>
                                                    <div class="drug-info-wrap"><label> &#8226 PEDIATRICS:</label> </div>
                                                <div class="expand-info" ng-show="collapsed_P">   &#8226
                                                P</div>
                                        </div>

                                    </div>

                            </div>

                             <div class = "drug_inner" ng-model="collapsed_ra" ng-click='collapsed_ra=!collapsed_ra'>
                                <div class="drug-info-wrap"><label>Renal Adjustments:</label> </div>
                                 <div class="expand-info" ng-show="collapsed_ra">   &#8226
                                RA</div>
                             </div>


                            <div class = "drug_inner" ng-model="collapsed_ha" ng-click='collapsed_ha=!collapsed_ha'>
                                <div class="drug-info-wrap"><label>Hepatic Adjustments:</label> </div>
                                 <div class="expand-info" ng-show="collapsed_ha">   &#8226
                                HA</div>
                             </div>


                             <div class = "drug_inner" ng-model="collapsed_se" ng-click='collapsed_se=!collapsed_se'>
                                <div class="drug-info-wrap"><label>Side Effects:</label> </div>
                                 <div class="expand-info" ng-show="collapsed_se">   &#8226
                                SE</div>
                             </div>

                             <div class = "drug_inner" ng-model="collapsed_moa" ng-click='collapsed_moa=!collapsed_moa'>
                                <div class="drug-info-wrap"><label>Mechanism of Action:</label> </div>
                                 <div class="expand-info" ng-show="collapsed_moa">   &#8226
                                MOA</div>
                             </div>

                            <div class = "drug_inner" ng-model="collapsed_bbw" ng-click='collapsed_bbw=!collapsed_bbw'>
                                <div class="drug-info-wrap"><label>Black Box Warning:</label> </div>
                                 <div class="expand-info" ng-show="collapsed_bbw">   &#8226
                                BBW</div>
                             </div>
                             </div>


                            <!--- ADD MORE DRUG INFO HERE!! -->
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!--SUGGESTION POPUP FORM-->
        <div class="suggestion-popup show2">
            <div class='ng-modal-close ng-modal-close-suggestion' ng-click='hidePopup2()'>X</div>
            <form method="post" action="../../../db/email_hint.php" id="mnemonic-form">
                <label>Username:</label><input name='name' type="text" value="{{getUser();}}">
                <label>Drug:                           </label>
                <select class=drug-form-list name='drug'>
                    <option ng-repeat="x in names">{{x.Generic}}</option>
                </select>
                <label>Mnemonic:</label>
                <textarea name='mnemonic' placeholder="Example"></textarea>
                <input type="submit" name="submit" id='submit' value="Submit">
                <div class="submit-shadow"></div>
            </form>
        </div>

    </div>

</body>
