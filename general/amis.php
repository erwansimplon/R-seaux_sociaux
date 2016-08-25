<?php
$idlog=$_GET['id'];
$pseudo=$_GET['pseudo'];
// va chercher le fichier connexion
include("../bdd/db.php");
$requete = htmlspecialchars($_POST['pseudo']); // on crée une variable $requete pour faciliter l'écriture de la requête SQL, mais aussi pour empêcher les éventuels malins qui utiliseraient du PHP ou du JS, avec la fonction htmlspecialchars().
$query = mysql_query("SELECT * FROM LOGIN WHERE pseudo = '$requete' ORDER BY pseudo DESC") or die (mysql_error()); // la requête, que vous devez maintenant comprendre ;)

//*******************************************************************

while($donnees = mysql_fetch_array($query)) // on fait un while pour afficher la liste des fonctions trouvées, ainsi que l'id qui permettra de faire le lien vers la page de la fonction

{


$idami=$donnees['id'];
$pseudo=$donnees['pseudo'];
$search=$idami;
}
// écrit les donné dans la bdd
mysql_query("INSERT INTO amis (pseudo, idlog)
VALUES ('$pseudo','$idlog')");
//redirige vers la page initial
echo $pseudo;
echo "good";
echo $idlog;
?>
