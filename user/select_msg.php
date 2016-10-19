<?php
require_once("../bdd/connexion_bdd.php");
connexion_bd();
$id=$_GET['id'];
$idlog=$_GET['idlog'];
$pseudo=$_GET['pseudo'];
?>
<p class="msg_a"><?php
$reponse = mysql_query("SELECT DISTINCT * FROM minichat where author_id = $id and msg_ami_id = $idlog and message != '' and message IS NOT NULL || author_id = $idlog and msg_ami_id = $id and message != '' AND message IS NOT NULL order by id ASC");
while($val = mysql_fetch_array($reponse)){
  echo '<p class ="msg_a"><b>'.$val['pseudo'].'
  à '.date('H:i',$val['timestamp']).' : </b>'. htmlentities(stripslashes($val['message'])) .'</p>';
}

?>
