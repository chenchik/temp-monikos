<?php
require 'db_init.php';
    
$result = $client-> monikos -> Users -> updateOne(["username"=>$_POST['user']],['$set'=>["premium" =>true]]);

$count = $result->getModifiedCount();

echo $count;

?>