<?php
/*function bdd_pdo()
{
return $db = new PDO('mysql:host=localhost;dbname=u539698594_test', 'u539698594_root', 'erwan01250');
}
function ajout_message($bdd,$message)
{
    $req = $bdd->prepare("INSERT INTO minichat(message) VALUES(:message");
    $req->execute(array("message"=>$message));
}

function message($bdd)
{
    $req = $bdd->query("SELECT * FROM minichat ORDER BY timestamp ASC");

    return $req;
}
*/
//fonction de connexion à la bd
function connexion_bd(){

    $nom_du_serveur ="localhost";
    $nom_de_la_base ="u539698594_test";
    $nom_utilisateur ="u539698594_root";
    $passe ="erwan01250";

    $link = mysql_connect ($nom_du_serveur,$nom_utilisateur,$passe) or die ('Erreur : '.mysql_error());
    mysql_select_db($nom_de_la_base, $link) or die ('Erreur :'.mysql_error());
    if (!$link) {
        die('Connexion impossible : ' . mysql_error() . "<br/>");
    }
}
function close_bd()
{
    mysql_close();
}
//email du webmaster
$email_webmaster = 'guilleterwan@aol.com';
?>
