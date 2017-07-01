<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once 'db_init.php';

$collection = $client->monikos->Challenge;
$result = $collection->updateOne(
    ['_id' => new MongoDB\BSON\ObjectID("5957f84e1e3fc7685d1a5474")],
    ['$set' => ['user1score' => 999,'url'=> 999]]
// or $set two in one ()
);
 var_dump($result)
?>