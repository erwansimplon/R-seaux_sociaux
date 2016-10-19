<?php
    session_start();
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
    $id_affiche_amis=$_GET['id'];

  include("../function/structure.php");
  include("../function/select.php");
  include("../function/script-js.php");
  html();
  head_admin_style();
?>

<body class="body">
<div class="loader"></div>
<!-- affiche le cadre blanc -->
  <div id="cadre">
    <!-- affiche la l'image la barre de recherche et le menu dans une div bleu -->
    <div class="rech rech_fixed">

      <!--</div>-->
        <!-- affiche l'image de profil et redirige vers la page privé de la personne
        avec l'id et le pseudo qui se balade dans l'url en crypter -->
      <div id="accueil">
        <a href="<?php
          $hachage = $idlog;
          $URL_NEWS = "../page-user/page-user.php?id=".$hachage;
          print $URL_NEWS;
         ?>">

          <?php
          //Si le membre possède une image, on l'affiche

            if (file_exists('../photos/miniature/'.$id.$image.'images.jpg')){
              echo '<img class="avatar" style="float:left;" alt="avatar" src="../photos/miniature/'.$id.$image.'images.jpg"/>';
            }
            else {
                echo '<img class="avatar" style="float:left;" alt="avatar" src="../photos/miniature/'.$image.'images.jpg"/>';
            }

          ?></a>
<!-- fin -->
      </div>
        <!-- barre de recherche youtube qui va devenir une barre de recherche dans la bdd -->
      <div id="placementrecherche">
        <?php include("../recherche/search.php"); ?>
      </div>
       <!-- fin -->
      <div id="placementmenu">
        <?php include('../menu/menu.php');?>
      </div>
    </div>

      <div id="menu_tel_user">
        <?php include('../menu/menu1.php'); ?>
      </div>
     <!-- messages et commentaires poster sur le site-->
      <div id="actu">
        <div class="button_couleur button_couleur_fixed">
            <div class="button_1">
            </div>
            <div class="button_2">
            </div>
            <div class="button_3">
            </div>
        </div>
        <?php
        $user = mysql_query("SELECT * FROM amis WHERE idami=$id_affiche_amis");
        $count_user = mysql_num_rows($user);
        ?>
          <div class="titre_amis titre_amis_amis">
            <h1>Amis(<?php echo $count_user; ?>)</h1>
          </div>
        <div class="liste-amis liste-amis_amis">
          <div class="placement_liste_amis">
         <?php
          while($user_affiche=mysql_fetch_array($user))
           {
             $idlog_ami=$user_affiche['IdLog'];
             $pseudo_ami=$user_affiche['pseudo'];
           ?>
           <a href="<?php $hachage = $idlog_ami;
               $URL_NEWS = "../page-user/page-user.php?id=".$hachage."&pseudo=".$pseudo_ami;
               print $URL_NEWS;?>">
           <div>
                     <?php
                     if (file_exists('../photos/profil/'.$idlog_ami.$image.'images.jpg')){
                       echo '<img class="avatar" alt="avatar" src="../photos/profil/'.$idlog_ami.$image.'images.jpg"/>';
                     }
                     else {
                       echo '<img class="avatar" alt="avatar" src="../photos/profil/'.$image.'images.jpg"/>';
                     }
                     echo '<p>'.$user_affiche['pseudo'].'</p>';?>
          </div></a> <?php
               }
               ?>
             </div>
          </div>
     </div>
     <!-- fin -->
     <!-- message priver avec la liste de toute les personnes enregistrer dans la bdd qui va part la suite
     devenir la liste des amies -->
     <div id="messagerie">
        <?php include('../user/messagerie.php');?>
     </div>
     <!-- fin -->
   </div>
  </body>
</html>
