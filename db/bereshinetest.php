bereshine [3:27 PM] 
<?php 
require_once 'db_init.php';


$cursor = $client->monikos->Users->find();
 $cursor = $cursor->sort(array("capsules" => -1));
?>