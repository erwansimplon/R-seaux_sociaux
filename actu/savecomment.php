<?php
// va chercher le fichier connexion 
include("../bdd/connexion_bdd.php");
// capture le champs envoyer 
$mcomment=$_POST['mcomment'];
// capture le id du message ou est écrit le commentaire
$mesgid=$_POST['mesgid'];
// écrit les donné dans la bdd  
mysql_query("INSERT INTO comments (comments, msg_id_fk)
VALUES ('$mcomment','$mesgid')");
//redirige vers la page initial
header("location: ../general/user.php");
?>
