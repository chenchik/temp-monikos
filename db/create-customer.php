<?php
require 'payment-server-init.php';
$customer= Braintree_Customer::create([
    'firstName' => $_POST['first'],
    'company' => 'Jones Co.',
    'email' => 'mike.jones@example.com',
    'phone' => '281.330.8004',
    'fax' => '419.555.1235',
    'website' => 'http://example.com'
]);

$customerId = $customer->customer->id;
echo $customerId;
?>
