<?php 


require_once 'db_init.php';
  
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//currently need to use MongoDB\Driver\Manager to implement the sort method for php driver mongodb 1.2. did not use MondoDB\Client here
$manager = new \MongoDB\Driver\Manager('mongodb://root:kc3irtapdnayeli29r@104.236.241.100:27017');
$database = 'monikos.Users';
//this is the filter for the database. 
$filter = [
    'schoolname'=>'Adams State University, Alamosa', //NEED TO REVISE: $filter=['schoolname'=>''] here should be replaced by the  logged user's schoolname

];
$query = new \MongoDB\Driver\Query(
        $filter, 
        [ 'sort' => [ 'capsules' => -1], 'limit' => 10 ] 
);

$cursor = $manager->executeQuery( $database, $query );

foreach($cursor as $data => $value){
  // echo "Here is the national ranking: ";
  $data=$data+1;
  echo $value->schoolname." No."."$data: "."\n";
 
  echo $value->username." has ".$value->capsules." amount of capsules!"."\n\n";


}







?>