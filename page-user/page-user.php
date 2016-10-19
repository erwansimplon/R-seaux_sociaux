<?php
//ouverture de session
session_start();
//on vérifie si les 2 sessions sont présentes
if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])){
    include("../bdd/connexion_bdd.php");
    connexion_bd();
    $idlog=$_SESSION['id'];
    $pseudo_page_perso=$_SESSION['pseudo'];
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
    $pseudo=$_GET['pseudo'];

  include("../function/structure.php");
  html();
  head_admin_style();
?>

<body class="body">

<div id="cadre">
  <div class="header_fixed">
    <div class="rech">
      <div id="accueil">
        <?php if ( $id == $idlog){ ?>
          <a href="<?php $hachage = $id;
          $URL_NEWS = "../user/user.php?id=".$hachage;
          print $URL_NEWS;?>"><?php } else { ?> <a href="#"><?php }
          //Si le membre possède une image, on l'affiche

          if (file_exists('../photos/miniature/'.$id.$image.'images.jpg')){
            echo '<img class="avatar" style="float:left;" alt="avatar"
            src="../photos/miniature/'.$id.$image.'images.jpg'.'"/>';
          }
          else {
            echo '<img class="avatar" style="float:left;" alt="avatar" src="../photos/miniature/'.$image.'images.jpg"/>';
          }
          ?></a></a>


        </div>
        <div id="placementrecherche">
          <?php include("../recherche/search.php"); ?>
        </div>
        <div class="ajout_amis_tablette">
          <?php
          $idami = $_SESSION['id'];
          $user = mysql_query("SELECT * FROM amis WHERE idami=$idlog and IdLog=$id")
          or die ('Erreur :'.mysql_error());
          if(mysql_num_rows($user) != 0)
          {
            if ( $id != $idlog){ ?>
              <a class="lien_ajout_amis" href="<?php $hachage = $id;
              $URL_NEWS = "../ajout-amis/supr-amis.php?id=".$hachage."&pseudo=".$pseudo;
              print $URL_NEWS;?>"><img class="img_remove_amis" src="../photos/icon/remove_user.png" /></a>
              <?php } else { ?> <a href="#"></a><?php }
            }
            else{
              if ( $id != $idlog){ ?>
                <a class="lien_ajout_amis" href="<?php $hachage = $id;
                $URL_NEWS = "../ajout-amis/add_amis.php?id=".$hachage."&pseudo=".$pseudo;
                print $URL_NEWS;?>"><img class="img_ajout_amis" src="../photos/icon/add_user.png" /></a>
                <?php } else { ?> <a href="#"></a><?php }
              }
              ?>
            </div>
            <div id="placementmenu">
              <?php include('../menu/menu.php');?>
            </div>
          </div>
    <div id="couverture-profil">
      <?php if ( $id == $idlog){ ?>
      <a href="<?php $hachage = $id;
          $URL_NEWS = "couverture-profil.php?id=".$hachage;
          print $URL_NEWS;?>"><?php } else { ?> <a href="#"><?php }
    //Si le membre possède une image, on l'affiche

    if (file_exists('../photos/couverture/'.$id.$image.'images.jpg')){
    echo '<img class="avatar img_couverture" alt="avatar" src="../photos/couverture/'.$id.$image.'images.jpg'.'"/>';
    }
    else {
        echo '<img class="avatar img_couverture" alt="avatar" src="../photos/couverture/'.$image.'images.jpg"/>';
    }
      ?></a></a>
    <div id="photo-profil">
      <?php if ( $id == $idlog){ ?>
        <a href="<?php $hachage = $id;
        $URL_NEWS = "image-profil.php?id=".$hachage;
        print $URL_NEWS;?>"><?php } else { ?> <a href="#"><?php }
        //Si le membre possède une image, on l'affiche

        if (file_exists('../photos/profil/'.$id.$image.'images.jpg')){
          echo '<img class="avatar img_profil" alt="avatar" src="../photos/profil/'.$id.$image.'images.jpg'.'"/>';
        }
        else {
          echo '<img class="avatar img_profil" alt="avatar" src="../photos/profil/'.$image.'images.jpg"/>';
        }
        ?></a></a>
      </div>
      <div class="menu_perso">
        <h3 class="nom_size"><?php if ( $id != $idlog){echo $pseudo;} else{ echo $pseudo_page_perso; } ?></h3>
        <div class="ajout_amis">
          <?php
          $user = mysql_query("SELECT * FROM amis WHERE idami=$idlog and IdLog=$id")
          or die ('Erreur :'.mysql_error());
          if(mysql_num_rows($user) != 0)
          {
            if ( $id != $idlog){ ?>
              <a class="lien_ajout_amis" href="<?php $hachage = $id;
              $URL_NEWS = "../ajout-amis/supr-amis.php?id=".$hachage."&pseudo=".$pseudo;
              print $URL_NEWS;?>"><img class="img_remove_amis" src="../photos/icon/remove_user.png" /></a>
              <?php } else { ?> <a href="#"></a><?php }
            }
            else{
              if ( $id != $idlog){ ?>
                <a class="lien_ajout_amis" href="<?php $hachage = $id;
                $URL_NEWS = "../ajout-amis/add_amis.php?id=".$hachage."&pseudo=".$pseudo;
                print $URL_NEWS;?>"><img class="img_ajout_amis" src="../photos/icon/add_user.png" /></a>
                <?php } else { ?> <a href="#"></a><?php }
              }
              ?>
            </div>
          <div class="button_couleur">
            <div class="button_1">
            </div>
            <div class="button_2">
            </div>
            <div class="button_3">
            </div>
          </div>
          </div>
       <div id="menu_tel">
         <?php include('../menu/menu1.php'); ?>
       </div>
       <div class="ajout_amis_portable">
         <?php
         $user = mysql_query("SELECT * FROM amis WHERE idami=$idlog and IdLog=$id")
            or die ('Erreur :'.mysql_error());
         if(mysql_num_rows($user) != 0)
         {
            if ( $id != $idlog){ ?>
             <a class="lien_ajout_amis" href="<?php $hachage = $id;
                 $URL_NEWS = "../ajout-amis/supr-amis.php?id=".$hachage."&pseudo=".$pseudo;
                 print $URL_NEWS;?>"><img class="img_remove_amis" src="../photos/icon/remove_user.png" /></a>
           <?php } else { ?> <a href="#"></a><?php }
         }
         else{
           if ( $id != $idlog){ ?>
            <a class="lien_ajout_amis" href="<?php $hachage = $id;
                $URL_NEWS = "../ajout-amis/add_amis.php?id=".$hachage."&pseudo=".$pseudo;
                print $URL_NEWS;?>"><img class="img_ajout_amis" src="../photos/icon/add_user.png" /></a>
          <?php } else { ?> <a href="#"></a><?php }
         }
         ?>
       </div>
    </div>
  </div>
       <div id="actu_page_user">
         <?php
         $nb_user = mysql_query("SELECT * FROM amis WHERE idami=$id");
         $user = mysql_query("SELECT * FROM amis WHERE idami=$id limit 9");
         $count_user = mysql_num_rows($nb_user);
         ?>
         <a href="<?php $hachage = $id;
             $URL_NEWS = "../ajout-amis/liste-amis.php?id=".$hachage;
             print $URL_NEWS;?>">
           <div class="titre_amis">
             <h1>Amis(<?php echo $count_user; ?>)</h1>
           </div>
         </a>
         <div class="liste-amis liste-amis_page_user">
           <div>
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
                      if (file_exists('../photos/miniature/'.$idlog_ami.$image.'images.jpg')){
                        echo '<img class="avatar" alt="avatar" src="../photos/miniature/'.$idlog_ami.$image.'images.jpg"/>';
                      }
                      else {
                        echo '<img class="avatar" alt="avatar" src="../photos/miniature/'.$image.'images.jpg"/>';
                      }
                      echo '<p>'.$user_affiche['pseudo'].'</p>';?>
           </div></a> <?php
                }
                ?>
              </div>
          </div>
           <?php include('../actu-page-user/actu.php'); ?>
       </div>
  </div>
     <div>
            <?php include('../user/messagerie.php');?>
     </div>
</body>
</html>
<?php
//fermeture de la BD
close_bd();
//on boucle la session du haut de page
}
?>
