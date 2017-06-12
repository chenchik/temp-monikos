<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';


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
$collection=$client->monikos->Lists;
$list=["lid"=>NULL,
		"uid"=>$_POST["user_id"],
		"name"=>$_POST["name"],
		"drugids"=>11,
		"drugnames"=>$drugs,
		];
$result=$collection->insertOne($list);


if ($result->getInsertedCount()) {
    echo '[{
    "response": 200,
    "name": "'.$_POST["name"].'"}]';
} else {
    echo '[{"response":"Please check server error log."}]';
}


?>
