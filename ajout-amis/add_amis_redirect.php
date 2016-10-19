<?php

$idlog=$_GET['id'];
$pseudo=$_GET['pseudo'];
// va chercher le fichier connexion
include("../bdd/connexion_bdd.php");
connexion_bd();

$add_amis = "SELECT * FROM LOGIN WHERE id=$idlog";
while($donnees = mysql_fetch_array($add_amis)) // on fait un while pour afficher la liste des fonctions trouvées, ainsi que l'id qui permettra de faire le lien vers la page de la fonction

{

$pseudo=$donnees['pseudo'];
$idami=$donnees['id'];
$search=$idami;
}

header("location: ../page-user/page-user.php?id=".$idlog."&pseudo=".$pseudo);
?>
