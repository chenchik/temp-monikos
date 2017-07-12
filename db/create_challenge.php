<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php'; 


$challenge =['challengeid'=>NULL,
			 "user1"=>$_POST["user1"],
			 "user2"=>$_POST["user2"],
			 "challengegame"=>$_POST["game"],
			 "bet"=>$_POST["bet"],
			 "user1score"=> $_POST['user1score'],
			 "user2score"=> -1,
			 "winner"=> NULL,
			 "url"=>$_POST["url"]
			 ];
$collection=$client->monikos->Challenge;
$result=$collection->insertOne($challenge);
// echo sizeof($result);
$insertId=$result->getInsertedId();
$url=$_POST["url"]."/".$insertId;
$updateResult = $collection->updateOne(
    //update the url field 
    [ '_id' => new MongoDB\BSON\ObjectID($insertId) ],
    [ '$set' => [ "url"=>$url ]]
);
if ($result->getInsertedCount()) {
    echo '[{
    "response": 200,
    "challengeid": "'.$result->getInsertedId().'",
    "user1": "'.$_POST["user1"].'",
    "user2": "'.$_POST["user2"].'",
    "game": "'.$_POST["game"].'",
    "url":"'.$url.'",
    "bet": "'.$_POST["bet"].'"}]';

} else {
    echo '[{"response":"Please check server error log."}]';
}
?>