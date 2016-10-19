<?php
include("bdd/connexion_bdd.php");
connexion_bd();
//On créer des sessions et pour que ça fonctionne, il faut en déclarer l'ouverture.
session_start();
//destruction de la session
if(isset($_GET['dec']) && $_GET['dec']=="close"){
    unset($_SESSION['pseudo']);
    unset($_SESSION['pass']);
    $modif_co = mysql_query("UPDATE amis SET connect= '0' WHERE IdLog='".mysql_real_escape_string($_SESSION['id'])."'");
    if (!$modif_co) {
        die('Requête invalide : ' . mysql_error());
        }
}
include("function/structure.php");
html();
?>
<head>
  <?php head_style_index(); ?>
  <title>Authentification</title>

</head>

<body>
<!-- affiche le cadre -->
<div class="login">
  <div class="login-apparence">
    <div class="titre">
      <img class="logo-index" src="/photos/icon/logo.png"></img>
      <h1>Authentification</h1>
    </div>

    <div class="login-form">
      <form method="POST" action="index.php">
      <div class="champ">
      <input class="champ_pseudo" type="text" value="<?php if (!empty($_POST["pseudo"]))
          { echo stripcslashes(htmlspecialchars($_POST["pseudo"],ENT_QUOTES)); } ?>" placeholder="Pseudo" name="pseudo">
      <label for="pseudo"></label>
      </div>

      <div class="champ">
      <input class="champ_pass" type="password" value="<?php if (!empty($_POST["motdepass"]))
          { echo stripcslashes(htmlspecialchars($_POST["motdepass"],ENT_QUOTES)); } ?>" placeholder="Mot de passe" name="motdepass">
      <label for="pass"></label>
      </div>
      <a class="pass_perdu button_lien" href="../inscription/identifiant-perdu.php">Identifiant perdu?</a>
      <br>
      <br>
      <input class="button_tel button_envoyer" type="submit" name="Envoyer" value="Connexion" />
      <br>
      <br>
        <a class="button_tel button_effacer button_lien" href="../inscription/creer-compte.php">Créer un compte</a>
    </div>
  </div>
<!-- message si le javascript tourne pas -->
		<?php erreur(); ?>
</div>
<!-- fin -->


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
      //si ok
      else{
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
                  <a href="inscription/valider-inscription.php?id='.$result['id'].'">
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
                $id=$result['id'];
                $modif = mysql_query("UPDATE amis SET connect= '1' WHERE IdLog='".mysql_real_escape_string($id)."'");
                //on redirige avec une url crypther
                $hachage = $id;
                $URL_NEWS = "../user/user.php?id=".$hachage;
                header("location:".$URL_NEWS);
                }
            }
        }
        close_bd();
    }
}
//Formation des URL pour envoyer des paramètres
formation_url()
?>

	</body>
</html>
