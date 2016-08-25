<?php
$monid=$_GET['id'];
$monpseudo=$_GET['pseudo'];

include("../bdd/db.php");// on se connecte à MySQL. Je vous laisse remplacer les différentes informations pour adapter ce code à votre site.

$requete = htmlspecialchars($_POST['pseudo']); // on crée une variable $requete pour faciliter l'écriture de la requête SQL, mais aussi pour empêcher les éventuels malins qui utiliseraient du PHP ou du JS, avec la fonction htmlspecialchars().
$query = mysql_query("SELECT * FROM LOGIN WHERE pseudo = '$requete' ORDER BY id DESC") or die (mysql_error()); // la requête, que vous devez maintenant comprendre ;)

//*******************************************************************

while($donnees = mysql_fetch_array($query)) // on fait un while pour afficher la liste des fonctions trouvées, ainsi que l'id qui permettra de faire le lien vers la page de la fonction

{


$idami=$donnees['id'];
$search=$idami;
}

?>
<form class="form-recherche" action='url_search.php?id=<?php print $search ?>' method='post'>
    <input id="search" name="pseudo" type="text" placeholder="Cherchez des personnes..."/>
    <button type="submit" id="submit" class="button_search"><img class="image_loupe" src="../auth-photos/a.png" /></button>
</form>
<?php
    if(isset($_POST['submit']))
    {
    header("Location: url_search.php?id=print $search");
    }
?>
