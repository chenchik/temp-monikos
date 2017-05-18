<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';


$result = $conn->query("SELECT id,capsules,email,username FROM Users WHERE id = '" .$_POST['id']. "'");

function utf8_encode_deep(&$input) {
    if (is_string($input)) {
        $input = utf8_encode($input);
    } else if (is_array($input)) {
        foreach ($input as &$value) {
            utf8_encode_deep($value);
        }

        unset($value);
    } else if (is_object($input)) {
        $vars = array_keys(get_object_vars($input));

        foreach ($vars as $var) {
            utf8_encode_deep($input->$var);
        }
    }
}


$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
   
    $rs["id"] = json_encode($rs["id"]);
    utf8_encode_deep($rs["username"]);
    $rs["username"] = json_encode($rs["username"]);
    utf8_encode_deep($rs["email"]);
    $rs["capsules"] = json_encode($rs["capsules"]);
    $rs["email"] = json_encode($rs["email"]);


    $outp .= '{"id":'  . $rs["id"] . ',';
    $outp .= '"username":'  . $rs["username"] . ',';
    $outp .= '"email":'  . $rs["email"] . ',';
    $outp .= '"capsules":'. $rs["capsules"]     . '}';
    //$outp .= '{"username":"'. $rs["username"] . '",';
    //$outp .= '"email":"'. $rs["email"]     . '"}';


}
$outp ='{"records":['.$outp.']}';

$conn->close();
echo($outp);
?>