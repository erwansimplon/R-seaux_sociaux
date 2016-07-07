<?php
include("../bdd/connexion_bdd.php");
$req="SELECT * FROM LOGIN WHERE pseudo='".mysql_real_escape_string(stripcslashes($_SESSION['pseudo']))."'
AND pass='".mysql_real_escape_string($_SESSION['pass'])."'
AND valide='".mysql_real_escape_string(1)."'";

$affiche = mysql_query($req);
//$result = mysql_fetch_assoc($affiche);
while($msg=mysql_fetch_array($affiche, MYSQL_ASSOC))
{
$_SESSION['id']=$msg['id'];

}

$id=$_SESSION['id'];

?>
<meta charset="utf-8"/>
<link type="text/css" href="../css/admin-style.css" rel="stylesheet"/>
<div id="cadre">
<h1>Télécharger une image</h1><br />

 <form enctype="multipart/form-data" action="#" method="post"
 onsubmit="Verif_attente('message_attente')" id="upload" style="margin-left: 17%;">
     <h3><label for="photo">Image :</label></h3>
         <input name="uploadFile" type="file" /><br/>
         <input type="submit" name="photo" id="photo" value="Envoyer la photo" style="margin-left: 25.5%;" /><br/><br/>
 </form>

<!--ci-dessous s'affiche le message d'attente lors de l'upload d'une image-->
<div id="message_attente" style="margin-left: 350px;"></div>

<?php
//traitement de l'image
 //dossier d'upload
 $dossier_upload = '../auth-photos/profil/';
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
             $hachage = sha1("id=".$rows['id']."&pseudo=".$rows['pseudo']);
             $URL_NEWS = "../general/page-user.php?id=".$hachage;
             header("location: $URL_NEWS");
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
     $hachage = sha1("id=".$rows['id']."&pseudo=".$rows['pseudo']);
     $URL_NEWS = "../general/page-user.php?id=".$hachage;
     header("location: $URL_NEWS");
 }
 /*Fin de suppression de l'image*/
 //si l'image existe, on l'affiche avec un lien pour la supprimer et un bouton pour recharger la page
 if (file_exists('../auth-photos/profil/'.$id.$image.'images.jpg')){
     echo '<div style="margin-left: 40%;">
     <img align="middle" class="avatar" alt="avatar" src="../auth-photos/profil/'.$id.$image.'images.jpg'.'"/>
     <a title="Supprimer cette image" href="page-user.php?nom='.$id.$image.'images.jpg'.'">« Supprimer »</a>
     <br/><br/>
     <h3 id="cache">Si l\'image ne s\'actualise pas,
     <button onclick="javascript:location.reload();">Recharger la page</button></h3><br/>
     </div>';
 }
 ?>
 <h2 id="lien"><a href="<?php $hachage = sha1("id=".$rows['id']."&pseudo=".$rows['pseudo']);
                 $URL_NEWS = "page-user.php?id=".$hachage;
                  print $URL_NEWS;?>">Retour</a></h2>
</div>
