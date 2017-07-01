<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';

$collection = $client->monikos->Challenge;
$result = $collection->updateOne(
    ['_id' => new MongoDB\BSON\ObjectID($_POST["challengeid"])],
    ['$set' => ['user1score' => $_POST["user1score"]],['url'=> $_POST['url']]]
// or $set two in one ()
);
 
if ($result->getModifiedCount() === 1) {
    echo '[{
    "response": 200,
    "challengeid": "'.$_POST["challengeid"].'",
    "url:": "'.$_POST["url"].'",
    "user1score": "'.$_POST["user1score"].'"}]';
} else {
    echo '[{"response":"500"}]';
}
?>