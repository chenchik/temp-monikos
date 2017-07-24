<?php
require 'payment-server-init.php';
require 'db_init.php';

$current = $client->monikos->Users->findOne(['customerId'=> $_POST['customerId']]);
$current = $current['braintree_subscription_info'];

//cancels subscription
echo $current['subscriptionId'];
$cancel = Braintree_Subscription::cancel($current['subscriptionId']);

//updates database
$update= $client->monikos->Users->updateOne(
    ["customerId"=>$_POST['customerId']],
    ['$set'=>
        ['braintree_subscription_info' => 
            [
                'planId' => $current['planId'],
                'subscriptionId' => $current['subscriptionId'],
                'billingPeriodStartDate' => $current['billingPeriodStartDate'],
                'billingPeriodEndDate'=> $current['billingPeriodEndDate'],
                'subscriptionStatus'=>'Cancelled'
            ]
        ]
    ]
);


?>