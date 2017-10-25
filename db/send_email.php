<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "db_init.php";

$to      = 'monikos.inc@gmail.com';

$subject = 'Monikos Contact Form:' . $_POST['Subject:'];

$message = $_POST['Name:'] . " sent you this:\r\nThis is their email: " . $_POST['Email:'] . "\r\n" . $_POST['Message:'];

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= 'From: Monikos <monikosguide@monikos.com>' . "\r\n";
if(mail($to, $subject, $message, $headers)){
    echo '{"emailsuccess":"success"}';
} else {
    echo '{"emailfailure":"failedtosendemail"}';
}

?>