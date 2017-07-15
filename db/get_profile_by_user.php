<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';
$collection = $client->monikos->Users;


$result = $collection -> findOne(["username" => $_POST["un"]]);

$found = $collection -> count(["username" => $_POST["un"]]);

$outp = "";  
if($found==1){
$outp .= '{"id":'  . json_encode($result["_id"]) . ',';
$outp .= '"username":'  . json_encode($result["username"]) . ',';
$outp .= '"email":'  . json_encode($result["email"]) . ',';
$outp .= '"school":' . json_encode($result["schoolname"]) . ',';
$outp .= '"capsules":'. json_encode($result["capsules"]) . ',';
$outp .= '"year":'. json_encode($result["year"]) . ',';
$outp .='"premium":'.json_encode(($result["premium"])).'}';
$outp ='{"records":['.$outp.']}';
echo $outp;
}else{
    echo "0";
}


?>