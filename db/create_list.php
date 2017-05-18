<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';

$drugs = "";
$i = 0;
$numItems = count($_POST["drugs"]);
foreach($_POST["drugs"] as $vals){
	if(++$i === $numItems) {
    	$drugs .= $vals;
  	}else{
	  	$drugs .= $vals . ",";	
  	}
}

$sql = "INSERT INTO Lists (lid, uid, name, drugids, drugnames)
VALUES (NULL, '".$_POST["user_id"]."', '".$_POST["name"]."', '11', '".$drugs."')";

if ($conn->query($sql) === TRUE) {
    echo '[{
    "response": 200,
    "name": "'.$_POST["name"].'"}]';
} else {
    echo '[{"response":"'.$conn->error.'"}]';
}

$conn->close();
echo($result);
?>