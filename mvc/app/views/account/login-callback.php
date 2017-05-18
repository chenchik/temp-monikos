<?php

//Created by Danila Chenchik Monikos LLC

session_start();
require_once __DIR__ . '/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '116488348813741',
  'app_secret' => '6e84eeccc1b6c5681573168f3975a3ba',
  'default_graph_version' => 'v2.7'
]);

$helper = $fb->getJavaScriptHelper();

try {
  $accessToken = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
}

if (isset($accessToken)) {
   $fb->setDefaultAccessToken($accessToken);

  try {
  
    $requestProfile = $fb->get("/me?fields=name,email");
    $profile = $requestProfile->getGraphNode()->asArray();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
  }

  //$_SESSION['name'] = $profile['FBSessionName']; //sessional variable stored as users name
  
  setcookie('FBname', $profile['name'], time() + (3600 * 8), "/dj/javascriptDJ/"); //expires in 8 hours
  setcookie('FBid', $profile['id'], time() + (3600 * 8), "/dj/javascriptDJ/");
  header('location: ../');
  exit;
} else {
    echo "Unauthorized access!!!";
    exit;
}
