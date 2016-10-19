<?php
include("../bdd/connexion_bdd.php");
connexion_bd();
session_start();
$id=$_SESSION['id'];
$monid=$_GET['idlog'];
$monpseudo=$_GET['pseudo'];
$mcomment=$_POST['mcomment'];
$mesgid=$_POST['mesgid'];
mysql_query("INSERT INTO comm (comments, msg_id_fk, idLog)
VALUES ('".htmlentities(addslashes($mcomment))."','$mesgid','$id')");
$hachage = $monid;
$hash_pseudo = $monpseudo;
if($id == $monid){
  $URL_NEWS = "../page-user/page-user.php?id=".$hachage;
}
else{
  $URL_NEWS = "../page-user/page-user.php?id=".$hachage."&pseudo=".$hash_pseudo;
}
header("location: $URL_NEWS");
?>
