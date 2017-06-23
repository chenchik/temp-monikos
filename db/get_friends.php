<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once 'db_init.php';

$collection = $client->monikos->Users;

$result = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID("59434c7c549ea926cd0000ff")]);

$fr_list = $result['friend_list'];

$outp = "";

foreach($fr_list as $fr){
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"friend":'  . json_encode($fr['username']) . '}';
}
$outp ='{"records":['.$outp.']}';
echo $outp;
?>
