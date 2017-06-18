<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';

$collection=$client->monikos->Lists;
$result=$collection->find(
	["uid"=>$_POST["user_id"]]
	);

$outp = '';
foreach ($result as $document) {
	if ($outp != "") {$outp .= ",";}
	$outp .= '{"list_id":"'  . $document["_id"] . '",';
    $outp .= '"list_name":"'   . $document["name"]. '",';
    $outp .= '"drugnames":"'. $document["drugnames"]. '"}';
}
$outp ='{"records":['.$outp.']}';
echo($outp);

?>