<!-- Created by Dana Elhertani Monikos LLC -->

<head>
  <meta charset="utf-8">
	<meta name='viewport' content="width=device-width, initial-scale=1" />

    <script src = '/mvc/public/js/games/flashCtrl.js'></script>

   <title>Flashcard</title>

  <link rel="stylesheet" href="/mvc/public/css/flashcardstyle.css">

  <script>
    function gotoGamelist(){
        window.location = window.location.origin + "/mvc/public/games/menu/" +  <?=$data['lid']?>;
    }

</script>

</head>

<body ng-app="myApp" ng-controller="flashCtrl" id="main_app_module">

	<div id=app_header>

	    <a onclick="gotoGamelist()" ><button class = 'backbtn'>Back</button></a>

       <a ng-click='home()'><img id="toplogo" src="/mvc/public/images/logo_without_words_version_1.png"></a>

            <div ng-if="firstLoad">{{getlid(<?=$data['lid']?>, false)}}</div>



        <div id = "toggle" onclick="toggleMenuNav()" class=menu-info>
        	<span id="updated-capsules-indicator" style="display:none;float:left"></span>
        	<img src=/mvc/public/images/dc_settings.png>
        </div>
        <div id='menu-popup' class='menu-popup'>
            <div class=notif-info>
                <h2>Front</h2>
                <form action="">
					<input id="fBrand" type="checkbox" name="vehicle" value="Brand"checked >Brand<br>
					<input id="fGeneric" type="checkbox" name="vehicle" value="Generic" >Generic<br>
					<input id="fClass" type="checkbox" name="vehicle" value="Class" >Class<br>
					<input id="fIndication" type="checkbox" name="vehicle" value="Indication" >Indication<br>
					<input id="fBlackBoxWarning" type="checkbox" name="vehicle" value="BlackBoxWarning" >Black Box Warning<br>

				</form>
            </div>
            <div class=notif-info>
                <h2>Back</h2>
                <form action="">
					<input id="bBrand" type="checkbox" name="vehicle" value="Brand" >Brand<br>
					<input id="bGeneric" type="checkbox" name="vehicle" value="Generic" checked>Generic<br>
					<input id="bClass" type="checkbox" name="vehicle" value="Class">Class<br>
					<input id="bIndication" type="checkbox" name="vehicle" value="Indication">Indication<br>
					<input id="bBlackBoxWarning" type="checkbox" name="vehicle" value="BlackBoxWarning">Black Box Warning<br>
				</form>
		    <input type="button" value="Submit" onclick = "redo()"/>


            </div>
        </div>

	</div>

        <div id="completeMessage" style="display:none">
            <p id="completeMessageText">Congratulations, you finished this round. </p>
        </div>


        <div class="container" style = "margin-top: 80px">
          <div class="progress" >
            <div id = "pb" class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
              <div id = "percentpb">{{percent}} </div>
            </div>
          </div>
        </div>

<div class="stage"  >
  <div class="flashcard">
    <div class="front">
      <p id = "front" >{{front}}</p>
    </div>

    <div class="back">
      <p id = "back" >{{back}}</p>
    </div>

  </div>
</div>

 <div class = 'btn_footer'>
	<div class='btn_wrap'>
		<div class='submit_btn'><button class = "button button5" onclick="prevCard();" > < </button></div>
		<div class='next_btn'><button id="nextBtn" class = "button button5" onclick="nextCard();"> > </button></div>
	</div>
</div>

</body>
