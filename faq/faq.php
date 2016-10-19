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

  include("../function/structure.php");
  html();
  head_admin_style();
?>

<body class="body">
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

      <div id="menu_tel">
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
           <?php include('actu.php'); ?>
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
<?php
//fermeture de la BD
close_bd();
//on boucle la session du haut de page
}
?>
