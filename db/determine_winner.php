<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';

$collection=$client->monikos->Challenge;

$result=$collection->find(["_id"=>new MongoDB\BSON\ObjectID($_POST['challengeid'])]);

$outp = "";

foreach ($result as $key) {
	if ($outp != "") {$outp .= ",";}
	$outp .= '{"challengeid":"'  . $key["_id"] . '",';
    $outp .= '"details":"determiningwinner",';
    $outp .= '"bet":"'   . $key["bet"] . '",';
    $outp .= '"user1":"'   . $key["user1"] . '",';
    $outp .= '"user2":"'   . $key["user2"] . '",';
    $outp .= '"user1score":"'   . $key["user1score"] . '",';
    $outp .= '"user2score":"'. $key["user2score"]     . '"}';
}
//$outp ='{"records":['.$outp.']}';
echo($outp);

//echo($result);
?>