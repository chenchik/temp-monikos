<?php

require 'payment-server-init.php';

$nonceFromTheClient = $_POST["nonce"];

$result = Braintree_Transaction::sale([
  'amount' => $_POST['amount'],
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