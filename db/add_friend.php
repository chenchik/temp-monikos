<?php 

require_once 'db_init.php';
$collection = $client->monikos->Users;

$username = $_POST['un'];
$friend_username = $_POST['fr_un'];
// $username = 'Boehlert';
// $friend_username = 'patrick';



$user = $collection->findOne(["username" => $username]);
$friends = $user['friends'];
$friends = $friends->getArrayCopy();

$exists = $collection->count(["username" => $friend_username]);

$same = false;
if($username == $friend_username){
    $same = true;
    echo "You can't add yourself as a friend!";
}

$already_friend = false;
if($exists==1){
    foreach ($friends as $friend){
        if (($friend['username']) == $friend_username){
            $already_friend = true;
            echo "Already in your friend's list";
            break;
        } 
    }
}else{
    echo "This user doesn't exist";
}

if ($same == false && $already_friend == false && $exists == 1){
    $friend_doc = $collection->findOne(["username" => $friend_username]);
    $friend_obj = (object)array('username'=>$friend_username,'capsules'=>$friend_doc->capsules,'school'=>$friend_doc->schoolname,'year'=>$friend_doc->year);
    // var_dump($friend_obj);

    array_push($friends,$friend_obj);
    $update = $collection->updateOne(
        ["username"=>$username],
        ['$set' => ["friends" => $friends]]
);
$mod = $update->getModifiedCount();
if($mod == 1){
    echo $friend_username." added to your friends list. Refresh your browser to see your changes!";
}
}

?>
