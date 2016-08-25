<?php
//ouverture de session
session_start();
$monid_ami=$_GET['idami'];

//on vérifie si les 2 sessions sont présentes
if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])){
    include("../bdd/connexion_bdd.php");
    connexion_bd();
    //on va chercher tout ce qui correspond à l'utilisateur
    $affiche = mysql_query("SELECT * FROM LOGIN WHERE pseudo='"
    .mysql_real_escape_string(stripcslashes($_SESSION['pseudo']))."'
    AND pass='".mysql_real_escape_string($_SESSION['pass'])."'
    AND valide='".mysql_real_escape_string(1)."'");
    $result = mysql_fetch_assoc($affiche);

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
    $id=$_SESSION['id'];
    $idlog=$_SESSION['id'];
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
<!-- affiche le cadre blanc -->
<div id="cadre">
    <!-- affiche la l'image la barre de recherche et le menu dans une div bleu -->
    <div class="rech">

      <!--</div>-->
        <!-- affiche l'image de profil et redirige vers la page privé de la personne
        avec l'id et le pseudo qui se balade dans l'url en crypter -->
        <div id="accueil">
            <a href="<?php
    //        $hachage = $id."&idlog=".$idlog;
    $hachage = $idlog;
    //$hachage2 = $monid_ami."&id=".$id;
                          $URL_NEWS = "page-user.php?id=".$hachage;
                             print $URL_NEWS;
                             ?>">

                             <?php
          //Si le membre possède une image, on l'affiche

          if (file_exists('../auth-photos/'.$id.$image.'images.jpg')){
          echo '<img class="avatar" style="float:left;" alt="avatar" src="../auth-photos/'.$id.$image.'images.jpg"/>';
          }

            ?></a>
<!-- fin -->

        </div>
        <!-- barre de recherche youtube qui va devenir une barre de recherche dans la bdd -->
        <div id="placementrecherche">
          <?php include("search.php"); ?>
        </div>
       <!-- fin -->
       <div id="placementmenu">
          <?php include('menu.php');?>
       </div>
     </div>

     <div id="menu_tel">
       <?php include('menu1.php'); ?>
     </div>
     <!-- messages et commentaires poster sur le site-->
     <div id="actu">
       <div class="button_couleur">
           <div class="button_1">
           </div>
           <div class="button_2">
           </div>
           <div class="button_3">
           </div>
        </div>
           <?php include('../actu/actu.php'); ?>
     </div>
     <!-- fin -->
     <!-- message priver avec la liste de toute les personnes enregistrer dans la bdd qui va part la suite
     devenir la liste des amies -->
     <div id="messagerie">
            <?php include('messagerie.php');?>
     </div>
     <!-- fin -->
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
