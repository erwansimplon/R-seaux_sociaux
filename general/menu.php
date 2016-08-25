<ul class="menu mise-en-form">
	<li><a href="<?php $hachage = $_SESSION['id'];
                $URL_NEWS = "../general/user.php?id=".$hachage;
                print $URL_NEWS;?>">Accueil</a></li>
	<li>
		<a href = "#">Profil</a>
		<ul class="submenu">
			<li><a href="../general/user-modification.php">Modifier votre profil</a></li>
			<li><a href="../admin/admin.php">Administration</a></li>
		</ul>
	</li>
	<li><a href="../index.php?dec=close">Déconnexion</a></li>
</ul>
