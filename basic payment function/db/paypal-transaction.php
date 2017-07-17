<?php
require 'payment-server-init.php';

$result = Braintree_Transaction::sale([
    "amount" => 2.99,
    "paymentMethodNonce" => $_POST['nonce']
    
    /*"options" => [
      "paypal" => [
        "customField" => $_POST["PayPal custom field"],
        "description" => $_POST["Description for PayPal email receipt"],
      ],
    ],*/
]);
if ($result->success) {
  echo "Success ID: " . $result->transaction;
} else {
  echo "Error Message: " . $result->message;
}
?>