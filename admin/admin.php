<?php
//ouverture de session
session_start();
//on vérifie si les 2 sessions sont présentes
if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])){
    include("../bdd/connexion_bdd.php");
    connexion_bd();
    //on va chercher tout ce qui correspond à l'utilisateur
    $affiche = mysql_query("SELECT * FROM LOGIN
      WHERE pseudo='".mysql_real_escape_string(stripcslashes($_SESSION['pseudo']))."'
      AND pass='".mysql_real_escape_string($_SESSION['pass'])."'
      AND valide='".mysql_real_escape_string(1)."'
      AND statut='".mysql_real_escape_string(1)."'");
    $result = mysql_fetch_assoc($affiche);
    //si le statut ne retourne pas 1, ce n'est pas un admin.On éjecte l'utilisateur
    if(mysql_num_rows($affiche) == 0)
    {
      echo 'Il n\'y a rien à voir ici!';
      $ids=$_SESSION['id'];
      $hachage = $ids;
      $URL_NEWS = "../user/user.php?id=".$hachage;
      header("location:".$URL_NEWS);
    }

      extract($result);
      //on libère le résultat de la mémoire
   mysql_free_result($affiche);
   $idlog=$_SESSION['id'];
include("../function/structure.php");
html();
head_admin_style();
?>

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
    <div>
      <h1 class="titre_admin_page">Administration</h1>
      <div class="button_couleur button_couleur_fixed">
        <div class="button_1">
        </div>
        <div class="button_2">
        </div>
        <div class="button_3">
        </div>
      </div>
    </div>

  <p id="admin_menu2"><a class="titre_admin_menu1" href="add-user.php">
    Ajouter un utilisateur</a></p>

<form name="form" method="POST">
  <?php
    //on sélectionne tout les membres
    $membre = mysql_query("SELECT id, pseudo FROM LOGIN WHERE id ORDER BY pseudo ASC");
    if(mysql_num_rows($membre)<=1){
      echo '<label id="admin_menu1"><p class="titre_admin_menu1"></label>'
      .mysql_num_rows($membre).' membres</p><br/>';
    }
    if(mysql_num_rows($membre)>1){
    echo '<label id="admin_menu1"><p class="titre_admin_menu1"></label>'
    .mysql_num_rows($membre).' membres</p><br/>';
    }
    //si pas de résultat
    if(mysql_num_rows($membre) == 0)
    {
        echo '<div class="erreur">Aucunes données!</div>';
    }
    //si résultat, on case les membres dans une liste
    else{
    echo '<div class="test_form"><select class="select_user" name="membre" onchange="javascript:submit(this)">
            <option value="Sélectionner un membre">Sélectionner un membre</option>';
        while($liste = mysql_fetch_array($membre)){
            echo '<option value="'.$liste['id'].'" ';
            if(isset($_POST["membre"]) && $_POST["membre"]==$liste['id'])
            {echo "selected='selected'";}
            echo '>'.$liste['pseudo'].'</option>';
        }
    echo '</select><br/>';
    }
 //si il y a eu sélection dans la liste
    if(isset($_POST["membre"]) && $_POST["membre"]!='Sélectionner un membre'){
        //on sélectionne tout les membres
        $selection = mysql_query("SELECT * FROM LOGIN
          WHERE id='".mysql_real_escape_string($_POST["membre"])."'");
        while($resultat = mysql_fetch_array($selection)){
            //on stock tout dans des variables
            $id_membre = $resultat['id'];
            $pseudo_membre = $resultat['pseudo'];
            $pass_membre = $resultat['pass'];
            $email_membre = $resultat['email'];
            $valide_membre = $resultat['valide'];
            $statut_membre = $resultat['statut'];
            $date_membre = date("d/m/Y",strtotime($resultat['date']));
        }
        //on affiche le reste du formulaire avec les infos du membre sélectionné
        ?>
        <label for="pseudo">Pseudo : </label>
        <input type="text" name="pseudo" maxlength="20"
		value="<?php echo htmlspecialchars($pseudo_membre);?>" /><br/>

        <label for="pass">Mot de Passe : </label>
        <input type="password" name="motdepass" maxlength="20"
		value="<?php echo htmlspecialchars($pass_membre);?>" /><br/>

        <label for="email">Email : </label>
        <input class="input_mail" type="text" name="email" maxlength="50"
		value="<?php echo htmlspecialchars($email_membre);?>" /><br/>

        <label class="label_validation" for="validation">Validation : </label>
        <select name="validation">
        <option value="0" <?php if($valide_membre==0)
        { echo "selected='selected'"; }?>>Non validé</option>
        <option value="1" <?php if($valide_membre==1)
        { echo "selected='selected'"; }?>>Validé</option>
        <option value="2" <?php if($valide_membre==2)
        { echo "selected='selected'"; }?>>Banni</option>
        </select>

        <label class="label_statut" for="statut">Statut : </label>
        <select name="statut">
        <option value="0" <?php if($statut_membre==0)
        echo "selected='selected'";?>>Membre</option>
        <option value="1" <?php if($statut_membre==1)
        echo "selected='selected'";?>>Admin</option>
        </select>

        <?php
        //si le membre a une image, on affiche un formulaire permettant de garder ou
        //supprimer celle-ci
        if (file_exists('../photos/miniature/'.$id.$image.'images.jpg')){
            echo '<label class="label_statut">Supprimer l\'image :</label>
            <select name="image" />
                 <option value="non">Non</option>
                 <option value="oui">Oui</option>
            </select><br/>';
        }
        ?>

        <label for="pseudo">Inscrit le :</label>
        <?php echo '<p class="date_form_admin">'.$date_membre.'</p>';?><br/>

        <input class="env_admin" type="submit" name="Envoyer" value="Envoyer" />
        <input class="effa_admin" name="Effacer" value="Effacer" type="reset" />
        </form>
        <br/>
        <?php
        //on affiche l'image du membre si il en possède une

        if (file_exists('../photos/miniature/'.$id.$image.'images.jpg')){
        echo '<img class="avatar" style="float:left;" alt="avatar" src="../photos/miniature/'.$id.$image.'images.jpg"/>';
        }

        ?>

         <h2>Supprimer le membre <?php echo $pseudo_membre;?></h2>
                 <li><a href="admin.php?supmembre=<?php echo $id_membre;?>"
                   >Supprimer le membre <?php echo $pseudo_membre;?></a></li>
          </div>
       <?php
        //on ferme if(isset($_POST["membre"]) && $_POST["membre"]!='Sélectionner un membre')
    }
   //suppression du membre
    if(isset($_GET['supmembre'])){
    //on supprime le membre
    $supprime_membre = mysql_query("DELETE FROM LOGIN WHERE id = ".$_GET['supmembre']."");
    //si erreur
    if (!$supprime_membre) {
                die('Requête invalide : ' . mysql_error());
            }
            //si ok
            else{
            //si le membre a une image, on la supprime
        if (file_exists('../photos/miniature/'.$id.$image.'images.jpg')){
            unlink('../photos/miniature/'.$id.$image.'images.jpg');
        }
        //on informe et on redirige
        echo '<div class="ok">Membre supprimé avec succès. Redirection en cours...</div>
        <script type="text/javascript">
            window.setTimeout("location=(\'admin.php\');",30)
        </script>';
    }
}
   //modification du membre
    if(isset($_POST['Envoyer'])){
//on sélectionne tout les pseudo et email
            $donnees = mysql_query("SELECT pseudo, email FROM LOGIN")
            or die ('Erreur :'.mysql_error());
            while($result1 = mysql_fetch_array($donnees)){
                //si le pseudo posté est différent du pseudo actuel du membre,
                //le pseudo a alors été modifié
                //et si le pseudo posté correspond à un pseudo déjà présent en bd,
                //on informe
                if($_POST['pseudo']!=$pseudo_membre && $_POST['pseudo']==$result1['pseudo']){
                    echo '<div class="erreur">Ce pseudo « '.$_POST['pseudo'].' »
                     est utilisé!</div>'; return false;
                }
                //idem pour l'email
                if($_POST['email']!=$email_membre && $_POST['email']==$result1['email']){
                    echo '<div class="erreur">Cet email « '.$_POST['email'].' »
                     est utilisé!</div>'; return false;
                }
}
            //si pseudo vide
        if(empty($_POST['pseudo']))
        {
            echo '<div class="erreur">Veuillez saisir un pseudo!</div>';
        }
        //si mot de passe vide
        else if(empty($_POST['motdepass']))
        {
            echo '<div class="erreur">Veuillez saisir un mot de passe!</div>';
        }
        //si l'email vide
        else if(empty($_POST['email']))
        {
            echo '<div class="erreur">Veuillez saisir un email!</div>';
        }
        //si l'email est invalide
        else if (!preg_match("$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$",
        $_POST['email']))
        {
            echo '<div class="erreur">Veuillez saisir un email valide!</div>';
        }
        //si la validité du compte est vide
        else if($_POST['validation']=='')
        {
            echo '<div class="erreur">Veuillez saisir la validité du compte du membre!</div>';
        }
        //si le statut du membre est vide
        else if($_POST['statut']=='')
        {
            echo '<div class="erreur">Veuillez saisir le statut du membre!</div>';
        }
        //tout est ok, on modifie les données
        else{
            $modif = mysql_query("UPDATE LOGIN
              SET pseudo='".mysql_real_escape_string(stripcslashes($_POST['pseudo']))."',
              pass='".mysql_real_escape_string(stripcslashes($_POST['motdepass']))."',
              email='".mysql_real_escape_string(stripcslashes($_POST['email']))."',
              valide='".mysql_real_escape_string(stripcslashes($_POST['validation']))."',
              statut='".mysql_real_escape_string(stripcslashes($_POST['statut']))."'
              WHERE id='".mysql_real_escape_string($id_membre)."'");
            //Si il y a une erreur
            if (!$modif) {
                die('Requête invalide : ' . mysql_error());
            }
           else{
                //on supprime l'image si besoin
                if (file_exists('../photos/miniature/'.$id.$image.'images.jpg') && $_POST['image']=="oui")
                {
                    unlink('../photos/miniature/'.$id.$image.'images.jpg');
                }
                //message de confirmation
                echo '<div class="ok">
                    Profil du membre modifié avec succès. Redirection en cours...
                </div>
                <script type="text/javascript">
                    window.setTimeout("location=(\'admin.php\');",30)
                </script>';
            }
        }
    }

    erreur();
    ?>

      </div>
    </body>
</html>
<?php
    //fermeture de la BD
    close_bd();
    //on boucle la session du haut de page
  }
?>
