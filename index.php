<?php
//On créer des sessions et pour que ça fonctionne, il faut en déclarer l'ouverture.
session_start();
//destruction de la session
if(isset($_GET['dec']) && $_GET['dec']=="close"){
    unset($_SESSION['pseudo']);
    unset($_SESSION['pass']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    		<meta http-equiv="Content-Language" content="fr" />
        <link rel="stylesheet" href="../css/style-index.css" type="text/css" media="screen" />
    		<title>Authentification</title>
    </head>

<body>

		<div id="centre">

			<h1>Authentification</h1>
          <form method="POST" action="index.php">
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
              <label for="action">Action : </label>
                  <input type="submit" name="Envoyer" value="Envoyer" />
                  <input name="Effacer" value="Effacer" type="reset" />
          </form>

<br/>

      <p id="lien"><a href="index.php">Connexion</a> |
        <a href="../inscription/creer-compte.php">Créer un compte</a> |
        <a href="../inscription/identifiant-perdu.php">Identifiant perdu?</a></p>


		<noscript>
      <div id="erreur">
        <b>Votre navigateur ne prend pas en charge JavaScript!</b>
           Veuillez activer JavaScript afin de profiter pleinement du site.
      </div>
    </noscript>

    </div>

      <?php
      // vérification des données saisies par l'utilisateur
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
      //Si tout est bon, on se connecte à la base de données et on vérifie que
      //l'utilisateur existe
      //c'est ok
      else{
          include("bdd/connexion_bdd.php");
          connexion_bd();
          //On selectionne les données
          $index = mysql_query("SELECT id,pseudo,pass,valide FROM LOGIN WHERE
            pseudo='".mysql_real_escape_string(stripcslashes(utf8_decode($_POST['pseudo'])))."'
            AND pass='".mysql_real_escape_string(utf8_decode($_POST['motdepass']))."'");
          //si pas de résultat
          if(mysql_num_rows($index) == 0)
          {
              echo '<div id="erreur">Aucunes données ne correspond à votre saisie!</div>';
          }
          //Si l'utilisateur existe, on vérifie si celui-ci à bien validé son inscription et
          //si ce n'est pas le cas, on le redirige vers une page qui lui permettra de le
          //faire
          else{
            	while($result = mysql_fetch_array($index)){
            		//si le compte na pas été validé
            		if($result['valide']==0){
            			echo '<div id="erreur">Vous n\'avez pas validé votre inscription!<br/>»
                  <a href="valider-inscription.php?id='.$result['id'].'">
                  Valider votre inscription</a></div>';
            		}
          //utilisateur à bien validé son inscription,
          //on vérifie à présent si celui-ci n'est pas banni
          //si le compte a été black-listé
          elseif($result['valide']==2){
              echo '<div id="erreur">Votre compte a été black listé!</div>';
          }
          //on créer une session et on le redirige vers sa partie privée puis on clôture le tout :
          //si résultat
          else{
                //on créer la session
                $_SESSION['pseudo'] = utf8_decode($_POST['pseudo']);
                $_SESSION['pass'] = utf8_decode($_POST['motdepass']);
                //on redirige
                $hachage = sha1("id=".$rows['id']."&pseudo=".$rows['pseudo']);
                $URL_NEWS = "../general/user.php?id=".$hachage;
                header("location:".$URL_NEWS);
                }
            }
        }
        close_bd();
    }
}
//nous n'avons pas fermé le code PHP et ceci pour une bonne raison
if(isset($_GET['conf']) && $_GET['conf']=="ok"){
echo '<div id="ok">Inscription réussit. Un message vous a été envoyé sur votre boîte email.
Merci de cliquer sur le lien présent dans celui-ci pour valider votre inscription.</div>';
}
if(isset($_GET['valide']) && $_GET['valide']=="ok"){
echo '<div id="ok">Inscription validé avec succès! Vous pouvez vous identifier.</div>';
}
if(isset($_GET['recup']) && $_GET['recup']=="ok"){
echo '<div id="ok">Vos identifiants ont été envoyé sur votre boite email.</div>';
}
if(isset($_GET['session']) && $_GET['session']=="new"){
echo '<div id="ok">Suite à la modification de votre profil,
vous devez saisir vos nouvelles données.</div>';
}
if(isset($_GET['ban']) && $_GET['ban']=="ok"){
echo '<div id="erreur">Votre compte a été black-listé!</div>';
}
?>

	</body>
</html>