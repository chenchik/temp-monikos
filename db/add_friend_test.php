<?php 

// $dir = '../../vendor/';


// require_once $dir . 'autoload.php';


// echo $dir . 'autoload.php';

// if (is_readable($dir . 'autoload.php')) {
//     echo 'The file is readable';
// } else {
//     echo 'The file is not readable';
// }

// echo extension_loaded("mongodb") ? "yesloaded\n" : "not loaded\n";
//  $client = new MongoDB\Client("mongodb://root:kc3irtapdnayeli29r@104.236.241.100:27017");
require_once 'db_init.php';
 $collection = $client->monikos->Users;

  // $result = $collection->insertOne( [ 'yo' => 'ganxie', 'shangdi' => 'sos' ] );

// echo "Inserted with Object ID '{$result->getInsertedId()}'";

// $collection = $client->demo->beers;

 $result = $collection->find( [ 'username' => 'greer' ] );

 foreach ($result as $entry) {
  $flag = True;
   foreach ($entry['friend_list'] as $friend){
     echo $friend['username'];
     if ($friend['username']==$entry['username']){
      $flag = False;
     }
// $dup = $friend->findOne(['username'=>$entry['username']]).count(); 
    // if ($friend['username'] )
   }

 if ($flag){
         echo $entry['username'], ': ', "\n<br><br>";
     $collection->updateOne(array("_id"=>$entry['_id']),array('$addToSet' => array("friend_list"=>$entry)));
      }
  // if ($entry->find('friend_list'=>))
     // echo $entry['username'], ': ', "\n<br><br>";
     // $collection->updateOne(array("_id"=>$entry['_id']),array('$addToSet' => array("friend_list"=>$entry)));
    

 }

?>