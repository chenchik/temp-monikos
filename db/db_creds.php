<?php

/*Created by Danila Chenchik Monikos LLC*/

/*old db credentials
$host = "mysql.danilachenchik.com";
$dbuser = "mnksdbun";
$pass = "mnksdbpw";
$dbname = "mnkstest";
*/

//$host = "104.236.241.100:3306";
$host = 'localhost';
$dbuser = "root";
$pass = "kc3irtapdnayeli29r";
$dbname = "monikosmasterDB";

$conn = new mysqli($host, $dbuser, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//mysql_connect($host, $dbuser, $pass);

//echo 'connection success';

?>