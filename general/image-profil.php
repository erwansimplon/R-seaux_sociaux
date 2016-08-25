<?php
session_start();

include("../bdd/db.php");
$req="SELECT * FROM LOGIN WHERE pseudo='".mysql_real_escape_string(stripcslashes($_SESSION['pseudo']))."'
AND pass='".mysql_real_escape_string($_SESSION['pass'])."'
AND valide='".mysql_real_escape_string(1)."'";

$affiche = mysql_query($req);
//$result = mysql_fetch_assoc($affiche);

$idlog=$_SESSION['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta http-equiv="Content-Language" content="fr" />
            <link type="text/css" href="../css/admin-style.css" rel="stylesheet"/>
            <link type="text/css" href="../css/style-index.css" rel="stylesheet"/>

        </head>
<div id="cadre">
  <h2>Télécharger une image</h2>
  <br>
   <form enctype="multipart/form-data" action="" method="post"
   onsubmit="Verif_attente('message_attente')" id="upload">
           <input class="button_pos_photo" name="uploadFile" type="file" />
           <input type="submit" name="photo" id="photo" class="button_tel button_effacer" value="Envoyer la photo" /><br/>
   </form>
   <br>
<!--ci-dessous s'affiche le message d'attente lors de l'upload d'une image-->
<div id="message_attente"></div>
<br>
<?php
//traitement de l'image
   //dossier d'upload
   $dossier_upload = '../auth-photos/profil/';
   if(isset($_POST['photo'])){

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
               $nom_de_l_image = $idlog.$image.'images.jpg';

               // Récupération des infos de l'image
               $img_infos = getimagesize($_FILES['uploadFile']['tmp_name']);

               // Largeur de l'image
               $img_width = $img_infos[0];
               //echo '$img_width = '.$img_width.'<br>';
               // Hauteur de l'image
               $img_height = $img_infos[1];
               //echo '$img_height = '.$img_height.'<br>';

               //Dimension souhaité de l'image
               $redimension_width = 300;
               $redimension_height = 300;

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
               header("location: $hachage = $idlog;
                               $URL_NEWS = image-profil.php?id=.$hachage;
                                print $URL_NEWS;");
           }
       }
   }

   //si il y a des erreurs
   if(isset($erreur)){
       echo $erreur;
   }
  /*Suppression de l'image*/
   //Si $_GET['nom'] existe, on supprime le fichier...
   if(isset($_GET['nom']) && $_GET['nom']==$idlog.$image.'images.jpg')
   {
       $nom=''.$dossier_upload.$_GET['nom'].'';
       unlink($nom);
       echo '<script type="text/javascript">
                 window.setTimeout("location=(\'image-profil.php\');",100)
             </script>';
   }

   /*Fin de suppression de l'image*/
   //si l'image existe, on l'affiche avec un lien pour la supprimer et un bouton pour recharger la page
   if (file_exists('../auth-photos/profil/'.$idlog.$image.'images.jpg')){
       echo '<div>
       <img align="middle" class="avatar" alt="avatar" src="../auth-photos/profil/'.$idlog.$image.'images.jpg'.'"/>
       <a title="Supprimer cette image" href="image-profil.php?nom='.$idlog.$image.'images.jpg'.'">« Supprimer »</a>
       <br/>
       <span id="cache">Si l\'image ne s\'actualise pas,
       <button onclick="javascript:location.reload();">Recharger la page</button>
       </span></div>';
   }

   ?>
   <h2 id="lien"><a href="<?php $hachage = $idlog;
                   $URL_NEWS = "page-user.php?id=".$hachage;
                    print $URL_NEWS;?>">Retour</a></h2>
</div>
  <noscript>
    <div class="erreur">
      <b>Votre navigateur ne prend pas en charge JavaScript!</b>
    Veuillez activer JavaScript afin de profiter pleinement du site.
    </div>
  </noscript>
  <br>
  <div class="info">Image au format « jpg » uniquement.
    L'image sera redimensionné automatiquement en 30*30.
    Une image trop volumineuse ne sera pas pris en charge!</div>
    <br/>
