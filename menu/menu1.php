<script>
function vaEtVient(){
		if(document.getElementById('invisible').style.display == 'none'){
    	document.getElementById('invisible').style.display = 'block';
  		}
  		else {
    	document.getElementById('invisible').style.display = 'none';
		}
}
</script>
<nav>
  <div class='conteneur_menu'>
    <div class='pagemenu' id="menu_img">
        <a class='img_perso' href="<?php $hachage = $_GET['id'];
                        $URL_NEWS = "../page-user/page-user.php?id=".$hachage;
                         print $URL_NEWS;?>"><?php
      //Si le membre possède une image, on l'affiche

      if (file_exists('../photos/miniature/'.$id.$image.'images.jpg')){
      echo '<img class="avatar_tel" style="float:left;" alt="avatar" src="../photos/miniature/'.$id.$image.'images.jpg"/>';
      }

			else {
					echo '<img class="avatar" style="float:left;" alt="avatar" src="../photos/miniature/'.$image.'images.jpg"/>';
			}

        ?></a>
				<div class='rubrique' id="placementrecherche_tel_400px">
          <?php include("../recherche/search.php"); ?>
        </div>
    </div>
    <div class='pagemenu' id="menu_tel_400px">
      <a href="../index.php?dec=close">Déconnexion</a>
    </div>
    <div class='pagemenu'>
      <a href="<?php $hachage = $_GET['id'];
                    $URL_NEWS = "../user/user.php?id=".$hachage;
                    print $URL_NEWS;?>">Accueil</a>
    </div>
    <div class='rubrique'>
      <a href = 'javascript: vaEtVient()'>Profil</a>
      <div id="invisible" class='sousmenu'>
        <div class='pagesousmenu'>
          <a href="../user/user-modification.php">Modifier votre profil</a>
        </div>
        <div class='pagesousmenu'>
          <a href="../admin/admin.php">Administration</a>
        </div>
				<div class='pagesousmenu'>
					<a href="../faq/faq.php">FAQ</a>
				</div>
				<div class='pagesousmenu'><a href="<?php $hachage = $_SESSION['id'];
											$URL_NEWS = "../ajout-amis/liste-amis.php?id=".$hachage;
											print $URL_NEWS;?>">Amis</a></div>
      </div>
    </div>
    <div class='pagemenu' id="menu_tel_830px">
      <a href="../index.php?dec=close">Déconnexion</a>
    </div>
  </div>
</nav>
