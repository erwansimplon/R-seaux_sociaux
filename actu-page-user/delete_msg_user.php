<?php
session_start();

$idlog=$_GET['id'];
$pseudo=$_GET['pseudo'];
$id = $_SESSION['id'];
$id_msg = $_GET['msg_id'];
// va chercher le fichier connexion
include("../bdd/connexion_bdd.php");
connexion_bd();

$msg="SELECT DISTINCT * from msg where msg_id=$id_msg";


$msql=mysql_query($msg);



  while($msgs=mysql_fetch_array($msql, MYSQL_ASSOC))
  {
    $id_msg=$msgs['msg_id'];
    $msgcontent=$msgs['message'];
  }

  $suppr_msg = mysql_query("DELETE FROM msg WHERE msg_id=$id_msg");
  echo $msg;

  if (!$suppr_msg)
  {
    die ( 'Erreur de requête : ' . mysql_error() );
  }
  //Si tout va bien
  else
  {
    echo 'Les données ont été effacées.';
  }
  echo $suppr_msg;

$comm="SELECT DISTINCT * from comm where msg_id_fk=$id_msg";
  // $req ="insert into messages (message, IdLog) VALUES ('Mon message','$id')";

  $msql2=mysql_query($comm);


  //bug a corrigé les 2 boucles while on un confli
    while($com=mysql_fetch_array($msql2, MYSQL_ASSOC))
    {
      $fk_id_msg=$com['msg_id_fk'];
      $comment=$com['comments'];
    }

    echo $comm;

    $suppr_comm = mysql_query("DELETE FROM comm WHERE msg_id_fk=$id_msg");

if (!$suppr_comm)
{
die ( 'Erreur de requête : ' . mysql_error() );
}
//Si tout va bien
else
{
echo 'Les données ont été effacées.';
}

echo $suppr_comm;

if($id == $idlog){
  header("location: ../page-user/page-user.php?id=".$idlog);
}
else {
  header("location: ../page-user/page-user.php?id=".$idlog."&pseudo=".$pseudo);
}
?>
