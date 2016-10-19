<ul class="menu mise-en-form">
	<li><a href="<?php $hachage = $_SESSION['id'];
                $URL_NEWS = "../user/user.php?id=".$hachage;
                print $URL_NEWS;?>">Accueil</a></li>
	<li>
		<a href = "#">Profil</a>
		<ul class="submenu">
			<li><a href="../user/user-modification.php">Modifier votre profil</a></li>
			<li><a href="../admin/admin.php">Administration</a></li>
			<li><a href="../faq/faq.php">FAQ</a></li>
			<li><a href="<?php $hachage = $_SESSION['id'];
		                $URL_NEWS = "../ajout-amis/liste-amis.php?id=".$hachage;
		                print $URL_NEWS;?>">Amis</a></li>
		</ul>
	</li>
	<li><a href="../index.php?dec=close">Déconnexion</a></li>
</ul>
