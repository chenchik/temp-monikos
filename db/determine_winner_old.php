<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';

$result = $conn->query("SELECT * FROM Challenge WHERE challengeid LIKE '".$_POST['challengeid'] ."'");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"challengeid":"'  . $rs["challengeid"] . '",';
    $outp .= '"details":"determiningwinner",';
    $outp .= '"bet":"'   . $rs["bet"] . '",';
    $outp .= '"user1":"'   . $rs["user1"] . '",';
    $outp .= '"user2":"'   . $rs["user2"] . '",';
    $outp .= '"user1score":"'   . $rs["user1score"] . '",';
    $outp .= '"user2score":"'. $rs["user2score"]     . '"}';
}
//$outp ='{"records":['.$outp.']}';
echo($outp);
$conn->close();
//echo($result);
?>