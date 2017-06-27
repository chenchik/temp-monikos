<?php 

require_once 'db_init.php';
$collection = $client->monikos->Users;

$username = 'Boehlert';//NEED TO CHANGE logged username
$friend_del='lzheng';//NEED TO CHANGE the name of friend that you clicked delete button.



$user = $collection->findOne(["username" => $username]);
$friends = $user['friends'];


foreach($friends as $friend){
	if(($friend->name)== $friend_del){
	// var_dump($friend);
	$result = $collection->updateOne(
		array('username'=>$username),
		array('$pull'=>
			array('friends'=>array('name'=>$friend_del)))
		);
	echo $friend_del." is deleted"." from your friend list";
	break;

}
}






?>