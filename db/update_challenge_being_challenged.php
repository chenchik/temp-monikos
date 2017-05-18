<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';

$sql = "UPDATE Challenge SET user2score = " .$_POST['user2score']. " WHERE challengeid = " .$_POST['challengeid'];

if ($conn->query($sql) === TRUE) {
    echo '[{
    "response": 200,
    "challengeid": "'.$_POST["challengeid"].'",
    "user2score": "'.$_POST["user2score"].'"}]';
} else {
    echo '[{"response":"'.$conn->error.'"}]';
}

$conn->close();
echo($result);
?>