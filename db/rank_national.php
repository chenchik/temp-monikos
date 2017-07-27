<?php 
require_once 'db_init.php';
  

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$manager = new \MongoDB\Driver\Manager('mongodb://root:kc3irtapdnayeli29r@104.236.241.100:27017');
$database = 'monikos.Users';

$query = new \MongoDB\Driver\Query(
        [], //this means to select all.
        [ 'sort' => [ 'capsules' => -1], 'limit' => 10 ] // this is how many u want the cursor to get from the databse.
);

$cursor = $manager->executeQuery( $database, $query );

$outp = "";
foreach($cursor as $data => $value){
    $data++;
    $capsules = number_format($value->capsules);
    $rank = $value->username.": ".$capsules." capsules";
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"content":'.json_encode($rank);
    $outp .= ', "number":'.json_encode($data);
    $outp .= "}";
}
$outp ='{"records":['.$outp.']}';
echo $outp;
?>