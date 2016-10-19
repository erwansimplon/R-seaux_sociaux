<?php

function html() {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
<?php
}

function head_admin_style() {
?>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta http-equiv="Content-Language" content="fr" />
      <link type="text/css" href="../css/admin-style.css" rel="stylesheet"/>
      <link rel="icon" type="image/png" href="../photos/icon/icon.jpg" />
      <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
      <script type="text/javascript" src="../js/scriptcouleur.js" ></script>
      <title>Profil de <?php echo $_SESSION['pseudo'] ?></title>
      <script type="text/javascript">
          $(window).load(function() {
              $(".loader").fadeOut("slow");
          })
      </script>
  </head>
<?php
}

function head_actu_style() {
?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="../css/actu-style.css" type="text/css" media="screen"/>
  <!-- ajax pour les messages et commentaires envoyer par l'utilisateur -->
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<?php
}

function head_style() {
?>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <link href="../css/style.css" rel="stylesheet">
      <script
      			  src="https://code.jquery.com/jquery-3.1.0.js"
      			  integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk="
      			  crossorigin="anonymous"></script>
      <?php include("../js/script.php"); ?>

<?php
}

function head_admin_plus_style() {
?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Language" content="fr" />
  <link type="text/css" href="../css/admin-style.css" rel="stylesheet"/>
  <link type="text/css" href="../css/style-index.css" rel="stylesheet"/>

<?php
}

function head_style_index() {
?>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="fr" />
    <link rel="icon" type="image/png" href="/photos/icon/icon.jpg" />
    <link rel="stylesheet" href="../css/style-index.css" type="text/css" media="screen" />

<?php
}

function erreur() {
?>
<noscript>
  <div id="erreur">
    <b>Votre navigateur ne prend pas en charge JavaScript!</b>
       Veuillez activer JavaScript afin de profiter pleinement du site.
  </div>
</noscript>
<?php
}

function formation_url() {
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
}
?>
