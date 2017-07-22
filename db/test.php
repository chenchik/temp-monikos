<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php'; 
$collection= $client->monikos->Users;   
$result=$collection->find([],['limit'=>142]);


foreach ($result as $key) {
	$md5=md5($key['password']);
	 // echo $md5."; ".$key['password'].;
	 // echo sizeof($key);
	 $update=$collection->updateOne(
	 	['_id'=>new MongoDB\BSON\ObjectID($key['_id'])],
	 	['$set'=>['password'=>$md5]]);
}//for md5 hash all old password

?>