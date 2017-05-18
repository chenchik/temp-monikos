<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';

if(empty($_POST["id"])) {
    //used nowhere as of now, but if need to get lists by school id
    $sql = "SELECT * FROM SchoolLists WHERE schoolid LIKE '".$_POST["school_id"]."'";

} else {
    
    //used in List Manager when the param is user_id
    $sql_getid =  "SELECT schoolid FROM Users WHERE id LIKE '" .$_POST["id"]."'";
    $result_getid = $conn->query($sql_getid);
    $outp_getid = "";
    while($rs = $result_getid->fetch_array(MYSQLI_ASSOC)) {
        if ($outp != "") {$outp .= ",";}
        $outp_getid .= $rs["schoolid"];
    }
    $sql = "SELECT * FROM SchoolLists WHERE schoolid LIKE '".$outp_getid."'";

}

$result = $conn->query($sql);

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"list_id":"'  . $rs["lid"] . '",';
    $outp .= '"school_list_id":"'  . $rs["slid"] . '",';
    $outp .= '"list_name":"'   . $rs["name"]        . '",';
    $outp .= '"drugnames":"'. $rs["drugnames"]     . '"}';

}
$outp ='{"records":['.$outp.']}';
echo($outp);




$conn->close();

?>