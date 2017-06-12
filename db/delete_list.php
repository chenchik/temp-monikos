<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';

$collection=$client->monikos->Lists;
$result=$collection->delete(['_id'=>$_POST['lid']]);

if ($result->getDeletedCount()) {
    echo '[{
    "response": 200,
    "liddeleted": "'.$_POST["lid"].'"}]';
} else {
    echo '[{"response":"Please check server error log"}]';
}
?>