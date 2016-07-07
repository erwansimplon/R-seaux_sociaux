<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="Content-Language" content="fr" />
        <link rel="stylesheet" href="../css/style-index.css" type="text/css" media="screen" />
        <title>Créer un compte</title>
    </head>

<body>

<div id="centre">

<h1>Créer un compte</h1>

    <form method="POST" action="#">
        <label for="pseudo">Pseudo : </label>
            <input type="text" name="pseudo" maxlength="20"
            value="<?php if (!empty($_POST["pseudo"]))
                { echo stripcslashes(htmlspecialchars($_POST["pseudo"],ENT_QUOTES)); } ?>" />
                <br/>
        <label for="pass">Mot de Passe : </label>
            <input type="password" name="motdepass" maxlength="20"
            value="<?php if (!empty($_POST["motdepass"]))
                { echo stripcslashes(htmlspecialchars($_POST["motdepass"],ENT_QUOTES)); } ?>" />
                <br/>
        <label for="email">Email : </label>
            <input type="text" name="email" maxlength="50"
            value="<?php if (!empty($_POST["email"]))
                { echo stripcslashes(htmlspecialchars($_POST["email"],ENT_QUOTES)); } ?>" />
                <br/>
        <label for="action">Action : </label><input type="submit" name="Envoyer" value="Envoyer" />
            <input name="Effacer" value="Effacer" type="reset" />
    </form>
<br/>

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
if(isset($_POST['Envoyer'])){
    //si pseudo vide
    if(empty($_POST['pseudo'])){
        echo '<div id="erreur">Veuillez saisir un pseudo!</div>';
    }
    //si mot de passe vide
    else if(empty($_POST['motdepass'])){
        echo '<div id="erreur">Veuillez saisir un mot de passe!</div>';
    }
    //si l'email vide
    else if(empty($_POST['email'])){
        echo '<div id="erreur">Veuillez saisir un email!</div>';
    }
    //si l'email est invalide
    else if (!preg_match("$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$",
    $_POST['email'])){
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
        $email = mysql_query("SELECT email FROM LOGIN
          WHERE email='".mysql_real_escape_string(stripcslashes($_POST['email']))."'")
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
		//email de celui qui envoie
		$webmaster = $email_webmaster;
		//email de celui qui reçoit
		$a_qui_j_envoie = $_POST['email'];
		//sujet
		$subject = "Valider votre inscription";
		//message
		$msg  = "Bonjour ".stripcslashes($_POST['pseudo'])."<br/><br/>";
		$msg .= "Veuillez confirmer votre inscription en cliquant sur le lien ci-joint 
		<a href=\"http://".$_SERVER['HTTP_HOST']."/inscription/confirmation-inscription.php?pseudo="
		.stripcslashes($_POST['pseudo'])."&email=".$_POST['email']."\">Confirmation</a><br/>";
		$msg .= "Cordialement";
		//permet de savoir qui envoie le mail et d'y répondre
		$mailheaders = "From: $webmaster\n";
		$mailheaders .= "MIME-version: 1.0\n";
		$mailheaders .= "Content-type: text/html; charset= UTF-8\n";
		//on envoie l'email
		mail($a_qui_j_envoie, $subject, $msg, $mailheaders);

       	echo '<div id="ok">Inscription réussit.</div>
                 <script type="text/javascript">
                     window.setTimeout("location=(\'../index.php?conf=ok\');",30)
                 </script>';
            }
        }
        close_bd();
    }
}
?>
</body>
</html>
