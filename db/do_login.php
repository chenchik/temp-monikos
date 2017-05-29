<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';

$pw_md5=md5($_POST["password"]);

$sql = "SELECT * FROM Users WHERE username LIKE '".$_POST["username"]."' AND password LIKE '".$pw_md5."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$rs = $result->fetch_array(MYSQLI_ASSOC);

	$cookie_name = "user_id";
	$cookie_value = $rs["id"];
	setcookie("user_id", $rs["id"], time() + (86400 * 30), "/");
	setcookie("username", $rs["username"], time() + (86400 * 30), "/");
    //setcookie("cookietest");
    // output data of each row
    echo '[{
	"response": 200,
    "login-status": "logged-in",
    "username": "'.$rs["username"].'",
    "user_id": "'.$rs["id"].'",
    "password": "'.$pw_md5.'"}]';
} else {
    echo '[{"response": 400}]';
}

$conn->close();
?>