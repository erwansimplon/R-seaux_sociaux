<?php
include("../bdd/db.php");
$msgcon=$_POST['message'];
mysql_query("INSERT INTO msg (message)
VALUES ('$msgcon')");
header("location: ../general/page-user.php");
?>
