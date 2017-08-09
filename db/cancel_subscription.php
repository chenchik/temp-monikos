<?php
require 'payment-server-init.php';
require 'db_init.php';

$current = $client->monikos->Users->findOne(['customerId'=> $_POST['customerId']]);
$current = $current['braintree_subscription_info'];

if(!isset($_POST['isExpired']) or $_POST['isExpired']==false){
//cancels subscription
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
    echo "subscription with id".$current['subscriptionId']."has been cancelled and will expire on " . $current['billingPeriodEndDate']['date'];
} else {
    $updateExpired=$client->monikos->Users->updateOne(
        ["customerId"=>$_POST['customerId']],
        ['$set'=>["premium"=>false]]
    );
    echo "subscription has expired";
}


?>
