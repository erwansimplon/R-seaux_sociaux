<?php
$mysql_hostname = "localhost";
$mysql_user = "u539698594_root";
$mysql_password = "erwan01250";
$mysql_database = "u539698594_test";

$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps");
mysql_select_db($mysql_database, $bd) or die("Opps");

?>
