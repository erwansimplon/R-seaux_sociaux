 <?php
 include("../bdd/db.php");

if(isset($_POST['msg_id']))
{
$id=$_POST['msg_id'];
$com=mysql_query("select * from comm where msg_id_fk='$id' order by com_id");
while($r=mysql_fetch_array($com))
{
$c_id=$r['com_id'];
$comment=$r['comm'];
?>


<div class="comment_ui" >
	<div class="comment_text">
		<div  class="comment_actual_text">
			<img id="profil_img" src="../auth-photos/'.$id.$image.'images.jpg" />
			<div id="comment_post"><?php echo $comment; ?>
			</div>
		</div>
	</div>
</div>


<?php 
}
}
?>

<div class="add_comment">
	<div>
		<img src="../auth-photos/'.$id.$image.'images.jpg" id="profil_img" />
		<form action="../user/savecomment.php" method="post">
			<input name="mesgid" type="hidden" value="<?php echo $id ?>" />
			<input name="mcomment" type="text" placeholder="..." id="largeur_input_comment" />
			<input id="Envoyer" name="" type="submit" value="Envoyer" />
		</form>
	</div>
</div>
