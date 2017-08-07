<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';
$collection = $client->monikos->Users;

$cust = $_POST['customerId'];
$result = $collection -> findOne(["customerId" => $cust]);
$isPremium = $result["premium"];

if($isPremium==true){
    date_default_timezone_set('UTC');
    $today = date("Y-m-d 00:00:00:000000");
    $endDate = $result["braintree_subscription_info"]["billingPeriodEndDate"]["date"];

    if($today > $endDate ){
        $url = 'http://localhost/db/cancel_subscription.php';
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
        echo "still have more time";
    }
}else{
    echo "not subscribed";
}


    
//$result["braintree_subscription_info"]["planId"]
//$result["braintree_subscription_info"]["subscriptionId"]
//$result["braintree_subscription_info"]["billingPeriodStartDate"]["date"]
//$result["braintree_subscription_info"]["billingPeriodEndDate"]["date"]
//$result["braintree_subscription_info"]["subscriptionStatus"]






?>