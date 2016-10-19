<?php
session_start();

$idlog=$_GET['id'];
$pseudo=$_GET['pseudo'];
$id = $_SESSION['id'];
// va chercher le fichier connexion
include("../bdd/connexion_bdd.php");
connexion_bd();

$add_amis = "SELECT * FROM amis WHERE idlog=$idlog";
while($donnees = mysql_fetch_array($add_amis)) // on fait un while pour afficher la liste des fonctions trouvées, ainsi que l'id qui permettra de faire le lien vers la page de la fonction

{

$pseudo=$donnees['pseudo'];
$idami=$donnees['id'];
$search=$idami;
}

$ins = mysql_query("DELETE FROM amis WHERE idlog='$idlog' and idami='$id'");

echo '<h1>vvvv'.$ins.'vvvv</h1>';
header("location: add_amis_redirect.php?id=".$idlog."&pseudo=".$pseudo);
