<?php

/*Created by Danila Chenchik, Joseph Son Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';

$result = $conn->query("SELECT DISTINCT program FROM Programs ORDER BY program");

//encodes string to utf8
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

    utf8_encode_deep($rs["program"]);
    $rs["program"] = json_encode($rs["program"]);
 
    
    $outp .= '{"program":'  . $rs["program"] . '}';

}
$outp ='{"records":['.$outp.']}';

$conn->close();

echo($outp);



?>
