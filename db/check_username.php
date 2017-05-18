<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';

$result = $conn->query("SELECT * FROM Users WHERE username = '" . $_POST['username'] . "'");

$outp = "";
$count = 0;
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    $count++;
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id":"'  . $rs["id"] . '",';
    $outp .= '"user":true,';
    $outp .= '"username":"'. $rs["username"]     . '"}';
}
if($count){
	$outp ='{"records":['.$outp.']}';	
}else{
	$outp .= '"user": false';
	$email = $_POST["email"];
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		$outp .= ',"email": false';
	}else{
		$outp .= ',"email": true';
	}
	$outp ='{"records":[{'. $outp .'}]}';
}

echo($outp);
$conn->close();
?>