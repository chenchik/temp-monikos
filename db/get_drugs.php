 <?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';
$collection =$client->monikos->Drugs2;

$result=$collection->find();


$outp = "";

foreach ($result as $drug) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Generic":"'  . $drug['Generic'] . '",';
    $outp .= '"DrugId":"'   . $drug["_id"]        . '",';
    $outp .= '"Brand":'   . json_encode($drug['Brand'])        . ',';
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
    $outp.='"Likes":'.json_encode($drug["Likes"]).',';
    $outp.='"Dislikes":'.json_encode($drug["Dislikes"]).'}';
}
$outp ='{"records":['.$outp.']}';

// $conn->close();

echo($outp);
?>