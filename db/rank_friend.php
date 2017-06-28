<?php 



require_once 'db_init.php';
  
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



$collection = $client->monikos->Users;

$user = $collection->findOne(['username'=>$_POST['un']]);
$user_username = $user['username'];
$user_capsules = $user['capsules'];

$friend_list = $user->friends;
$friend_cap = array();
$friend_cap[] = (object)['username'=>$user_username, 'capsules'=>$user_capsules];

 foreach( $friend_list as $friend){
    $friend_cap[] = (object)['username' => $friend['username'],
                             'capsules' => $friend['capsules']];
}

function sort_by_capsule($key){
    return function($a,$b) use ($key){
        return $b->$key - $a->$key;
    };
}

usort($friend_cap, sort_by_capsule('capsules'));


$rank = 1;
$outp ="";
foreach($friend_cap as $friend){
    $data = $friend->username." has ".$friend->capsules. " capsules"; 
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"content":'.json_encode($data);
    $outp .= ', "number":'.json_encode($rank);
    $outp .= "}";
    $rank++;
}
$outp ='{"records":['.$outp.']}';
echo $outp;








?>
