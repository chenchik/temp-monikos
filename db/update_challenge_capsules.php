<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';

if($_POST['user1score'] < $_POST['user2score']){

	$output = "";
	
	$sql = "UPDATE Users SET capsules = capsules - " .$_POST['bet']. " WHERE username LIKE '" .$_POST['user2'] . "'";
	if ($conn->query($sql) === TRUE) {
	    $output .= '[{
	    "response": 200,
	    "user2": "'.$_POST["user2"].'",
	    "lost": "'.$_POST["bet"].'"},';
	} else {
    	echo '[{"response":"'.$conn->error.'"}]';
	}

	$sql = "UPDATE Users SET capsules = capsules + " .$_POST['bet']. " WHERE username LIKE '" .$_POST['user1'] . "'";
	if ($conn->query($sql) === TRUE) {
	    $output .= '{
	    "response": 200,
	    "user1": "'.$_POST["user1"].'",
	    "won": "'.$_POST["bet"].'"}]';
	} else {
    	echo '[{"response":"'.$conn->error.'"}]';
	}
	echo $output;	

}else if($_POST['user1score'] > $_POST['user2score']){

	$output = "";
	$sql = "UPDATE Users SET capsules = capsules - " .$_POST['bet']. " WHERE username LIKE '" .$_POST['user1'] . "'";
	if ($conn->query($sql) === TRUE) {
	    $output .= '[{
	    "response": 200,
	    "user1": "'.$_POST["user1"].'",
	    "lost": "'.$_POST["bet"].'"},';
	} else {
    	echo '[{"response":"'.$conn->error.'"}]';
	}

	$sql = "UPDATE Users SET capsules = capsules + " .$_POST['bet']. " WHERE username LIKE '" .$_POST['user2'] . "'";
	if ($conn->query($sql) === TRUE) {
	    $output .= '{
	    "response": 200,
	    "user2": "'.$_POST["user2"].'",
	    "won": "'.$_POST["bet"].'"}]';
	} else {
    	echo '[{"response":"'.$conn->error.'"}]';
	}
	echo $output;	

}else{

	echo '[{"winner":"tie"}]';

}

$conn->close();
?>