<?php 



require_once 'db_init.php';
  
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



$collection = $client->monikos->Users;

$user = $collection->findOne(['username'=>'Boehlert']);//NEED TO REVISE: findOne(["username"=>""]) here should be replaced by the logged user's username

        // var_dump($user->friends);
$friend_list = $user->friends;
$friend_cap = array();
 foreach( $friend_list as $friend => $value){
        // echo $value;
        $friend_docu = $collection->findOne(['username'=>$value]);
        $friend_cap[$value] = $friend_docu->capsules;

 }

arsort($friend_cap);
$rank = 1;
foreach ($friend_cap as $key => $val) {

    echo "Friendlist No.".$rank.":\n$key has $val amount of capsules!\n\n";
    $rank++;
}




?>