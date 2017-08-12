<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';
require_once 'payment-server-init.php';
$collection = $client->monikos->Users;

$cust = $_POST['customerId'];
$customer = $collection -> findOne(["customerId" => $cust]);
$isPremium = $customer -> premium;
$current = $customer['braintree_subscription_info'];

$subscriptionId = $current['subscriptionId'];
$subscription_info = Braintree_Subscription::find($subscriptionId);

$paidThroughDate = $subscription_info -> paidThroughDate;

$paidThroughDate_string = $paidThroughDate->format('Y-m-d h:i:s.u');

if($isPremium==true){
    date_default_timezone_set('UTC');
    $today = date("Y-m-d 00:00:00:000000");
    
    $update= $client->monikos->Users->updateOne(
        ["customerId"=>$_POST['customerId']],
        ['$set'=>
            ['braintree_subscription_info' => 
                [
                    'planId' => $current['planId'],
                    'subscriptionId' => $current['subscriptionId'],
                    'billingPeriodStartDate' => $current['billingPeriodStartDate'],
                    'billingPeriodEndDate'=> $paidThroughDate,
                    'subscriptionStatus'=>$current['subscriptionStatus']
                ]
            ]
        ]
    );
    if($current['subscriptionStatus'] == 'Cancelled'){
        if($today > $paidThroughDate_string){
            $url = '/db/cancel_subscription.php';
            $fields = array (
                'customerId' => $cust,
                'isExpired' => true
            );
            $urlencodeddata = http_build_query($fields);
            $curl = curl_init();
            curl_setopt($curl,CURLOPT_URL,$url);
            curl_setopt($curl,CURLOPT_POST,count($fields));
            curl_setopt($curl,CURLOPT_POSTFIELDS,$urlencodeddata);
            $result=curl_exec($curl);
            curl_close($curl);
        }else{
            $paidThroughDate_string = DateTime::createFromFormat('Y-m-d h:i:s.u',$paidThroughDate_string);
            $paidThroughDate_string = $paidThroughDate_string->format('F dS Y');
            echo "expires ".$paidThroughDate_string;
        }
    } else{
        $paidThroughDate_string = DateTime::createFromFormat('Y-m-d h:i:s.u',$paidThroughDate_string);
            $paidThroughDate_string = $paidThroughDate_string->format('F dS Y');
        echo "renews ".$paidThroughDate_string;
    }
}else{
    echo "not subscribed";
}
?>