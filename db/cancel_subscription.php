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
    $planId = $current['planId'];
    
    $begin = $current['billingPeriodStartDate']['date'];
    $expiration = DateTime::createFromFormat('Y-m-d h:i:s.u',$begin);
    $begin = $expiration->format('F dS Y');
     
    $expiration = $current['billingPeriodEndDate']['date'];
    $expiration = DateTime::createFromFormat('Y-m-d h:i:s.u',$expiration);
    $expiration = $expiration->format('F dS Y');
    
    if($planId == 'month'){
        $planId = 'monthly';
    }  
    echo "Your ".$planId." subscription has been cancelled. You will mantain access to premium features until " . $expiration;
} else {
    $updateExpired=$client->monikos->Users->updateOne(
        ["customerId"=>$_POST['customerId']],
        ['$set'=>["premium"=>false]]
    );
    echo "subscription has expired";
}


?>
