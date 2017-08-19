<?php
$to      =  'joeson34@gmail.com';
$subject = 'Transaction details';
$body = "hi";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= 'From: <info@monikos.org>' . "\r\n";
            
mail($to, $subject, $body, $headers);

?>