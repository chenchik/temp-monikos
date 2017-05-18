<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';

//echo "echoing id ". $_POST["id"];
$sql = "SELECT * FROM Users WHERE fbid LIKE '".$_POST["id"]."'";
//echo "sql state looks like " . $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
//if ($conn->query($sql) === TRUE) {
	echo '{
	"response": 200,
	"username": "'.$_POST["un"].'",
	"exists": true,
	"id": "'.$_POST["id"].'"}';
} else {
	$createSql = "INSERT INTO Users (id, fbid, username, email, password)
	VALUES (NULL, '".$_POST["id"]."', '".$_POST["un"]."', 'NULL', 'NULL')";
		if ($conn->query($createSql) === TRUE) {
		    echo '{
		    "response": 200,
		    "username": "'.$_POST["un"].'",
		    "exists": "false",
		    "id": "'.$_POST["id"].'"}';
		} else {
		    //echo '[{"response":"'.$conn->error.'"}]';
		    echo '{
			"response": 400,
			"error": "'.$conn->error.'"}';
		}
}

$conn->close();
//echo($result);
?>