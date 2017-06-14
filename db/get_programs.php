<?php
/*Created by Danila Chenchik, Joseph Son Monikos LLC*/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once 'db_init.php';

$collection=$client->monikos->Programs;
$collection=$client->monikos->Programs;
$programs = $collection->distinct('program');

 $outp = "";
 foreach($programs as $program) {
     if ($outp != "") {$outp .= ",";}
    $program = json_encode($program);
    $outp .= '{"program":'  . $program . '}';
 }
 $outp ='{"records":['.$outp.']}';
 echo($outp);
?>