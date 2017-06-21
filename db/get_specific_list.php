<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';

$collection=$client->monikos->Lists;
$result=$collection->find(
	["_id"=>new MongoDB\BSON\ObjectID($_POST["lid"])]
	);

$outp = "";
foreach ($result as $spe) {
	if ($outp != "") {$outp .= ",";}
	$outp .= '{"list_id":"'  . $spe["_id"] . '",';
    $outp .= '"list_name":"'   . $spe["name"]. '",';
    $outp .= '"drugnames":"'. $spe["drugnames"]. '"}';
}
// $outp ='{"records":['.$outp.']}';
echo($outp);

?>