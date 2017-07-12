<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php'; 
$collection= $client->minokos->Users;   
    $update = $collection->updateOne(
        ['username'=> "mongo4"],
        ['$set' => ['capsules'=>300]]
        );
    $find=$collection->findOne(["username"=>"mongo4"]);
    var_dump($find);

?>