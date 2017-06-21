<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';

$collection = $client->monikos->Users;
$id=new MongoDB\BSON\ObjectID($_POST['id']);
$before = $collection->findOne(
    ['_id' => $id]
);
$cap = $before['capsules'] + $_POST['capsules'];
$update = $collection->updateOne(
    ['_id'=> $id],
    ['$set' => ['capsules' => $cap]]
);  
$count = $update->getModifiedCount();
$after= $collection->findOne(
    ['_id' => $id]
);

/* test user
$before = $collection->findOne(
    ['_id' => new MongoDB\BSON\ObjectID("5946b1984f417e1f84007542")]
);
$sum = $before['capsules'] + 2;
$update = $collection->updateOne(
    ['_id'=> new MongoDB\BSON\ObjectID("5946b1984f417e1f84007542")],
    ['$set' => ['capsules' => $sum]]
);
$count = $update->getModifiedCount();
$after = $collection->findOne(
    ['_id' => new MongoDB\BSON\ObjectID("5946b1984f417e1f84007542")]
)*/

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
