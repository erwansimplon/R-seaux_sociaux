<?php
$monid=$_GET['id'];
$monpseudo=$_GET['pseudo'];

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

?>
<form class="form-recherche" action='../recherche/url_search.php?id=<?php print $search."&pseudo=".$pseudo ?>' method='post'>
    <input id="search" name="pseudo" type="text" placeholder="Cherchez des personnes..."/>
    <button type="submit" id="submit" class="button_search"><img class="image_loupe" src="../photos/recherche/a.png" /></button>
</form>
