<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';

$sql = "SELECT * FROM Challenge WHERE user2 LIKE '".$_POST["user"]."'";
$result = $conn->query($sql);

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Challengeid":"'  . $rs["challengeid"] . '",';
    $outp .= '"user2":"'   . $rs["user2"]        . '",';
    $outp .= '"user1":"'   . $rs["user1"]        . '",';
    $outp .= '"bet":"'   . $rs["bet"]        . '",';
    $outp .= '"challengegame":"'   . $rs["challengegame"]        . '",';
    $outp .= '"url":"'. $rs["url"]     . '"}';
}
$outp ='{"records":['.$outp.']}';
echo($outp);
$conn->close();
?>