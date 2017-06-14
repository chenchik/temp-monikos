<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';
$collection=$client->monikos->Users;
$result=$collection->findOne(["username"=>$_POST["username"]]);


if ($result["_id"]!=NULL) {
    echo '[{
	"response": 200,
    "login-status": "logged-in",
    "username": "'.$result["username"].'",
    "user_id": "'.$result["_id"].'"}]';
} else {
    echo '[{"response": 400}]';
}


?>