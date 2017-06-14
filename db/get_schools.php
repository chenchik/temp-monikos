<?php
/*Created by Danila Chenchik, Joseph Son Monikos LLC*/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once 'db_init.php';

$collection=$client->monikos->Schools;

$cursor = $collection->find();


 $outp = "";
 foreach ($cursor as $school) {
     if ($outp != "") {$outp .= ",";}
     $outp .= '{"schoolid":'  . json_encode($school["schoolid"]) . ',';
     $outp .= '"schoolname":'. json_encode($school["schoolname"])     . '}';
 }
 $outp ='{"records":['.$outp.']}';
 echo($outp);
?>



