<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


require_once "db_init.php";

$collection= $client->monikos->Users;
$result=$collection->findOne(["username"=>"mongo"]);


if($result!=null){	
	$to      =  $result["email"];
	$subject = 'Monikos Challenge From ';
	
    // $message = 'Looks like ' . $_POST['user1'] . ' has challenged you to play the Monikos ' . $_POST['game'] . ' game. They have bet you ' . $_POST['bet'] . ' capsules that they can beat you. To accept, go to the url after this sentence, the game will start automatically.' . $_POST['url'];
	$message="hello world";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= 'From: Monikos <monikosguide@monikos.com>' . "\r\n";
	if(mail($to, $subject, $message, $headers)){
        echo '{"emailsuccess":"'.$result["email"].'"}';
    } else {
        echo '{"emailfailure":"failedtosendemail"}';
    }
}else{echo '{"error":"no email"}'; }

?>