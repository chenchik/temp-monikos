<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';
$collection=$client->monikos->Drugs;

$result=$collection->find();


$outp = "";

foreach ($result as $drug) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Generic":"'  . $drug["Generic"] . '",';
    $outp .= '"DrugId":"'   . $drug["_id"]        . '",';
    $outp .= '"Brand":'   . json_encode($drug["Brand"])        . ',';
    $outp .= '"Class":'   . json_encode($drug["Class"])        . ',';
    $outp .= '"Indication":'   . json_encode($drug["Indication and Dosage"])        . ',';
    $outp .= '"Side Effects":'   . json_encode($drug["Side Effects"])        . ',';
    $outp .= '"Black Box Warning":'   . json_encode($drug["Black Box Warning"])        . ',';
    $outp.='"Renal Adjustment":'.json_encode($drug["Renal Adjustment"]).',';
    $outp.='"Hepatic Adjustment":'.json_encode($drug["Hepatic Adjustment"]).',';
    $outp.='"Mechanism of Action":'.json_encode($drug["Mechanism of Action"]).',';
    $outp.='"Resources":'.json_encode($drug["Resources"]).',';
    $outp.='"Generic Audio":'.json_encode($drug["Generic Audio"]).',';
    $outp.='"Brand Audio":'.json_encode($drug["Brand Audio"]).',';
    $outp.='"Hint":'.json_encode($drug["Hint"]).',';
    $outp.='"Likes":"'.json_encode($drug["Likes"]).'",';
    $outp.='"Dislikes":"'.json_encode($drug["Dislikes"]).'"}';
}
// while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
//     if ($outp != "") {$outp .= ",";}
//     // $rs["Brand/Generic Hint"] = clean($rs["Brand/Generic Hint"]);
//     $rs["Class"] = cleanPlus($rs["Class"]);
//     $rs["Indication"] = cleanPlus($rs["Indication"]);
//     $rs["Black Box Warning"] = cleanPlus($rs["Black Box Warning"]);
//     $rs["Generic"] = json_encode($rs["Generic"]);
//     $rs["DrugId"] = json_encode($rs["DrugId"]);
//     $rs["Brand"] = json_encode($rs["Brand"]);
//     $rs["Class"] = json_encode($rs["Class"]);
//     utf8_encode_deep($rs["Indication"]);
//     $rs["Indication"] = json_encode($rs["Indication"]);
//     utf8_encode_deep($rs["Black Box Warning"]);
//     $rs["Black Box Warning"] = json_encode($rs["Black Box Warning"]);
//     utf8_encode_deep($rs["Brand/Generic Hint"]);
//     $rs["Brand/Generic Hint"] = json_encode($rs["Brand/Generic Hint"]);
//     utf8_encode_deep($rs["Side Effects"]);
//     $rs["Side Effects"] = json_encode($rs["Side Effects"]);
//     utf8_encode_deep($rs["Generic Audio"]);
//     $rs["Generic Audio"] = json_encode($rs["Generic Audio"]);
//     utf8_encode_deep($rs["Brand Audio"]);
//     $rs["Brand Audio"] = json_encode($rs["Brand Audio"]);


//     $outp .= '{"Generic":'  . $rs["Generic"] . ',';
//     $outp .= '"DrugId":'   . $rs["DrugId"]        . ',';
//     $outp .= '"Brand":'   . $rs["Brand"]        . ',';
//     $outp .= '"Class":'   . $rs["Class"]        . ',';
//     $outp .= '"Indication":'   . $rs["Indication"]        . ',';
//     $outp .= '"Side Effects":'   . $rs["Side Effects"]        . ',';
//     $outp .= '"Black Box Warning":'   . $rs["Black Box Warning"]        . ',';
//     $outp .= '"Mnemonic":'. $rs["Brand/Generic Hint"]       . ',';
//     $outp .= '"Generic Audio":'. $rs["Generic Audio"]       . ',';
//     $outp .= '"Brand Audio":'. $rs["Brand Audio"]       . ',';
//     $outp .= '"HintLikes":"'   . $rs["HintLikes"]        . '",';
//     $outp .= '"HintDislikes":"'. $rs["HintDislikes"]     . '"}';

// }
$outp ='{"records":['.$outp.']}';

// $conn->close();

echo($outp);
?>