<?php
  include("../function/structure.php");
  html();
?>

    <head>
        <?php head_style_index(); ?>
        <title>Valider votre inscription</title>
    </head>

<body>

<div id="centre">

    <h1>Valider votre inscription</h1>

<?php
//si la variable $_GET['id'] existe et qu'elle est de type numérique
if(isset($_GET['id']) && is_numeric($_GET['id'])){
    //on se connecte à la base de données
    include("../bdd/connexion_bdd.php");
    connexion_bd();
    //vérification de l'identifiant
    $verif = mysql_query("SELECT id,pseudo,email FROM LOGIN
      WHERE id='".mysql_real_escape_string($_GET['id'])."'");
    //si l'identifiant n'existe pas
    if(mysql_num_rows($verif) == 0){
        echo '<div id="erreur">Aucunes données ne correspond à votre demande!</div>';
    }
    //tout est ok, on extrait les données
    else{
        $result = mysql_fetch_assoc($verif);
    //http://php.net/manual/fr/function.extract.php
    extract($result);
    //on libère le résultat de la mémoire
    mysql_free_result($verif);
    //on envoie un email
                //email de celui qui envoie
                $webmaster = $email_webmaster;
                //email de celui qui reçoit
                $a_qui_j_envoie = $email;
                //sujet
                $subject = "Valider votre inscription";
                //message
                $msg  = "Bonjour ".$pseudo."<br/><br/>";
                $msg .= "Veuillez confirmer votre inscription en cliquant sur le lien ci-joint
                <a href=\"http://".$_SERVER['HTTP_HOST']
                ."../inscription/confirmation-inscription.php?pseudo=".$pseudo."&email="
                .$email."\">Confirmation</a><br/>";
                $msg .= "Cordialement";
                //permet de savoir qui envoie le mail et d'y répondre
                $mailheaders = "From: $webmaster\n";
                $mailheaders .= "MIME-version: 1.0\n";
                $mailheaders .= "Content-type: text/html; charset= UTF-8\n";
                //on envoie l'email
                mail($a_qui_j_envoie, $subject, $msg, $mailheaders);
                //on informe et on redirige
                echo '<div id="ok">Un message vous a été envoyé sur votre boite email.
                Merci de cliquer sur le lien présent dans celui-ci pour valider votre inscription.
                </div>
                <script type="text/javascript">
                    window.setTimeout("location=(\'../index.php?conf=ok\');",30)
                </script>';
    }
    close_bd();
}
?>
<p id="lien"><a href="../index.php">Connexion</a> |
  <a href="creer-compte.php">Créer un compte</a> |
  <a href="identifiant-perdu.php">Identifiant perdu?</a></p>
</div>

<?php erreur(); ?>

</body>
</html>
