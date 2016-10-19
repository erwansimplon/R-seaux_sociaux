<?php
require_once("../bdd/connexion_bdd.php");
connexion_bd();
session_start();
if(isset($_GET['message']))
{
  $id=$_GET['id'];
  $idlog=$_GET['idlog'];
  $msg888=$_GET['message'];
  $pseudo=$_SESSION['pseudo'];
  date_default_timezone_set("Europe/paris");
  mysql_query("INSERT INTO minichat(message, timestamp, author_id, msg_ami_id, pseudo) VALUES('".$msg888."','".time()."', '".$id."','".$idlog."','".$pseudo."')");
}

?>
