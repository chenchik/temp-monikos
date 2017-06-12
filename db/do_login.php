<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';

$pw_md5=md5($_POST["password"]);
$collection=$client->monikos->Users;
$result=$collection->findOne(["username"=>$_POST["username"],
                            "password"=>$pw_md5]);
if(sizeof($result)==0){
     echo '[{"response": 400}]';
 }else{

    $cookie_name = "user_id";
    $cookie_value = $result["_id"];
    setcookie("user_id", $result["_id"], time() + (86400 * 30), "/");
    setcookie("username", $result["username"], time() + (86400 * 30), "/");
    //setcookie("cookietest");
    // output data of each row
    echo '[{
    "response": 200,
    "login-status": "logged-in",
    "username": "'.$result["username"].'",
    "user_id": "'.$result["id"].'",
    "password": "'.$pw_md5.'"}]';
 }
// $sql = "SELECT * FROM Users WHERE username LIKE '".$_POST["username"]."' AND password LIKE '".$pw_md5."'";
// $result = $conn->query($sql);



?>