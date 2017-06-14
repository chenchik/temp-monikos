<?php
/*Created by Danila Chenchik, Joseph Son Monikos LLC*/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once 'db_init.php';

$collection=$client->monikos->Programs;

$result = $collection->find(
    ["program" => "pa"],
    [
        'projection'=>["schoolid"=>1,"schoolname"=>1],
        'sort'=>["schoolname"=>1],
    ]
);

 $outp = "";
 foreach ($result as $school) {
     if ($outp != "") {$outp .= ",";}
     $outp .= '{"schoolid":'  . json_encode($school["schoolid"]) . ',';
     $outp .= '"_id":"'.$school["_id"].'",';
     $outp .= '"schoolname":'. json_encode($school["schoolname"])     . '}';
 }
 $outp ='{"records":['.$outp.']}';
 echo($outp);
?>
