<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';

$collection=$client->monikos->SchoolLists;
$result=$collection->find(
	["lid"=>new MongoDB\BSON\ObjectID($_POST["lid"])]
	);

$outp = '';
foreach ($result as $spe_sch_lis) {
	if ($outp != "") {$outp .= ",";}
	$outp .= '{"list_id":"'  . $spe_sch_lis["_id"] . '",';
    $outp .= '"list_name":"'   . $spe_sch_lis["name"]. '",';
    $outp .= '"drugnames":"'. $spe_sch_lis["drugnames"]. '"}';
}
// $outp ='{"records":['.$outp.']}';
echo($outp);

?>