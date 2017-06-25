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

  // var_dump( $value );
  // var_dump($value->username);
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

// echo "Inserted with Object ID '{$result->getInsertedId()}'";

// $collection = $client->demo->beers;

//  $result = $collection->find( [ 'username' => 'testyear' ] );
// // avoid redundant friend
//  foreach ($result as $entry) {
//   $flag = True;
//    foreach ($entry['friend_list'] as $friend){
//      echo $friend['username'];
//      if ($friend['username']==$entry['username']){
//       $flag = False;
//      }

//    }

//    if ($flag){
//          echo $entry['username'], ': ', "\n<br><br>";
//      $collection->updateOne(array("_id"=>$entry['_id']),array('$addToSet' => array("friend_list"=>$entry)));
//    }
  








  // if ($entry->find('friend_list'=>))
     // echo $entry['username'], ': ', "\n<br><br>";
     // $collection->updateOne(array("_id"=>$entry['_id']),array('$addToSet' => array("friend_list"=>$entry)));
    

 // }

?>