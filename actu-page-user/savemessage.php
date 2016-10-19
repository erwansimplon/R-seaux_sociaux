<?php
//va cherche le fichier connexion a la bdd
include("../bdd/connexion_bdd.php");
connexion_bd();

session_start();

$req="SELECT * FROM LOGIN WHERE pseudo='".mysql_real_escape_string(stripcslashes($_SESSION['pseudo']))."'
AND pass='".mysql_real_escape_string($_SESSION['pass'])."'
AND valide='".mysql_real_escape_string(1)."'";
$monid=$_GET['idlog'];
$monpseudo=$_GET['pseudo'];
print $monid;
print "recup session = $req";

$affiche = mysql_query($req);
//$result = mysql_fetch_assoc($affiche);
while($msg=mysql_fetch_array($affiche, MYSQL_ASSOC))
{
$_SESSION['id']=$msg['id'];
$_SESSION['pseudo']=$msg['pseudo'];
$_SESSION['pass']=$msg['pass'];
}

$id=$_SESSION['id'];
//capture le message envoyer par l'utilisateur
$msgcon=$_POST['message'];

// envoie les donner dans la bdd
$req="INSERT INTO msg (message, jointure, idLog) VALUES ('".htmlentities(addslashes($msgcon))."','$monid', '$id')";
//test
print $req;
print "<br>pseudo = ".$_SESSION['pseudo'];
print "<br>id = ".$id;
// fin test
mysql_query($req);
// redirige vers la page initial
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
