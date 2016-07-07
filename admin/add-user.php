<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Language" content="fr" />
        <link rel="stylesheet" href="../css/style-index.css" type="text/css" media="screen"/>
        <title>Ajouter utilisateur</title>
    </head>
<body>

<div id="centre">

    <h1>Créer un utilisateur</h1>

        <form method="POST" action="#">
            <label for="pseudo">Pseudo : </label>
                <input type="text" name="pseudo" maxlength="20" value="<?php if (!empty($_POST["pseudo"])){ echo stripcslashes(htmlspecialchars($_POST["pseudo"],ENT_QUOTES)); } ?>"/>
                    <br/>
            <label for="pass">Mot de Passe : </label>
                <input type="password" name="motdepass" maxlength="20" value="<?php if (!empty($_POST["motdepass"])){ echo stripcslashes(htmlspecialchars($_POST["motdepass"],ENT_QUOTES)); } ?>"/>
                    <br/>
            <label for="email">Email : </label>
                <input type="text" name="email" maxlength="50" value="<?php if (!empty($_POST["email"])){ echo stripcslashes(htmlspecialchars($_POST["email"],ENT_QUOTES)); } ?>"/>
                    <br/>
            <label for="action">Action : </label><input type="submit" name="Envoyer" value="Envoyer"/>
                <input name="Effacer" value="Effacer" type="reset" />
        </form>
    <br/>

    <p id="lien"><a href="admin.php">Retour</a></p>

</div>

<noscript>
  <div id="erreur">
    <b>Votre navigateur ne prend pas en charge JavaScript!</b>
       Veuillez activer JavaScript afin de profiter pleinement du site.
  </div>
</noscript>

<?php
if(isset($_POST['Envoyer'])){
    //si pseudo vide
    if(empty($_POST['pseudo']))
    {
        echo '<div id="erreur">Veuillez saisir un pseudo!</div>';
    }
    //si mot de passe vide
    else if(empty($_POST['motdepass']))
    {
        echo '<div id="erreur">Veuillez saisir un mot de passe!</div>';
    }
    //si l'email vide
    else if(empty($_POST['email']))
    {
        echo '<div id="erreur">Veuillez saisir un email!</div>';
    }
    //si l'email est invalide
    else if (!preg_match("$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$",
    $_POST['email']))
    {
        echo '<div id="erreur">Veuillez saisir un email valide!</div>';
    }
//c'est ok
    else{
        include("../bdd/connexion_bdd.php");
        connexion_bd();
        //On vérifie si le pseudo existe en bd
        $pseudo = mysql_query("SELECT pseudo FROM LOGIN
          WHERE pseudo='".mysql_real_escape_string(stripcslashes($_POST['pseudo']))."'")
          or die ('Erreur :'.mysql_error());
        if(mysql_num_rows($pseudo) != 0)
        {
            echo '<div id="erreur">Ce pseudo est déjà utilisé!</div>'; return false;
        }
        //on vérifie si le mail existe en bd
        $email = mysql_query("SELECT email FROM LOGIN WHERE email='"
        .mysql_real_escape_string(stripcslashes($_POST['email']))."'")
        or die ('Erreur :'.mysql_error());
        if(mysql_num_rows($email) != 0)
        {
            echo '<div id="erreur">Cet email est déjà utilisé!</div>'; return false;
        }
        //tout est ok
		else{
		//date du jour
		$date=date("Y-m-d");
			// on enregistre les données
			$insert = mysql_query("INSERT INTO LOGIN
        VALUES ( '', '".mysql_real_escape_string(stripcslashes(utf8_decode($_POST['pseudo'])))."',
          '".mysql_real_escape_string(stripcslashes(utf8_decode($_POST['motdepass'])))."',
          '".mysql_real_escape_string(stripcslashes($_POST['email']))."',
          '".mysql_real_escape_string('0')."',
          '".mysql_real_escape_string('0')."',
          '".mysql_real_escape_string($date)."' ) ");
			//Si il y a une erreur
			if (!$insert) {
				die('Requête invalide : ' . mysql_error());
			}
		//pas d'erreur d'enregistrement, on envoie un mail de confirmation
			else {
                echo '<div id="ok">Création réussit.</div>
                <script type="text/javascript">
                    window.setTimeout("location=(\'admin.php\');",30)
                </script>';
            }
        }
        close_bd();
    }
}
?>
</body>
</html>
