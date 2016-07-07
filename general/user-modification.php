<?php
//ouverture de session
session_start();
//on vérifie si les 2 sessions sont présentes
if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])){
    //on se connecte à la BD
    include("../bdd/connexion_bdd.php");
    connexion_bd();
    //on va chercher tout ce qui correspond à l'utilisateur
    $affiche = mysql_query("SELECT * FROM LOGIN WHERE pseudo='"
    .mysql_real_escape_string(stripcslashes($_SESSION['pseudo']))."'
    AND pass='".mysql_real_escape_string($_SESSION['pass'])."'
    AND valide='".mysql_real_escape_string(1)."'");
    $result = mysql_fetch_assoc($affiche);
    //http://php.net/manual/fr/function.extract.php
    extract($result);
    //si le membre est banni en cours de session, on l’éjecte
    if($valide==2){
        echo '<div class="erreur">Votre compte a été black listé!</div>
        <script type="text/javascript">
            window.setTimeout("location=(\'../index.php?dec=close&ban=ok\');",30)
        </script>';
    }
    //on libère le résultat de la mémoire
    mysql_free_result($affiche);
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta http-equiv="Content-Language" content="fr" />
            <link type="text/css" href="../css/admin-style.css" rel="stylesheet"/>
            <title>Modification de votre profil</title>
            <script type="text/javascript">
                <!--
                /*     Fonction permettant d'afficher le message de chargement lors de l'upload de l'image.     Cette fonction permet également de cacher certains éléments pendant le temps de chargement.     */
                function Verif_attente(id_attente)
                {
                    var id_attente = document.getElementById(id_attente);

                    if (typeof id_attente != 'undefined')
                    {
                        // Nettoyage de l'élément cible
                        var nb_noeuds = id_attente.childNodes.length;

                        for (var i = 0; i < nb_noeuds; i++)
                        {
                            id_attente.removeChild(id_attente.firstChild);
                        }
                        //on affiche un message d'attente
                        document.getElementById("message_attente")
                        .innerHTML = 'Chargement en cours, veuillez patienter...';
                        //on cache le formulaire d'upload
                        document.getElementById("upload").style.visibility = 'hidden';
                        //on cache le bouton permettant l'actualisation de la page
                        document.getElementById("cache").style.visibility = 'hidden';
                    }
                }
                -->
          </script>
    </head>

    <body>

    <div id="cadre">
      <div id="recherche">
          <div id="accueil">
            <a href="page-user.php"><?php
            //Si le membre possède une image, on l'affiche

            if (file_exists('../auth-photos/'.$id.$image.'images.jpg')){
            echo '<img class="avatar" style="float:left;" alt="avatar" src="../auth-photos/'.$id.$image.'images.jpg"/>';
            }

            ?></a>

          </div>
        <div id="placementrecherche">
      <form action="http://www.youtube.com/results" method="get" target="_blank" >
        <input name="search_query" type="text" />
        <input type="submit" value="OK" />
      </form>
    </div>
        <div id="placementmenu">
            <?php include('menu.php');?>
        </div>
      </div>
<br />
<br />
<br />
<br />

    <h1>Modification de votre profil</h1>
<br />
<br />
<br />

    <form method="POST" action="#">
        <label for="pseudo">Pseudo : </label>
            <input type="text" name="pseudo" maxlength="20"
            value="<?php if (!empty($_POST["pseudo"]))
                { echo stripcslashes(htmlspecialchars($_POST["pseudo"],ENT_QUOTES)); }
                else{ echo htmlspecialchars(utf8_encode($pseudo)); } ?>" /><br/>
        <label for="pass">Mot de Passe : </label>
            <input type="text" name="motdepass" maxlength="20"
            value="<?php if (!empty($_POST["motdepass"]))
                { echo stripcslashes(htmlspecialchars($_POST["motdepass"],ENT_QUOTES)); }
                else{ echo htmlspecialchars(utf8_encode($pass)); } ?>" /><br/>
        <label for="email">Email : </label>
            <input type="text" name="email" maxlength="50"
            value="<?php if (!empty($_POST["email"]))
                { echo stripcslashes(htmlspecialchars($_POST["email"],ENT_QUOTES)); }
                else{ echo htmlspecialchars($email); } ?>" /><br/>
        <label for="action">Action : </label>
            <input type="submit" name="Envoyer" value="Envoyer" />
            <input name="Effacer" value="Effacer" type="reset" />
    </form>
    <br/>
    <?php
    if(isset($_POST['Envoyer'])){
        //si pseudo vide
        if(empty($_POST['pseudo'])){
            echo '<div class="erreur">Veuillez saisir un pseudo!</div>';
        }
        //si mot de passe vide
        else if(empty($_POST['motdepass'])){
            echo '<div class="erreur">Veuillez saisir un mot de passe!</div>';
        }
        //si l'email vide
        else if(empty($_POST['email'])){
            echo '<div class="erreur">Veuillez saisir un email!</div>';
        }
        //si l'email est invalide
        else if (!preg_match("$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$",
        $_POST['email'])){
            echo '<div class="erreur">Veuillez saisir un email valide!</div>';
        }
        //c'est ok
        else{
            //On sélectionne les données
            $donnees = mysql_query("SELECT pseudo,email FROM LOGIN
              WHERE pseudo!='".mysql_real_escape_string(stripcslashes(utf8_decode($pseudo)))."'
              && email!='".mysql_real_escape_string(stripcslashes($email))."'")
              or die ('Erreur :'.mysql_error());

            while($result = mysql_fetch_array($donnees)){
                //on vérifie si le pseudo est utilisé
                if(utf8_decode($_POST['pseudo'])==$result['pseudo']){
                    echo '<div class="erreur">Ce pseudo est utilisé!</div>'; return false;
                }
                //on vérifie si l'email est utilisé
                if($_POST['email']==$result['email']){
                    echo '<div class="erreur">Cet email est utilisé!</div>'; return false;
                }
            }
            //si c'est ok

            //on modifie les données du membre
            $modif = mysql_query("UPDATE LOGIN
              SET pseudo='".mysql_real_escape_string(stripcslashes($_POST['pseudo']))."',
               pass='".mysql_real_escape_string(stripcslashes($_POST['motdepass']))."',
               email='".mysql_real_escape_string(stripcslashes($_POST['email']))."'
               WHERE id='".mysql_real_escape_string($id)."'");
            //Si il y a une erreur
            if (!$modif) {
                die('Requête invalide : ' . mysql_error());
            }
            //tout est ok
            else{
                //on informe le membre
                echo '<div class="ok">Modification enregistré avec succès!
                Vous allez être déconnecté du service pour ouvrir une nouvelle session.</div>';
                //on "délogue" le membre car si le pseudo ou le mot de passe a été modifié,
                //la session en cours n'est plus bonne
                echo '<script type="text/javascript">
                          window.setTimeout("location=(\'../index.php?dec=close&session=new\');",30)
                      </script>';
            }
        }
    }
    ?>
    <h2>Télécharger une image</h2>

     <div class="info">Image au format « jpg » uniquement.
       L'image sera redimensionné automatiquement en 30*30.
       Une image trop volumineuse ne sera pas pris en charge!</div>

     <form enctype="multipart/form-data" action="#" method="post"
     onsubmit="Verif_attente('message_attente')" id="upload">
         <label for="photo">Image :</label>
             <input name="uploadFile" type="file" />
             <input type="submit" name="photo" id="photo" value="Envoyer la photo" /><br/>
     </form>

 <!--ci-dessous s'affiche le message d'attente lors de l'upload d'une image-->
 <div id="message_attente" style="margin-left: 350px;"></div>

 <?php
 //traitement de l'image
     //dossier d'upload
     $dossier_upload = '../auth-photos/';
     if(isset($_POST['photo'])){
         /*echo '<pre>';     print_r($_FILES);     echo '</pre>';*/
         if(isset($_FILES['uploadFile']) && $_FILES['uploadFile']['error'] == 0) {
             unset($erreur);
             //extensions autorisées
             $extensions_ok = array('jpg', 'jpeg', 'JPG');
             // vérifications
             //in_array — Indique si une valeur appartient à un tableau
             //substr — Retourne un segment de chaîne
             //strrchr — Trouve la dernière occurrence d'un caractère dans une chaîne
             if( !in_array(substr(strrchr($_FILES['uploadFile']['name'], '.'), 1), $extensions_ok ) )
             {
                 $erreur = '<div class="erreur">Veuillez sélectionner un fichier de type jpg !</div>';
             }
             //si pas d'erreur
             if(!isset($erreur))
             {
                 //L'image prend le numéro de l'identifiant comme nom et on oblige
                 //l’extension en jpg
                 $nom_de_l_image = $id.$image.'images.jpg';

                 // Récupération des infos de l'image
                 $img_infos = getimagesize($_FILES['uploadFile']['tmp_name']);

                 // Largeur de l'image
                 $img_width = $img_infos[0];
                 //echo '$img_width = '.$img_width.'<br>';
                 // Hauteur de l'image
                 $img_height = $img_infos[1];
                 //echo '$img_height = '.$img_height.'<br>';

                 //Dimension souhaité de l'image
                 $redimension_width = 30;
                 $redimension_height = 30;

                 //si la hauteur ou la largeur de l'image sont plus grandes que celle souhaité
                 if($img_width > $redimension_width || $img_height > $redimension_height){
                     //imagecreatefromjpeg — Crée une nouvelle image
                     $source = imagecreatefromjpeg($_FILES['uploadFile']['tmp_name']);
                     //imagecreatetruecolor — Crée une nouvelle image en couleurs vraies
                     $destination = imagecreatetruecolor($redimension_width, $redimension_height);
                     // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                     $largeur_source = imagesx($source);
                     $hauteur_source = imagesy($source);
                     $nouvelle_largeur = imagesx($destination);
                     $nouvelle_hauteur = imagesy($destination);
                     //imagecopyresampled — Copie, redimensionne, ré-échantillonne une image
                     imagecopyresampled($destination, $source, 0, 0, 0, 0, $nouvelle_largeur,
                     $nouvelle_hauteur, $largeur_source, $hauteur_source);
                     // On enregistre l'image réduite au format jpg
                     imagejpeg($destination, $dossier_upload.$nom_de_l_image);
                 }
                 //si l'image à une taille inférieure à celle souhaité, on enregistre sans modification
                 else {
                     move_uploaded_file($_FILES['uploadFile']['tmp_name'],
                     $dossier_upload.$nom_de_l_image);
                 }
                 //on redirige vers la même page pour recharger l'image uploadé
                 echo '<script type="text/javascript">
                           window.setTimeout("location=(\'user-modification.php\');",100)
                       </script>';
             }
         }
     }

     //si il y a des erreurs
     if(isset($erreur)){
         echo $erreur;
     }
    /*Suppression de l'image*/
     //Si $_GET['nom'] existe, on supprime le fichier...
     if(isset($_GET['nom']) && $_GET['nom']==$id.$image.'images.jpg')
     {
         $nom=''.$dossier_upload.$_GET['nom'].'';
         unlink($nom);
         echo '<script type="text/javascript">
                   window.setTimeout("location=(\'user-modification.php\');",100)
               </script>';
     }

     /*Fin de suppression de l'image*/
     //si l'image existe, on l'affiche avec un lien pour la supprimer et un bouton pour recharger la page
     if (file_exists('../auth-photos/'.$id.$image.'images.jpg')){
         echo '<div style="margin-left: 350px;">
         <img align="middle" class="avatar" alt="avatar" src="../auth-photos/'.$id.$image.'images.jpg'.'"/>
         <a title="Supprimer cette image" href="user-modification.php?nom='.$id.$image.'images.jpg'.'">« Supprimer »</a>
         <br/>
         <span id="cache">Si l\'image ne s\'actualise pas,
         <button onclick="javascript:location.reload();">Recharger la page</button>
         </span></div>';
     }

     ?>
</div>
    <noscript>
      <div class="erreur">
        <b>Votre navigateur ne prend pas en charge JavaScript!</b>
      Veuillez activer JavaScript afin de profiter pleinement du site.
      </div>
    </noscript>

</body>
</html>
<?php
    //fermeture de la BD
    close_bd();
    //on boucle la session du haut de page
}
?>
