<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';
 

// $sql = "INSERT INTO Users (id, username, email, password, schoolid, schoolname)
// VALUES (NULL, '".$_POST["username"]."', '".$_POST["email"]."', '".$pw_md5."', '".$_POST["schoolid"]."', '".$_POST["schoolname"]."')";



$collection = $client->monikos->Users;
// $id=new MongoDB\BSON\ObjectID($_POST['id']);

$before = $collection->findOne(
    ["username"=>"mongo"]
);

$cap = 203;
$update = $collection->updateOne(
    ["_id"=>new MongoDB\BSON\ObjectID("5947fddb1e3fc7d27f650392")],
    ['$set' => ['capsules' => 203]]
);  
$count = $update->getModifiedCount();
var_dump($update);
$after= $collection->findOne(
    ["username"=>"mongo"]
);

if ($count === 1) {
	$outp = "";	   
    $outp .= '{"id":'  . json_encode($after['_id']) . ',';
    $outp .= '"capsules":'. json_encode($after['capsules'])   . '}';
	$outp ='{"records":['.$outp.']}';
	echo $outp;
} else {
	echo '[{"response":"400"}]';
}



?>