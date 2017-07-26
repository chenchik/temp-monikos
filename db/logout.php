<?php
setcookie("user_id", "", time()-3600,'/');
setcookie("username", "", time()-3600,'/');
setcookie("remember_me", "", time()-3600,'/');

echo "cookies wiped";
?>
