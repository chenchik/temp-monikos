<?php 

require_once 'db_init.php';
$collection = $client->monikos->Users;

$username = $_POST['un'];
$friend_del=$_POST['delete'];



$user = $collection->findOne(["username" => $username]);
$friends = $user['friends'];


foreach($friends as $friend){
	if(($friend->username)== $friend_del){
	// var_dump($friend);
	$result = $collection->updateOne(
        ['username'=>$username],
        ['$pull'=>['friends'=>['username'=>$friend_del]]]
		);
	echo $friend_del." deleted"." from your friend list";
	break;
}
}






?>