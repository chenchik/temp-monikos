<!-- Created by Dana Elhertani Monikos LLC -->

<head>
  <meta charset="utf-8">
	<meta name='viewport' content="width=device-width, initial-scale=1" />

    <script src = '/mvc/public/js/games/flashCtrl.js'></script>
    <link href="/mvc/public/css/metro-responsive.css" rel="stylesheet">
    <link href='/mvc/public/css/rotating-card.css' rel='stylesheet' />

   <title>Flashcard</title>

  <link rel="stylesheet" href="/mvc/public/css/flashcardstyle.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" media="screen" title="no title">

  <script>
    function gotoGamelist(){

        window.location = window.location.origin + "/mvc/public/games/menu/" +  "<?=$data['lid']?>";
    }

</script>

</head>

<body ng-app="myApp" ng-controller="flashCtrl" id="main_app_module">

	<div id=app_header>

	    <a onclick="gotoGamelist()" ><button class = 'backbtn'>Back</button></a>

       <a ng-click='home()'><img id="toplogo" src="/mvc/public/images/logo_without_words_version_1.png"></a>

            <div ng-if="firstLoad">{{getlid("<?=$data['lid']?>", false)}}</div>



        <div id = "toggle" onclick="toggleMenuNav()" class=menu-info>
        	<span id="updated-capsules-indicator" style="display:none;float:left"></span>
        	<img src=/mvc/public/images/icon_game.png>
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

        <br>

        <div class="container" style = "margin-top: 80px">
          <div class="progress" >
            <div id = "pb" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
              <div id = "percentpb">{{percent}} </div>
            </div>
          </div>
        </div>
        <div class="leftsign">
          <button class = "button button5" onclick="prevCard();" >
          <i class="fa fa-angle-left fa-5x" aria-hidden="true"  style="color:grey"></i>
          </button>
        </div>
        <div class="rightsign">
          <button id="nextBtn" class = "button button5" onclick="nextCard();">
          <i class="fa fa-angle-right fa-5x" aria-hidden="true" style="color:grey"></i>
          </button>
        </div>
<!-- <div class="stage">
  <div class="flashcard">
    <div class="front">
      <p id = "front" >{{front}}</p>
    </div>

    <div class="back">
      <p id = "back" >{{back}}</p>
    </div>

  </div>
</div> -->

<div class="tile-container" style="width:85%;margin-left:15%;margin-top:2%;margin-bottom:10%;">

    <div class="tile-small tile-square-x  flip manual-flip" data-role="tile">
      <div class="card" onclick="rotateCard(this)">
          <div class="front card-small bg-lightGreen">
              Brand
          </div>
          <div class="back card-small bg-lightGreen">
                  <h5>Brand shows up here</h5>
          </div>
      </div>
    </div>
    <div class="tile-small tile-wide-x  flip manual-flip" data-role="tile">
      <div class="card" onclick="rotateCard(this)">
          <div class="front card-small bg-lightRed">
              Generic
          </div>
          <div class="back card-small bg-lightRed">
                  <h5>Generic shows up here</h5>
          </div>
      </div>
    </div>
    <div class="tile-small tile-big-x  flip manual-flip" data-role="tile">
      <div class="card" onclick="rotateCard(this)">
          <div class="front card-small bg-orange">
              Class
          </div>
          <div class="back card-small bg-orange">
                  <h5>Class shows up here</h5>
          </div>
      </div>
    </div>
    <div class="tile-large tile-wide-x tile-super-y flip manual-flip" data-role="tile">
      <div class="card" onclick="rotateCard(this)">
          <div class="front card-super bg-lighterBlue">
              Indication
          </div>
          <div class="back card-super bg-lighterBlue">
                  <h5>Indication shows up here</h5>
          </div>
      </div>
    </div>
    <div class="tile-big tile-wide-x tile-wide-y  flip manual-flip" data-role="tile">
      <div class="card" onclick="rotateCard(this)">
          <div class="front card-wide bg-cyan">
              Side Effect
          </div>
          <div class="back card-wide bg-cyan">
                  <h5>Side Effect shows up here</h5>
          </div>
      </div>
    </div>
    <div class="tile tile-wide-x  flip manual-flip" data-role="tile">
      <div class="card" onclick="rotateCard(this)">
          <div class="front card-normal bg-lightGreen">
              MDA
          </div>
          <div class="back card-normal bg-lightGreen">
                  <h5>MDA shows up here</h5>
          </div>
      </div>
    </div>
    <div class="tile tile-wide-x flip manual-flip" data-role="tile">
      <div class="card" onclick="rotateCard(this)">
          <div class="front card-normal bg-lightRed">
              BBW
          </div>
          <div class="back card-normal bg-lightRed">
                  <h5>BBW shows up here</h5>
          </div>
      </div>
    </div>
    <div class="tile-wide tile-wide-x flip manual-flip" data-role="tile">
      <div class="card" onclick="rotateCard(this)">
          <div class="front card-wide bg-orange">
              Hepatic
          </div>
          <div class="back card-wide bg-orange">
                  <h5>Hepatic shows up here</h5>
          </div>
      </div>
    </div>
    <div class="tile-wide tile-wide-x flip manual-flip" data-role="tile">
      <div class="card" onclick="rotateCard(this)">
          <div class="front card-wide bg-lightGreen">
              Renal
          </div>
          <div class="back card-wide bg-lightGreen">
                  <h5>Renal shows up here</h5>
          </div>
      </div>
    </div>

</div>

<script type="text/javascript">

    function rotateCard(btn){
        var $card = $(btn).closest('.flip');
        console.log($card);
        if($card.hasClass('hover')){
            $card.removeClass('hover');
        } else {
            $card.addClass('hover');
        }
    }
</script>



<!--  <div class = 'btn_footer'>
	<div class='btn_wrap'>
		<div class='submit_btn'><button class = "button button5" onclick="prevCard();" > < </button></div>
		<div class='next_btn'><button id="nextBtn" class = "button button5" onclick="nextCard();"> > </button></div>
	</div>
</div> -->

</body>
