<?php
//written by Joseph Son 

require 'payment-server-init.php';
require 'db_init.php';

$nonceFromTheClient = $_POST["nonce"];
$customer = $client->monikos->Users->findOne(['customerId'=>$_POST['customerId']]);
$subscriptionStatus = $customer['braintree_subscription_info']['subscriptionStatus'];
$email = $_POST['email'];

if($subscriptionStatus != "ACTIVE"){
//creates the subscription with specified plan
$result = Braintree_Subscription::create([
  "paymentMethodNonce" => $nonceFromTheClient,
  'planId' => "".$_POST['plan']
]);
//inserts the planId, subscriptionId, subscriptionStartDate+endDate, to the user in the db

$planId = $result -> subscription -> planId;
$charge = $result -> subscription -> price;
$newSubscriptionId = $result -> subscription -> id;
$billingStart = $result -> subscription -> billingPeriodStartDate;
$billingEnd = $result -> subscription -> billingPeriodEndDate;
$billingStatus = $result -> subscription -> status;

$insertBraintreeInfo = $client->monikos->Users->updateOne(
    ['customerId' => $_POST['customerId']],
    ['$set'=>
        [
            'premium'=>true,
            'braintree_subscription_info' => 
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
$message = 'Congratulations on becoming a premium user of Monikos!
Your '.$planId.' subscription has been processed successfully, and a confirmation email of your transaction details has been sent to '.$email.'. Exit the pop-up to access all the cool new features!';
echo $message;


$body =
    "Hi ".$_POST['username'].", <br><br>

    We’re thrilled that you joined Monikos! <br>
    Now you can spend all your time studying instead of spending time making flashcards. Make sure to check out our database, fun study games and our favorite, the interactive flashcard. <br><br>

    And remember, we're always looking to improve Monikos to make it work for you, so please feel free to email us your thoughts at info@monikos.org. <br><br>";

$payment_method = $_POST['type'];
switch($payment_method){
    case 'CreditCard':
        $body .= 
            'Your '.$_POST['cardType'].' card ending with '.$_POST['lastTwo'].' will be automatically billed $'.$charge.' on a '.$planId.' basis, starting today: '.date("l jS \of F Y").'.' ;
        break;
    case 'PayPalAccount': 
        $body .= 
            'Your PayPal account under the email '.$_POST['payPalEmail'].' will be automatically billed $'.$charge.' on a '.$planId.' basis, starting today: '.date("l jS \of F Y").'.';
        break;
}
$body .= 
    "<br><br>Sincerely, <br>
    The Monikos Team";

$to  =  $email;
$subject = 'Confirmation of purchase for Monikos user '.$_POST['username'];


$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= 'From: Monikos <info@monikos.org>' . "\r\n";
            
mail($to, $subject, $body, $headers);
?>
