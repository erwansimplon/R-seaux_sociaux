<?php
session_start();

$idlog=$_GET['id'];
$pseudo=$_GET['pseudo'];
$id = $_SESSION['id'];
$id_msg_fk = $_GET['com_id'];
// va chercher le fichier connexion
include("../bdd/connexion_bdd.php");
connexion_bd();

$comm="SELECT DISTINCT * from comments where com_id=$id_msg_fk";
  // $req ="insert into messages (message, IdLog) VALUES ('Mon message','$id')";

  $msql2=mysql_query($comm);


  //bug a corrigé les 2 boucles while on un confli
    while($com=mysql_fetch_array($msql2, MYSQL_ASSOC))
    {
      $fk_id_msg=$com['com_id'];
      $comment=$com['comments'];
    }

    echo $comm;

    $suppr_comm = mysql_query("DELETE FROM comments WHERE com_id=$fk_id_msg");

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

header("location: ../user/user.php?id=$id");

?>
