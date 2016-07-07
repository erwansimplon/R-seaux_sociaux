<?php
include("../bdd/connexion_bdd.php");
$msgcon=$_POST['message'];
mysql_query("INSERT INTO msg (message)
VALUES ('$msgcon')");
header("location: ../general/page-user.php");
?>
