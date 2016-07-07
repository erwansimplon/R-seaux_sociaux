
<ul id="menu">

        <li><a href="<?php $hachage = sha1("id=".$rows['id']."&pseudo=".$rows['pseudo']);
                      $URL_NEWS = "../general/user.php?id=".$hachage;
                      print $URL_NEWS;?>">Accueil</a>
        </li>

      <li>Profil

        <ul>
          <li><a href="../general/user-modification.php">Modifier votre profil</a></li>
          <li><a href="../admin/admin.php">Administration</a></li>
        </ul>

      <li><a href="../index.php?dec=close">Déconnexion</a></li>
</ul>
