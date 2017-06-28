<?php 


require_once 'db_init.php';
  
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//currently need to use MongoDB\Driver\Manager to implement the sort method for php driver mongodb 1.2. did not use MondoDB\Client here
$manager = new \MongoDB\Driver\Manager('mongodb://root:kc3irtapdnayeli29r@104.236.241.100:27017');
$database = 'monikos.Users';
//this is the filter for the database. 

//$username = $_POST['username'];
$username = "bruh";

$filter = [
    'username' => $username
];
$query = new MongoDB\Driver\Query($filter);
$cursor = $manager -> executeQuery($database,$query);
$school = "";
foreach($cursor as $data => $value){
    $school = $value->schoolname;
};

$filter = [
    'schoolname'=>$school
];
$query = new \MongoDB\Driver\Query(
        $filter, 
        [ 'sort' => [ 'capsules' => -1], 'limit' => 10 ] 
);

$cursor = $manager->executeQuery( $database, $query );

$outp ="";
foreach($cursor as $data => $value){
    $rank = $value->username." has ".$value->capsules." capsules"; 
    $data++;
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"content":'.json_encode($rank);
    $outp .= ', "number":'.json_encode($data);
    $outp .= "}";
}
$outp ='{"records":['.$outp.']}';
echo $outp;

?>