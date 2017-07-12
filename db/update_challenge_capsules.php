<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';

if($_POST['user1score'] < $_POST['user2score']){
	$output="";
	$collection= $client->monikos->Users;
	$previous = $collection -> findOne(
		['username'=> $_POST['user2']]
		);
	$capsule = $previous['capsules']- $_POST['bet'];
	$update = $collection->updateOne(
		['username'=> $_POST['user2']],
		['$set' => ['capsules'=>$capsule]]
		);
	$count =$update->getModifiedCount();
	$new = $collection->findOne(
		['username'=> $_POST['user2']]
		);
	if($count==1){
		$output .= '[{
	    "response": 200,
	    "user2": "'.$_POST["user2"].'",
	    "lost": "'.$_POST["bet"].'"},';

	}else{
		$output='[{"response":"400"}]';
	}

	$previous = $collection -> findOne(
		['username'=> $_POST['user1']]
		);
	$capsule = $previous['capsules']+ $_POST['bet'];
	$update = $collection->updateOne(
		['username'=> $_POST['user1']],
		['$set' => ['capsules'=>$capsule]]
		);
	$count =$update->getModifiedCount();
	$new = $collection->findOne(
		['username'=> $_POST['user1']]
		);
	if($count==1){
		$output .= '{
	    "response": 200,
	    "user1": "'.$_POST["user1"].'",
	    "won": "'.$_POST["bet"].'"}]';

	}else{
		$output='[{"response":"400"}]';
	}
	echo $output;	



}else if($_POST['user1score'] > $_POST['user2score']){
	$output="";
	
	$collection= $client->monikos->Users;
	$previous = $collection -> findOne(
		['username'=> $_POST['user1']]
		);
	$capsule = $previous['capsules']- $_POST['bet'];
	$update = $collection->updateOne(
		['username'=> $_POST['user1']],
		['$set' => ['capsules'=>$capsule]]
		);
	$count =$update->getModifiedCount();
	$new = $collection->findOne(
		['username'=> $_POST['user1']]
		);
	if($count==1){
		$output .= '[{
	    "response": 200,
	    "user1": "'.$_POST["user1"].'",
	    "lost": "'.$_POST["bet"].'"},';

	}else{
		$output='[{"response":"401"}]';
	}
	
	$collection= $client->monikos->Users;
	$previous = $collection -> findOne(
		['username'=> $_POST['user2']]
		);
	$capsule = $previous['capsules']+ $_POST['bet'];
	$update = $collection->updateOne(
		['username'=> $_POST['user2']],
		['$set' => ['capsules'=>$capsule]]
		);
	$count =$update->getModifiedCount();
	$new = $collection->findOne(
		['username'=> $_POST['user2']]
		);
	if($count==1){
		$output .= '{
	    "response": 200,
	    "user2": "'.$_POST["user2"].'",
	    "won": "'.$_POST["bet"].'"}]';

	}else{
		$output='[{"response":"402"}]';
	}
	echo $output;	
}else{
	echo '[{"winner":"tie"}]';
}
?>