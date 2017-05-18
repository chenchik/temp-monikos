<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_creds.php';

$result = $conn->query("SELECT * FROM Drug");

function clean($string) {
    //adds div class to Mnemonics
    $string = str_replace('(', '(<div class=key-terms>', $string); 
    $string = str_replace(')', '</div>)', $string);

    return $string;
}

function cleanPlus($string) {
    $string = str_replace('+', '', $string); 

    return $string;

}

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
    $rs["Brand/Generic Hint"] = clean($rs["Brand/Generic Hint"]);
    $rs["Class"] = cleanPlus($rs["Class"]);
    $rs["Indication"] = cleanPlus($rs["Indication"]);
    $rs["Black Box Warning"] = cleanPlus($rs["Black Box Warning"]);
    $rs["Generic"] = json_encode($rs["Generic"]);
    $rs["DrugId"] = json_encode($rs["DrugId"]);
    $rs["Brand"] = json_encode($rs["Brand"]);
    $rs["Class"] = json_encode($rs["Class"]);
    utf8_encode_deep($rs["Indication"]);
    $rs["Indication"] = json_encode($rs["Indication"]);
    utf8_encode_deep($rs["Black Box Warning"]);
    $rs["Black Box Warning"] = json_encode($rs["Black Box Warning"]);
    utf8_encode_deep($rs["Brand/Generic Hint"]);
    $rs["Brand/Generic Hint"] = json_encode($rs["Brand/Generic Hint"]);
    utf8_encode_deep($rs["Side Effects"]);
    $rs["Side Effects"] = json_encode($rs["Side Effects"]);
    utf8_encode_deep($rs["Generic Audio"]);
    $rs["Generic Audio"] = json_encode($rs["Generic Audio"]);
    utf8_encode_deep($rs["Brand Audio"]);
    $rs["Brand Audio"] = json_encode($rs["Brand Audio"]);


    $outp .= '{"Generic":'  . $rs["Generic"] . ',';
    $outp .= '"DrugId":'   . $rs["DrugId"]        . ',';
    $outp .= '"Brand":'   . $rs["Brand"]        . ',';
    $outp .= '"Class":'   . $rs["Class"]        . ',';
    $outp .= '"Indication":'   . $rs["Indication"]        . ',';
    $outp .= '"Side Effects":'   . $rs["Side Effects"]        . ',';
    $outp .= '"Black Box Warning":'   . $rs["Black Box Warning"]        . ',';
    $outp .= '"Mnemonic":'. $rs["Brand/Generic Hint"]       . ',';
    $outp .= '"Generic Audio":'. $rs["Generic Audio"]       . ',';
    $outp .= '"Brand Audio":'. $rs["Brand Audio"]       . ',';
    $outp .= '"HintLikes":"'   . $rs["HintLikes"]        . '",';
    $outp .= '"HintDislikes":"'. $rs["HintDislikes"]     . '"}';

}
$outp ='{"records":['.$outp.']}';

$conn->close();

echo($outp);
?>