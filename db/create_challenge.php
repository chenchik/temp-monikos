<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php'; 

// $sql = "INSERT INTO Challenge (challengeid, user1, user2, challengegame, bet, user1score, user2score, winner, url)
// VALUES (NULL, '".$_POST["user1"]."', '".$_POST["user2"]."', '" . $_POST["game"]. "', '". $_POST["bet"]."', -1, -1, NULL, '/dummyval')";


$challenge =['challengeid'=>NULL,
			 "user1"=>$_POST["user1"],
			 "user2"=>$_POST["user2"],
			 "challengegame"=>$_POST["game"],
			 "bet"=>$_POST["bet"],
			 "user1score"=> -1,
			 "user2score"=> -1,
			 "winner"=> NULL,
			 "url"=>$_POST["url"]
			 ];
$collection=$client->monikos->Challenge;
$result=$collection->insertOne($challenge);
// echo sizeof($result);


if ($result->getInsertedCount()) {
    echo '[{
    "response": 200,
    "challengeid": "'.$_POST["challengeid"].'",
    "user1": "'.$_POST["user1"].'",
    "user2": "'.$_POST["user2"].'",
    "game": "'.$_POST["game"].'",
    "bet": "'.$_POST["bet"].'"}]';
} else {
    echo '[{"response":"Please check server error log."}]';
}
// // // if ($conn->query($sql) === TRUE) {

// // // 	$last_id = $conn->insert_id;
// // //     echo '[{
// // //     "response": 200,
// // //     "challengeid": '.$last_id.',
// // //     "user1": "'.$_POST["user1"].'",
// // //     "user2": "'.$_POST["user2"].'",
// // //     "game": "'.$_POST["game"].'",
// // //     "bet": "'.$_POST["bet"].'"}]';
// // // } else {
// // //     echo '[{"response":"'.$conn->error.'"}]';
// // // }

// // $conn->close();
// echo($result);
?>