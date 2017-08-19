<?php

require 'db_init.php';

set_time_limit(300);

$schools = array();
$names = $client->monikos->Programs->find();
foreach($names as $name){
    $schools[$name['schoolname']] = 0;
}

foreach($schools as $school=>$capsules){
    $collection = $client -> monikos -> Users;
    $users = $collection->find(['schoolname'=>$school]);
    $ct = $collection->count(['schoolname'=>$school]);

        foreach($users as $user){
            $schools[$school] += $user['capsules'];
        };

}

arsort($schools);

$ct = 1;
$outp = "";
foreach($schools as $school=>$capsules){
    if($ct<11){
        $rank = $school." : ".$capsules." capsules";
        $outp .= '{"content":'.json_encode($rank);
        $outp .= ', "number":'.json_encode($ct);
        $outp .= "}";
        $ct++;
    }else{
        break;
    }
}
$outp ='{"records":['.$outp.']}';
echo $outp;
?>