<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once 'db_init.php';

$collection = $client->monikos->Users;

$result = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_POST['id'])]);

//$result = $collection->findOne(['username' => 'bruh']);
$friends = $result['friends'];

$outp = "";

foreach($friends as $fr){
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"username":'  . json_encode($fr['username']) . '}';
}
$outp ='{"records":['.$outp.']}';
echo $outp;
?>
