
<?php
//va cherche le fichier connexion a la bdd 
include("../bdd/connexion_bdd.php");
session_start();

$req="SELECT * FROM LOGIN WHERE pseudo='".mysql_real_escape_string(stripcslashes($_SESSION['pseudo']))."'
AND pass='".mysql_real_escape_string($_SESSION['pass'])."'
AND valide='".mysql_real_escape_string(1)."'";


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
$req="INSERT INTO messages (message, idLog) VALUES ('$msgcon', '$id')";
//test 
print $req; 
print "<br>pseudo = ".$_SESSION['pseudo'];
print "<br>id = ".$id;
// fin test
mysql_query($req);
// redirige vers la page initial 
header("location: ../general/user.php");
?>
