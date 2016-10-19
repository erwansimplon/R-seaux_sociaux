<?php
include("../function/structure.php");
html();
?>
    <head>
        <?php head_style_index(); ?>
        <title>Créer un compte</title>
    </head>

<body>
<div class="login">
  <div class="login-apparence">
    <div class="titre">
      <img class="logo-index" src="/photos/icon/logo.png"></img>
      <h1>Créer un compte</h1>
    </div>
    <div class="login-form">
      <form method="POST" action="#">
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

        <div class="champ">
          <input class="champ_pass" type="text" value="<?php if (!empty($_POST["email"]))
          { echo stripcslashes(htmlspecialchars($_POST["email"],ENT_QUOTES)); } ?>" placeholder="Email" name="email">
          <label for="email"></label>
        </div>

        <input class="button_tel button_envoyer" type="submit" name="Envoyer" value="Envoyer" />
        <br>
        <br>
        <input class="button_tel button_effacer" name="Effacer" value="Effacer" type="reset" />
        <br>
        <br>
        <a class="pass_perdu button_lien" href="admin.php">Retour</a>
        </div>
      </div>

	<?php erreur(); ?>
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
      $insert = mysql_query("INSERT INTO LOGIN (id, pseudo, pass, email, valide, statut, date)
            VALUES ( '', '".mysql_real_escape_string(utf8_decode($_POST['pseudo']))."',
             '".mysql_real_escape_string(utf8_decode($_POST['motdepass']))."',
             '".mysql_real_escape_string($_POST['email'])."',
             '".mysql_real_escape_string('0')."',
             '".mysql_real_escape_string('0')."',
             '".mysql_real_escape_string($date)."' ) ");
			//Si il y a une erreur
			if (!$insert) {
				die('Requête invalide : ' . mysql_error());
			}

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
