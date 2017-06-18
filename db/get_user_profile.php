<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';
$collection = $client -> monikos -> Users;

$result = $collection -> findOne(["_id" => new MongoDB\BSON\ObjectID($_POST["id"])]);
//$result = $collection -> findOne(["_id" => new MongoDB\BSON\ObjectID("5944d3274f417e1f84007538")]);

$outp = "";  
$outp .= '{"id":'  . json_encode($result["_id"]) . ',';
$outp .= '"username":'  . json_encode($result["username"]) . ',';
$outp .= '"email":'  . json_encode($result["email"]) . ',';
$outp .= '"capsules":'. json_encode($result["capsules"]) . '}';
$outp ='{"records":['.$outp.']}';

echo $outp;
?>
