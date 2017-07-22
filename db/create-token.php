<?php
require 'payment-server-init.php';

$clientToken = Braintree_ClientToken::generate([
    "customerId" => $_POST['customerId']
]);

echo $clientToken;

?>