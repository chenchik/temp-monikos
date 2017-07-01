<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';

$collection=$client->monikos->Challenge;
$result=$collection->find(
	["user2"=>$_POST["user"]]
	);



$outp = "";
foreach ($result as $noti) {
	if ($outp != "") {$outp .= ",";}
	$outp .= '{"Challengeid":"'  . $noti["_id"] . '",';
    $outp .= '"user2":"'   . $noti["user2"]. '",';
    $outp .= '"user1":"'. $noti["user1"]. '",';
    $outp .= '"bet":"'. $noti["bet"]	. '",';
    $outp .= '"challengegame":"'.$noti["challengegame"]		.'",';
    $outp .= '"url":"'. $noti["url"]. '"}';
}

$outp ='{"records":['.$outp.']}';
echo($outp);
?>