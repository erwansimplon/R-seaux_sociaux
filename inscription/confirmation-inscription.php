<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="Content-Language" content="fr" />
        <link rel="stylesheet" href="../css/style-index.css" type="text/css" media="screen" />
        <title>Confirmation de votre inscription</title>
    </head>
<body>

<div id="centre">
    <h1>Confirmation de votre inscription</h1>

        <p id="lien"><a href="../index.php">Connexion</a> |
        <a href="creer-compte.php">Créer un compte</a> |
        <a href="identifiant-perdu.php">Identifiant perdu?</a></p>
</div>

<noscript>
  <div id="erreur">
    <b>Votre navigateur ne prend pas en charge JavaScript!</b>
       Veuillez activer JavaScript afin de profiter pleinement du site.
  </div>
</noscript>

<?php
//on récupère le pseudo et le mail transmit dans le lien de confirmation
if(isset($_GET['pseudo']) && isset($_GET['email'])){
    //on se connecte à la BD
    include("../bdd/connexion_bdd.php");
    connexion_bd();
    //on va chercher en BD tout ce qui correspond à l'email
    $affiche = mysql_query("SELECT * FROM LOGIN
      WHERE email='".mysql_real_escape_string($_GET['email'])."'");
    $result = mysql_fetch_assoc($affiche);
    //http://php.net/manual/fr/function.extract.php
    extract($result);
    //on vérifie si la paire pseudo/mail existe
    $verif = mysql_query("SELECT pseudo, email FROM LOGIN
      WHERE pseudo='".mysql_real_escape_string(stripcslashes(utf8_decode($_GET['pseudo'])))."'
      AND email='".mysql_real_escape_string($_GET['email'])."'");
    //si la paire pseudo/mail n'existe pas
    if(mysql_num_rows($verif) == 0){
        echo '<div id="erreur">Aucunes données ne correspond à votre demande!</div>';
    }
    //si la paire pseudo/mail existe, on valide l'inscription
    else{
        $result = mysql_query("UPDATE LOGIN SET valide='".mysql_real_escape_string('1')."'
        WHERE pseudo='".mysql_real_escape_string(stripcslashes(utf8_decode($_GET['pseudo'])))."'
        && email='".mysql_real_escape_string($_GET['email'])."'");
        //Si il y a une erreur, on crie ^^
        if (!$result){
            die('Oupss, petit problème : ' . mysql_error());
        }
        else{
            //Si tout est ok,
            echo '<div id="ok">Inscription validé avec succès! Redirection en cours...</div>
            <script type="text/javascript">
                window.setTimeout("location=(\'../index.php?valide=ok\');",30)
            </script>';
        }
    }
    close_bd();
}
?>
</body>
</html>
