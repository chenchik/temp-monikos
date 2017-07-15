<?php

require 'payment-server.php';

$nonceFromTheClient = $_POST["nonce"];

$result = Braintree_Transaction::sale([
  'amount' => '10.00',
  'paymentMethodNonce' => $nonceFromTheClient,
'options' => [
    'submitForSettlement' => True
  ]
]);


echo ($result->success);

$transaction = $result->transaction;
$transaction->paymentInstrumentType == Braintree_PaymentInstrumentType::CREDIT_CARD;

echo ($transaction);

?>