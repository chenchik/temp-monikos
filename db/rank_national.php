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

foreach($cursor as $data => $value){
  // echo "Here is the national ranking: ";
  $data=$data+1;
echo "National No."."$data: "."\n";
 
echo $value->username." has ".$value->capsules." amount of capsules!"."\n\n";

}




?>