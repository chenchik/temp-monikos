<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';
 
$pw_md5=md5($_POST["password"]);
$sql = "INSERT INTO Users (id, username, email, password, schoolid, schoolname)
VALUES (NULL, '".$_POST["username"]."', '".$_POST["email"]."', '".$pw_md5."', '".$_POST["schoolid"]."', '".$_POST["schoolname"]."')";

if ($conn->query($sql) === TRUE) {
    echo '[{
    "response": 200,
    "username": "'.$_POST["username"].'",
    "email": "'.$_POST["email"].'",
    "password": "'.$pw_md5.'"}]';
} else {
    echo '[{"response":"'.$conn->error.'"}]';
}

$conn->close();
?>