<?php

require 'payment-server-init.php';
require 'db_init.php';

$nonceFromTheClient = $_POST["nonce"];
$customer = $client->monikos->Users->findOne(['customerId'=>$_POST['customerId']]);
$subscriptionStatus = $customer['braintree_subscription_info']['subscriptionStatus'];

if($subscriptionStatus != "ACTIVE"){
//creates the subscription with specified plan
$result = Braintree_Subscription::create([
  "paymentMethodNonce" => $nonceFromTheClient,
  'planId' => "".$_POST['plan']
]);
//inserts the planId, subscriptionId, subscriptionStartDate+endDate, to the user in the db
$newSubscriptionId = $result -> subscription -> id;
$billingStart = $result -> subscription -> billingPeriodStartDate;
$billingEnd = $result -> subscription -> billingPeriodEndDate;
$billingStatus = $result -> subscription -> status;

$insertBraintreeInfo = $client->monikos->Users->updateOne(
    ['customerId' => $_POST['customerId']],
    ['$set'=>
        ['braintree_subscription_info' => 
            [
                'planId'=>$_POST['plan'],
                'subscriptionId'=>$newSubscriptionId,
                'billingPeriodStartDate' => $billingStart,
                'billingPeriodEndDate' => $billingEnd,
                'subscriptionStatus' => $billingStatus
            ]
        ]
    ]
);
}
    
//inserts the s

//echo "Successfully subscribed to ". $_POST['plan']. " plan";
?>
