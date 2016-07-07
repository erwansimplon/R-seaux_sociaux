<?php
include("../bdd/connexion_bdd.php");
$mcomment=$_POST['mcomment'];
$mesgid=$_POST['mesgid'];
mysql_query("INSERT INTO comm (comments, msg_id_fk)
VALUES ('$mcomment','$mesgid')");
header("location: ../general/page-user.php");
?>
