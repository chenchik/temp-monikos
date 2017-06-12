<?php

/*Created by Danila Chenchik Monikos LLC*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';
 

// $sql = "INSERT INTO Users (id, username, email, password, schoolid, schoolname)
// VALUES (NULL, '".$_POST["username"]."', '".$_POST["email"]."', '".$pw_md5."', '".$_POST["schoolid"]."', '".$_POST["schoolname"]."')";


$collection=$client->monikos->Drugs;

$result=$collection->find();


foreach ($result as $drug) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Generic":'  . $drug["Generic"] . ',';
    $outp .= '"DrugId":'   . $drug["_id"]        . ',';
    $outp .= '"Brand":'   . json_encode($drug["Brand"])        . ',';
    $outp .= '"Class":'   . json_encode($drug["Class"])        . ',';
    $outp .= '"Indication":'   . json_encode($drug["Indication and Dosage"])        . ',';
    $outp .= '"Side Effects":'   . json_encode($drug["Side Effects"])        . ',';
    $outp .= '"Black Box Warning":'   . json_encode($drug["Black Box Warning"])        . ',';
    $outp.='"Renal Adjustment":'.json_encode($drug["Renal Adjustment"]).',';
    $outp.='"Hepatic Adjustment":'.json_encode($drug["Hepatic Adjustment"]).',';
    $outp.='"Mechanism of Action":'.json_encode($drug["Mechanism of Action"]).',';
    $outp.='"Resources":'.json_encode($drug["Resources"]).'}';
}

echo $outp;

// if ($conn->query($sql) === TRUE) {
//     echo '[{
//     "response": 200,
//     "username": "'.$_POST["username"].'",
//     "email": "'.$_POST["email"].'",
//     "password": "'.$pw_md5.'"}]';
// } else {
//     echo '[{"response":"'.$conn->error.'"}]';
// }
// $conn->close();
// foreach ($result as $entry) {
//     echo $entry['_id'], ': ', $entry['username'], "\n";
// }

?>