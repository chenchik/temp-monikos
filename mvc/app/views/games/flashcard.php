<!-- Created by Zhenwei Zhang Monikos LLC -->

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
function gotoGamelist(lid){
  var lid = lid;
  window.location = window.location.origin + "/mvc/public/games/menu/" + lid;
}
</script>

</head>

<body ng-app="myApp" ng-controller="flashCtrl" id="main_app_module" style="width:1060px;">

	<div id=app_header>

	    <a onclick='gotoGamelist("<?=$data['lid']?>")' ><button class = 'backbtn'>Back</button></a>

       <a ng-click='home()'><img id="toplogo" src="/mvc/public/images/logo_without_words_version_1.png"></a>

            <div ng-if="firstLoad">{{getlid("<?=$data['lid']?>", false)}}</div>
	</div>

        <div id="completeMessage" style="display:none">
            <p id="completeMessageText">Congratulations, you finished this round. </p>
        </div>

        <br>

        <div class="container" style = "margin-top: 55px;margin-left:160px;">
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

<div class="tile-container" style="width:100%;margin-left:24%;margin-top:12px;margin-bottom:10%;">

    <div class="tile-small tile-wide-x  flip manual-flip" data-role="tile">
      <div class="card" onclick="rotateCard(this)">
          <div class="front card-small">
              Brand
          </div>
          <div class="back back-card-small">
                  <h5 id="brand_b">Brand shows up here</h5>
          </div>
      </div>
    </div>
    <div class="tile-small tile-wide-x  flip manual-flip" data-role="tile">
      <div class="card" onclick="rotateCard(this)">
          <div class="front card-small">
              Generic
          </div>
          <div class="back back-card-small">
                  <h5 id="generic_b">Generic shows up here</h5>
          </div>
      </div>
    </div>
    <div class="tile-small tile-wide-x  flip manual-flip" data-role="tile">
      <div class="card" onclick="rotateCard(this)">
          <div class="front card-small">
              Class
          </div>
          <div class="back back-card-small">
                  <h5 id="class_b">Class shows up here</h5>
          </div>
      </div>
    </div>
    <div class="column-section clear">
      <div class="column">
        <div class="tile-large tile-wide-x tile-super-y flip manual-flip" data-role="tile">
          <div class="card" onclick="rotateCard(this)">
              <div class="front card-super">
                  Indication
              </div>
              <div class="back back-card-super">
                      <h5 id="indication_b">Indication shows up here</h5>
              </div>
          </div>
        </div>
      </div>

      <div class="column">
        <div class="tile-big tile-wide-x tile-big-y  flip manual-flip" data-role="tile">
          <div class="card" onclick="rotateCard(this)">
              <div class="front card-big">
                  Side Effects
              </div>
              <div class="back back-card-big">
                      <h5 id="sideEffect_b">Side Effect shows up here</h5>
              </div>
          </div>
        </div>
        <div class="tile tile-wide-x flip manual-flip" data-role="tile">
          <div class="card" onclick="rotateCard(this)">
              <div class="front card-normal">
                  Hepatic Adjustment
              </div>
              <div class="back back-card-normal">
                      <h5 id="hepatic_b">Hepatic shows up here</h5>
              </div>
          </div>
        </div>

      </div>
      <div class="column">
        <div class="tile tile-wide-x  flip manual-flip" data-role="tile">
          <div class="card" onclick="rotateCard(this)">
              <div class="front card-normal ">
                  Mechanism of Action
              </div>
              <div class="back back-card-normal">
                      <h5 id="moa_b">MOA shows up here</h5>
              </div>
          </div>
        </div>
        <div class="tile tile-wide-x flip manual-flip" data-role="tile">
          <div class="card" onclick="rotateCard(this)">
              <div class="front card-normal">
                  Black Box Warning
              </div>
              <div class="back back-card-normal">
                      <h5 id="bbw_b">BBW shows up here</h5>
              </div>
          </div>
        </div>
        <div class="tile-wide tile-wide-x flip manual-flip" data-role="tile">
          <div class="card" onclick="rotateCard(this)">
              <div class="front card-wide">
                  Renal Adjustment
              </div>
              <div class="back back-card-wide">
                      <h5 id="renal_b">Renal shows up here</h5>
              </div>
          </div>
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
