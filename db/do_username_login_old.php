<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';

$sql = "SELECT * FROM Users WHERE username LIKE '".$_POST["username"]."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$rs = $result->fetch_array(MYSQLI_ASSOC);
	
    echo '[{
	"response": 200,
    "login-status": "logged-in",
    "username": "'.$rs["username"].'",
    "user_id": "'.$rs["id"].'"}]';
} else {
    echo '[{"response": 400}]';
}

$conn->close();
?>