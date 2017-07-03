<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';
if(true){
	$output="";
	$collection= $client->monikos->Users;
	$previous = $collection -> findOne(
		['username'=> "mongo"]
		);
	// $capsule = $previous['capsules']- $_POST['bet'];
	$update = $collection->updateOne(
		['username'=> "mongo"],
		['$set' => ['capsules'=>300]]
		);
	$count =$update->getModifiedCount();
	var_dump($previous);
	if($count==1){
		// $output='[{"response":"200"}]';
		$output .= '[{
	    "response": 200,
	    "user2": "'.$_POST["user2"].'",
	    "lost": "'.$_POST["bet"].'"},';

	}else{
		echo '[{"response":"400"}]';
	}

	$previous = $collection -> findOne(
		['username'=> "mongo2"]
		);
	$capsule = $previous['capsules']+ $_POST['bet'];
	$update = $collection->updateOne(
		['username'=> "mongo2"],
		['$set' => ['capsules'=>$capsule]]
		);
	$count =$update->getModifiedCount();
	if($count==1){
		// $output='[{"response":"200"}]';
		$output .= '{
	    "response": 200,
	    "user1": "'.$_POST["user1"].'",
	    "won": "'.$_POST["bet"].'"}]';

	}else{
		echo '[{"response":"400"}]';
	}
	echo $output;	



}else if($_POST['user1score'] > $_POST['user2score']){
	$output="";
	
	$collection= $client->minokos->Users;
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
		$output='[{"response":"200"}]';
		// $output .= '[{
	 //    "response": 200,
	 //    "user1": "'.$_POST["user1"].'",
	 //    "lost": "'.$_POST["bet"].'"},';

	}else{
		echo '[{"response":"400"}]';
	}

	
	$collection= $client->minokos->Users;
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
		$output='[{"response":"200"}]';
		// $output .= '{
	 //    "response": 200,
	 //    "user2": "'.$_POST["user2"].'",
	 //    "won": "'.$_POST["bet"].'"}]';

	}else{
		echo '[{"response":"400"}]';
	}
	echo $output;	
}else{
	echo '[{"winner":"tie"}]';
}
?>