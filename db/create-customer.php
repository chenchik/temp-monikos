<?php
require 'payment-server-init.php';
require 'db_init.php';

$customer = $client->monikos->Users->findOne(["username"=>$_POST['first']]);
$currentCustomerId = $customer['customerId'];

//creates a new customer ONLY if user not yet registered as customer
if ($currentCustomerId == null){
$customer = Braintree_Customer::create([
    'firstName' => $_POST['first'],
]);

$newCustomerId = $customer->customer->id;
$insertCustomerId = $client->monikos->Users->updateOne(
    ["username"=>$_POST['first']],
    ['$set' => ["customerId" => $newCustomerId]]);
$insertBraintreeInfo = $client->monikos->Users->updateOne(
    ["username"=>$_POST['first']],
    ['$set'=>
        ['braintree_subscription_info' => 
            [
                'planId'=>null,
                'subscriptionId'=>null,
                'billingPeriodStartDate' => null,
                'billingPeriodEndDate' => null,
                'subscriptionStatus' => 'Inactive'
            ]
        ]
    ]
);
    echo $newCustomerId;
} else {
    echo $currentCustomerId;
}
?>
