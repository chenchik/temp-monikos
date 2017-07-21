<?php
require 'payment-server-init.php';

$nonceFromTheClient = $_POST["nonce"];

$result = Braintree_Subscription::create([
  "paymentMethodNonce" => $nonceFromTheClient,
  'planId' => "".$_POST['plan']
]);


echo "Successfully subscribed to ". $_POST['plan']. " plan";

?>