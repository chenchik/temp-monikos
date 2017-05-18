<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';

$output = "";
$sql = "UPDATE Users SET capsules = capsules + " .$_POST['capsules']. " WHERE id = '" .$_POST['id'] . "'";
if ($conn->query($sql) === TRUE) {

    $result = $conn->query("SELECT id,username,capsules FROM Users WHERE id = " .$_POST['id']);

	$outp = "";
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	    if ($outp != "") {$outp .= ",";}
	   
	    $rs["id"] = json_encode($rs["id"]);
	    $rs["capsules"] = json_encode($rs["capsules"]);


	    $outp .= '{"id":'  . $rs["id"] . ',';
	    $outp .= '"capsules":'. $rs["capsules"]     . '}';
	   
	}
	$outp ='{"records":['.$outp.']}';
	echo $outp;

} else {
	echo '[{"response":"'.$conn->error.'"}]';
}

$conn->close();
?>