<?php
$monid=$_GET['id'];
$monpseudo=$_GET['pseudo'];

include("../bdd/connexion_bdd.php");
connexion_bd();

$requete = htmlspecialchars($_POST['pseudo']); // on crée une variable $requete pour faciliter l'écriture de la requête SQL, mais aussi pour empêcher les éventuels malins qui utiliseraient du PHP ou du JS, avec la fonction htmlspecialchars().
$query = mysql_query("SELECT * FROM LOGIN WHERE pseudo = '$requete' ORDER BY id DESC") or die (mysql_error()); // la requête, que vous devez maintenant comprendre ;)

//*******************************************************************

while($donnees = mysql_fetch_array($query)) // on fait un while pour afficher la liste des fonctions trouvées, ainsi que l'id qui permettra de faire le lien vers la page de la fonction

{

$pseudo=$donnees['pseudo'];
$idami=$donnees['id'];
$search=$idami;
}
header("location: ../page-user/page-user.php?id=".$search."&pseudo=".$pseudo);

?>
