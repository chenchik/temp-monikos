 <?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_init.php';
$collection =$client->monikos->Trial_Drugs;
function dotParser($string){
    return str_replace("_", ".", $string);
}
$result=$collection->find([],['sort'=>["Generic"=>1],]);
$outp = "";
foreach ($result as $drug) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Generic":"'  . $drug['Generic'] . '",';
    $outp .= '"DrugId":"'   . $drug["_id"].'",';
    $outp .= '"Brand":'   . dotParser(json_encode($drug['Brand'])).',';
    $outp .= '"Class":'   . dotParser(json_encode($drug["Class"])).',';
    $outp .= '"Indication":'   . dotParser(json_encode($drug["Indication & Dosage"])).',';
    $outp .= '"Side Effects":'   . dotParser(json_encode($drug["Side Effects"])).',';
    $outp .= '"Black Box Warning":'   . dotParser(json_encode($drug["Black Box Warning"])).',';
    $outp.='"Renal Adjustment":'.dotParser(json_encode($drug["Renal Adjustment"])).',';
    $outp.='"Hepatic Adjustment":'.dotParser(json_encode($drug["Hepatic Adjustment"])).',';
    $outp.='"Mechanism of Action":'.dotParser(json_encode($drug["Mechanism of Action"])).',';

    $outp.='"Resources":'.dotParser(json_encode($drug["Resources"])).',';
    $outp.='"Generic Audio":'.dotParser(json_encode($drug["Generic Audio"])).',';
    $outp.='"Brand Audio":'.dotParser(json_encode($drug["Brand Audio"])).',';
    $outp.='"Hint":'.dotParser(json_encode($drug["Hint"])).',';
    $outp.='"Likes":'.dotParser(json_encode($drug["Likes"])).',';
    $outp.='"Dislikes":'.dotParser(json_encode($drug["Dislikes"])).'}';
}
$outp ='{"records":['.$outp.']}';

// $conn->close();

echo($outp);

?>