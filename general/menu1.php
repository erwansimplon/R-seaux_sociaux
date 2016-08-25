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
                        $URL_NEWS = "page-user.php?id=".$hachage;
                         print $URL_NEWS;?>"><?php
      //Si le membre possède une image, on l'affiche

      if (file_exists('../auth-photos/'.$id.$image.'images.jpg')){
      echo '<img class="avatar_tel" style="float:left;" alt="avatar" src="../auth-photos/'.$id.$image.'images.jpg"/>';
      }

        ?></a>
        <div class='rubrique' id="placementrecherche_tel_400px">
							<form action="http://www.youtube.com/results" method="get" target="_blank" class="form-recherche">
									<input id="search" name="search_query" type="text" />
									<button type="button" id="submit" class="button_search"><img class="image_loupe" src="../auth-photos/a.png" /></button>
							</form>
       	</div>
    </div>
    <div class='pagemenu' id="menu_tel_400px">
      <a href="../index.php?dec=close">Déconnexion</a>
    </div>
    <div class='pagemenu'>
      <a href="<?php $hachage = $_GET['id'];
                    $URL_NEWS = "../general/user.php?id=".$hachage;
                    print $URL_NEWS;?>">Accueil</a>
    </div>
    <div class='rubrique'>
      <a href = 'javascript: vaEtVient()'>Profil</a>
      <div id="invisible" class='sousmenu'>
        <div class='pagesousmenu'>
          <a href="../general/user-modification.php">Modifier votre profil</a>
        </div>
        <div class='pagesousmenu'>
          <a href="../admin/admin.php">Administration</a>
        </div>
      </div>
    </div>
    <div class='pagemenu' id="menu_tel_830px">
      <a href="../index.php?dec=close">Déconnexion</a>
    </div>
  </div>
</nav>
