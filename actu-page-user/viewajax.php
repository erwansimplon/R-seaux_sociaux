<?php
include("../bdd/connexion_bdd.php");
connexion_bd();
session_start();
$req="SELECT * FROM LOGIN WHERE pseudo='".mysql_real_escape_string(stripcslashes($_SESSION['pseudo']))."'
AND pass='".mysql_real_escape_string($_SESSION['pass'])."'
AND valide='".mysql_real_escape_string(1)."'";

$affiche = mysql_query($req);
//$result = mysql_fetch_assoc($affiche);

while($msg=mysql_fetch_array($affiche, MYSQL_ASSOC))
{
	$_SESSION['id']=$msg['id'];
	$idLog=$msg['idLog'];
	$pseudo=$msg['pseudo'];
}

$ids=$_SESSION['id'];

?>
 <?php
if(isset($_POST['msg_id']))
{
$id=$_POST['msg_id'];
$url_id=$_POST['id'];
$url_pseudo=$_POST['pseudo'];
$com=mysql_query("SELECT DISTINCT l.pseudo, c.com_id, c.comments, c.msg_id_fk, c.idlog FROM LOGIN AS l INNER JOIN comm AS c ON l.id = c.idLog INNER JOIN msg AS m ON l.id = m.idLog where c.msg_id_fk='$id' order by c.com_id ASC");
while($r=mysql_fetch_array($com))
{
$c_id=$r['com_id'];
$comment=strip_tags($r['comments']);
$idLog_com=$r['idlog'];
$ps=$r['pseudo'];
?>

<div class="comment_ui" >
	<div class="comment_text">
		<div  class="comment_actual_text">
			<img class="avatar" src="../photos/miniature/<?php print $idLog_com; ?>images.jpg" />
			<div id="comment_post"><b><?php echo $ps.'</b><br>'.$comment; ?></div>
			<?php if($ids == $url_id){ ?>
				<a href="../actu-page-user/delete_comment_user.php?com_id=<?php echo $c_id; ?>&id=<?php echo $url_id; ?>"><h3 class="suppr_msg">X</h3></a>
			<?php }
			else{ ?>
			<a href="../actu-page-user/delete_comment_user.php?com_id=<?php echo $c_id; ?>&id=<?php echo $url_id; ?>&pseudo=<?php echo $url_pseudo; ?>"><h3 class="suppr_msg">X</h3></a>
			<?php } ?>
		</div>
	</div>
</div>


<?php
}
}
?>
<div class="add_comment">
	<div>
		<img class="avatar" src="../photos/miniature/<?php print $idLog_com; ?>images.jpg" id="profil_img" />
		<form action="../actu-page-user/savecomment.php?idlog=<?php echo $url_id;?>&pseudo=<?php echo $url_pseudo; ?>" method="post">
			<input name="mesgid" type="hidden" value="<?php echo $id ?>" />
			<input name="mcomment" type="text" placeholder="..." id="text_comment" />
			<input id="Envoyer" class="envoyer-color" name="" type="submit" value="Envoyer" />
		</form>
	</div>
</div>
