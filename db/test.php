<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php'; 


$challenge =['challengeid'=>NULL,
             "user1"=>1,
             "user2"=>2,
             "challengegame"=>12,
             "bet"=>12,
             "user1score"=> -1,
             "user2score"=> -1,
             "winner"=> NULL,
             "url"=>'/dummyval'
             ];
$collection=$client->monikos->Challenge;
$result=$collection->insertOne($challenge);
$insertId=$result->getInsertedId();

// $update=$collection->updateOne(["_id"=> new MongoDB\BSON\ObjectID($insertId)],["$set"=>["url"=>"/mvc/public/games/challenge_pending/".$insertId]]);
$updateResult = $collection->updateOne(
    [ '_id' => new MongoDB\BSON\ObjectID($insertId) ],
    [ '$set' => [ "url"=>"/mvc/public/games/challenge_pending/".$insertId] ]
);

?>