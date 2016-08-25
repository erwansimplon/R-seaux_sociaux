<?php
//ouverture de session
session_start();
//on vérifie si les 2 sessions sont présentes
if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])){
    include("../bdd/connexion_bdd.php");
    connexion_bd();
    $idlog=$_SESSION['id'];
        //on va chercher tout ce qui correspond à l'utilisateur
    $affiche = mysql_query("SELECT * FROM LOGIN WHERE id=$idlog");
    $result = mysql_fetch_assoc($affiche);
    //http://php.net/manual/fr/function.extract.php
    extract($result);
    //si le membre est banni en cours de session
    if($valide==2){
    echo '<div class="erreur">Votre compte a été black-listé!</div>
    <script type="text/javascript">
        window.setTimeout("location=(\'../index.php?dec=close&ban=ok\');",30)
    </script>';
    }
    //on libère le résultat de la mémoire
    mysql_free_result($affiche);
    $id=$_GET['id'];
    ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="Content-Language" content="fr" />
        <link type="text/css" href="../css/admin-style.css" rel="stylesheet"/>
        <link rel="icon" type="image/png" href="../auth-photos/icon.jpg" />
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <script type="text/javascript" src="scriptcouleur.js" ></script>
        <title>Profil de <?php echo $_SESSION['pseudo'] ?></title>
    </head>

<body class="body">

<div id="cadre">
  <div id="photo-profil">
    <a href="<?php $hachage = $id;
        $URL_NEWS = "image-profil.php?id=".$hachage;
        print $URL_NEWS;?>"><?php
  //Si le membre possède une image, on l'affiche

  if (file_exists('../auth-photos/profil/'.$id.$image.'images.jpg')){
  echo '<img class="avatar img_profil" style="float:left;" alt="avatar" src="../auth-photos/profil/'.$id.$image.'images.jpg'.'"/>';
  }

    ?></a>
  </div>
  <div id="couverture-profil">
    <a href="<?php $hachage = $id;
        $URL_NEWS = "couverture-profil.php?id=".$hachage;
        print $URL_NEWS;?>"><?php
  //Si le membre possède une image, on l'affiche

  if (file_exists('../auth-photos/couverture/'.$id.$image.'images.jpg')){
  echo '<img class="avatar img_couverture" style="float:left;" alt="avatar" src="../auth-photos/couverture/'.$id.$image.'images.jpg'.'"/>';
  }

    ?></a>
  </div>
    <div class="rech">
        <div id="accueil">
            <a href="<?php $hachage = $id;
                $URL_NEWS = "user.php?id=".$hachage;
                print $URL_NEWS;?>"><?php
          //Si le membre possède une image, on l'affiche

		if (file_exists('../auth-photos/'.$id.$image.'images.jpg')){
		echo '<img class="avatar" style="float:left;" alt="avatar"
		src="../auth-photos/'.$id.$image.'images.jpg'.'"/>';
		}

            ?></a>


        </div>
        <div id="placementrecherche">
          <?php include("search.php"); ?>
          <a href="<?php $hachage = $id;
              $URL_NEWS = "add_amis.php?id=".$hachage;
              print $URL_NEWS;?>">ajouter</a>
        </div>
       <div id="placementmenu">
          <?php include('menu.php');?>
       </div>
       </div>
     <div id="menu_tel">
       <?php include('menu1.php'); ?>
     </div>
     <div id="actu">
       <div class="button_couleur">
           <div class="button_1">
           </div>
           <div class="button_2">
           </div>
           <div class="button_3">
           </div>
        </div>
     <div id="actu">
           <?php include('../user/actu.php'); ?>
     </div>
     <div>
            <?php include('messagerie.php');?>
     </div>
  </div>
</div>
</body>
</html>
<?php
//fermeture de la BD
close_bd();
//on boucle la session du haut de page
}
?>
