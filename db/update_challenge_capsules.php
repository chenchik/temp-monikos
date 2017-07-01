<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';

if($_POST['user1score'] < $_POST['user2score']){
	$output="";
	$collection= $client->minokos->Users;
	$previous = $collection -> findOne(
		['username'=> new MongoDB\BSON\Regex($_POST['user2'])]
		);
	$capusle = $previous['capsules']- $_POST['bet'];
	$update = $collection->updateOne(
		['username'=> new MongoDB\BSON\Regex($_POST['user2'])],
		['$set' => ['capusles'=>$capsule]]
		);
	$count =$update->getModifiedCount();
	$new = $collection->findOne(
		['username'=> new MongoDB\BSON\Regex($_POST['user2'])]
		);
	if($count==1){
		$output .= '{
	    "response": 200,
	    "user2": "'.$_POST["user2"].'",
	    "lost": "'.$_POST["bet"].'"}]';

	}else{
		echo '[{"response":"400"}]';
	}

	$collection= $client->minokos->Users;
	$previous = $collection -> findOne(
		['username'=> new MongoDB\BSON\Regex($_POST['user1'])]
		);
	$capusle = $previous['capsules']+ $_POST['bet'];
	$update = $collection->updateOne(
		['username'=> new MongoDB\BSON\Regex($_POST['user1'])],
		['$set' => ['capusles'=>$capsule]]
		);
	$count =$update->getModifiedCount();
	$new = $collection->findOne(
		['username'=> new MongoDB\BSON\Regex($_POST['user1'])]
		);
	if($count==1){
		$output .= '{
	    "response": 200,
	    "user1": "'.$_POST["user1"].'",
	    "won": "'.$_POST["bet"].'"}]';

	}else{
		echo '[{"response":"400"}]';
	}
	// $sql = "UPDATE Users SET capsules = capsules - " .$_POST['bet']. " WHERE username LIKE '" .$_POST['user2'] . "'";
	// if ($conn->query($sql) === TRUE) {
	//     $output .= '[{
	//     "response": 200,
	//     "user2": "'.$_POST["user2"].'",
	//     "lost": "'.$_POST["bet"].'"},';
	// } else {
 //    	echo '[{"response":"'.$conn->error.'"}]';
	// }

	// $sql = "UPDATE Users SET capsules = capsules + " .$_POST['bet']. " WHERE username LIKE '" .$_POST['user1'] . "'";
	// if ($conn->query($sql) === TRUE) {
	//     $output .= '{
	//     "response": 200,
	//     "user1": "'.$_POST["user1"].'",
	//     "won": "'.$_POST["bet"].'"}]';
	// } else {
 //    	echo '[{"response":"'.$conn->error.'"}]';
	// }
	echo $output;	



}else if($_POST['user1score'] > $_POST['user2score']){

	$output = "";
	$output="";
	
	$collection= $client->minokos->Users;
	$previous = $collection -> findOne(
		['username'=> new MongoDB\BSON\Regex($_POST['user1'])]
		);
	$capusle = $previous['capsules']- $_POST['bet'];
	$update = $collection->updateOne(
		['username'=> new MongoDB\BSON\Regex($_POST['user1'])],
		['$set' => ['capusles'=>$capsule]]
		);
	$count =$update->getModifiedCount();
	$new = $collection->findOne(
		['username'=> new MongoDB\BSON\Regex($_POST['user1'])]
		);
	if($count==1){
		$output .= '{
	    "response": 200,
	    "user1": "'.$_POST["user1"].'",
	    "lost": "'.$_POST["bet"].'"}]';

	}else{
		echo '[{"response":"400"}]';
	}

	
	$collection= $client->minokos->Users;
	$previous = $collection -> findOne(
		['username'=> new MongoDB\BSON\Regex($_POST['user2'])]
		);
	$capusle = $previous['capsules']+ $_POST['bet'];
	$update = $collection->updateOne(
		['username'=> new MongoDB\BSON\Regex($_POST['user2'])],
		['$set' => ['capusles'=>$capsule]]
		);
	$count =$update->getModifiedCount();
	$new = $collection->findOne(
		['username'=> new MongoDB\BSON\Regex($_POST['user2'])]
		);
	if($count==1){
		$output .= '{
	    "response": 200,
	    "user2": "'.$_POST["user2"].'",
	    "won": "'.$_POST["bet"].'"}]';

	}else{
		echo '[{"response":"400"}]';
	}



	// $sql = "UPDATE Users SET capsules = capsules - " .$_POST['bet']. " WHERE username LIKE '" .$_POST['user1'] . "'";
	// if ($conn->query($sql) === TRUE) {
	//     $output .= '[{
	//     "response": 200,
	//     "user1": "'.$_POST["user1"].'",
	//     "lost": "'.$_POST["bet"].'"},';
	// } else {
 //    	echo '[{"response":"'.$conn->error.'"}]';
	// }

	// $sql = "UPDATE Users SET capsules = capsules + " .$_POST['bet']. " WHERE username LIKE '" .$_POST['user2'] . "'";
	// if ($conn->query($sql) === TRUE) {
	//     $output .= '{
	//     "response": 200,
	//     "user2": "'.$_POST["user2"].'",
	//     "won": "'.$_POST["bet"].'"}]';
	// } else {
 //    	echo '[{"response":"'.$conn->error.'"}]';
	// }
	echo $output;	

}else{

	echo '[{"winner":"tie"}]';

}

// $conn->close();
?>