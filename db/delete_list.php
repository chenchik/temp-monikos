<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';
$lid=$_POST['lid'];	
$collection=$client->monikos->Lists;
$result=$collection->deleteOne(['_id'=>new MongoDB\BSON\ObjectID($lid)]);

if ($result->getDeletedCount()) {
    echo '[{
    "response": 200,
    "liddeleted": "'.$lid.'"}]';
} else {
    echo '[{"response":"Please check server error log"}]';
}
?>