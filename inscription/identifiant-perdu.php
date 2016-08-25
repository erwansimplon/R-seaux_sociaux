<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="fr" />
<title>Identifiant perdu</title>
<link rel="stylesheet" href="../css/style-index.css" type="text/css" media="screen" />
<body>
  <div class="login">
    <div class="login-apparence">
      <div class="titre">
        <h1>Identifiant-Perdu</h1>
      </div>
      <div class="login-form">
        <form method="POST" action="#">
          <div class="champ">
            <input class="champ_pass" type="text" value="<?php if (!empty($_POST["email"]))
            { echo stripcslashes(htmlspecialchars($_POST["email"],ENT_QUOTES)); } ?>" placeholder="Email" name="email">
            <label for="email"></label>
          </div>
          <br>
          <br>
          <input class="button_tel button_envoyer" type="submit" name="Envoyer" value="Envoyer" />

          <br>
          <br>
          <a class="pass_perdu button_lien" href="../index.php">Retour</a>
          </div>
        </div>

  <noscript>
    <div id="erreur">
      <b>Votre navigateur ne prend pas en charge JavaScript!</b>
         Veuillez activer JavaScript afin de profiter pleinement du site.
    </div>
  </noscript>
  </div>


  <?php
  //on vérifie le mail saisi par l'utilisateur puis on va chercher en base de données le pseudo et mots de passe correspondant
  //à l'email et on envoie le tout par email.
  if(isset($_POST['Envoyer'])){
      //si l'email vide
      if(empty($_POST['email'])){
          echo '<div id="erreur">Veuillez saisir un email!</div>';
      }
      //si l'email est invalide
      else if (!preg_match("$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$",$_POST['email'])){
          echo '<div id="erreur">Veuillez saisir un email valide!</div>';
      }
      //c'est ok
      else{
          //connexion à la bd
          include("../bdd/connexion_bdd.php");
          connexion_bd();
          //On sélectionne les données
          $index = mysql_query("SELECT pseudo,pass FROM LOGIN WHERE email='"
          .mysql_real_escape_string(stripcslashes($_POST['email']))."'");
          //si pas de résultat
          if(mysql_num_rows($index) == 0)
          {
              echo '<div id="erreur">Aucunes données ne correspond à votre saisie!</div>';
          }
          //si c'est ok
          else{
          //on boucle pour récupérer le pseudo et pass du membre pour lui envoyer
              while($result = mysql_fetch_array($index)){
                  //email de celui qui envoie
                  $webmaster = $email_webmaster;
                  //email de celui qui reçoit
                  $a_qui_j_envoie = $_POST['email'];
                  //sujet
                  $subject = "Vos identifiants";
                  //message
                  $msg  = "Bonjour ".$result['pseudo']."<br/><br/>";
                  $msg .= "Vous avez demandé à recevoir vos identifiants :
                  <br/>Pseudo : ".htmlspecialchars($result['pseudo'])."<br/>
                  Mot de passe : ".$result['pass']."<br/><br/>";
                  $msg .= "Cordialement";
                  //permet de savoir qui envoie le mail et d'y répondre
                  $mailheaders = "From: $webmaster\n";
                  $mailheaders .= "MIME-version: 1.0\n";
                  $mailheaders .= "Content-type: text/html; charset= UTF-8\n";
                  //on envoie l'email
                  mail($a_qui_j_envoie, $subject, $msg, $mailheaders);
                  //on laisse un message de confirmation
                  echo '<div id="ok">Vos identifiants ont été envoyé sur votre boite email.</div>

		<script type="text/javascript">
			window.setTimeout("location=(\'../index.php?recup=ok\');",30)
		</script>';
              }
          }
          close_bd();
      }
  }
  ?>

</body>
</html>
