<?php

$dir = '../../../../../root/vendor/';
require_once $dir . 'autoload.php';
require_once '/var/www/html/mvc/braintree-php-3.23.1/lib/Braintree.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('cfp2v7g7yy827vzn');
Braintree_Configuration::publicKey('hxc3czr9fqcpzqgg');
Braintree_Configuration::privateKey('61572dbf3f7d725ffe32e486f66a71c9');

?>