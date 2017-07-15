<?php

require 'mvc/vendor/autoload.php';

$nonceFromTheClient = $_POST["nonce"];

$result = Braintree_Transaction::sale([
  'amount' => '10.00',
  'paymentMethodNonce' => $nonceFromTheClient,
]);

echo ($result->success);

$transaction = $result->transaction;
$transaction->paymentInstrumentType == Braintree_PaymentInstrumentType::CREDIT_CARD;

echo ($transaction);

?>