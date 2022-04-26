<?php
//Begin session and include the session file
include('session.php');

define('SERVER', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'boldswap');

$con = new mysqli(SERVER,USER,PASS,DB);

if($con->connect_error){
	die("Connection failed: ".$con->connect_error);
}

include_once('./include/loop.php');
?>