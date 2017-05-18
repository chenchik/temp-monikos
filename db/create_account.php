<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';
 

$sql = "INSERT INTO Users (id, username, email, password, schoolid, schoolname)
VALUES (NULL, '".$_POST["username"]."', '".$_POST["email"]."', '".$_POST["password"]."', '".$_POST["schoolid"]."', '".$_POST["schoolname"]."')";

if ($conn->query($sql) === TRUE) {
    echo '[{
    "response": 200,
    "username": "'.$_POST["username"].'",
    "email": "'.$_POST["email"].'",
    "password": "'.$_POST["password"].'"}]';
} else {
    echo '[{"response":"'.$conn->error.'"}]';
}

$conn->close();
echo($result);
?>