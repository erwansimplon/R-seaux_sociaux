<?php
include("../bdd/db.php");

$mcomment=$_POST['mcomment'];
$mesgid=$_POST['mesgid'];
mysql_query("INSERT INTO comm (comments, msg_id_fk)
VALUES ('$mcomment','$mesgid')");
$hachage = sha1("id=".$rows['id']."&pseudo=".$rows['pseudo']);
$URL_NEWS = "../general/page-user.php?id=".$hachage;
header("location: $URL_NEWS");
?>
