<?php

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
$email_webmaster = 'guilleterwan@gmail.com';
?>
