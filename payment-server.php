<?php

require 'mvc/vendor/autoload.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('cfp2v7g7yy827vzn');
Braintree_Configuration::publicKey('hxc3czr9fqcpzqgg');
Braintree_Configuration::privateKey('61572dbf3f7d725ffe32e486f66a71c9');

$clientToken = Braintree_ClientToken::generate();
echo($clientToken);

?>