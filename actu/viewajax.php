 <?php
 include("../bdd/db.php");

if(isSet($_POST['msg_id']))
{
$id=$_POST['msg_id'];
$com=mysql_query("select * from comments where msg_id_fk='$id' order by com_id DESC");
while($r=mysql_fetch_array($com))
{
$c_id=$r['com_id'];
$comment=$r['comments'];
?>


<div class="comment_ui" >
<div class="comment_text">
<div  class="comment_actual_text"><img id="profil_img" src="profile.jpg" /><div id="comment_post"><?php echo $comment; ?></div></div>
</div>
</div>


<?php } }?>
<div class="add_comment">
<div>
<img src="profile.jpg" id="profil_img" />
<form action="../actu/savecomment.php" method="post">
<input name="mesgid" type="hidden" value="<?php echo $id ?>" />
<input name="mcomment" type="text" placeholder="..." id="largeur_input_comment" />
<input id="Envoyer" name="" type="submit" value="Envoyer" />
</form>
</div>
</div>
