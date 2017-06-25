<?php 


require_once 'db_init.php';
  
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$manager = new \MongoDB\Driver\Manager('mongodb://root:kc3irtapdnayeli29r@104.236.241.100:27017');
$database = 'monikos.Users';
//this is the filter for the database. 
$filter = [
    'schoolname'=>'Adams State University, Alamosa', //NEED TO REVISE: here should be replaced by the  logged user's school

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
 
  // var_dump( $value );
  // var_dump($value->username);

  echo $value->username." has ".$value->capsules." amount of capsules!"."\n\n";


}




// $cursor = $client->$monikos->$Users->find(
//     [],
//     [
//         // 'collation' => ['locale' => 'de'],
//         'sort' => ['username' => 1],
//     ]
// );
 // $cursor = $client->monikos->Users->find();
 // $cursor = $cursor->sort(array("capsules" => -1));



// $filter = array();
// $options = array(
//     "sort" => array("capsules" => 1),);
  // $result = $collection->insertOne( [ 'yo' => 'ganxie', 'shangdi' => 'sos' ] );



?>