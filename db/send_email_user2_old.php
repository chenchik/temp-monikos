<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once 'db_creds.php';

$result = $conn->query("SELECT email FROM Users WHERE username LIKE '".$_POST['user2'] ."'");


$user2email = "";
$count = 0;
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	$count++;
	$user2email = $rs['email'];	
}

if($count < 1){
	echo '{"error":"no email"}'; 
}else{
	
	$to      =  $user2email;
	$subject = 'Monikos Challenge From ' . $_POST['user1'];
	
    $message = 'Looks like ' . $_POST['user1'] . ' has challenged you to play the Monikos ' . $_POST['game'] . ' game. They have bet you ' . $_POST['bet'] . ' capsules that they can beat you. To accept, go to the url after this sentence, the game will start automatically.' . $_POST['url'];

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= 'From: Monikos <monikosguide@monikos.com>' . "\r\n";
    
	if(mail($to, $subject, $message, $headers)){
        echo '{"emailsuccess":"'.$user2email.'"}';
    } else {
        echo '{"emailfailure":"failedtosendemail"}';
    }
}
$conn->close();

?>