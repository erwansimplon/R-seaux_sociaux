<?php
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<link rel="stylesheet" href="../css/actu-style.css" type="text/css" media="screen"/>
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
				<script type="text/javascript">
							$(function()
							{
							$(".view_comments").click(function()
							{

							var ID = $(this).attr("id");

							$.ajax({
							type: "POST",
							url: "../actu/viewajax.php",
							data: "msg_id="+ ID,
							cache: false,
							success: function(html){
							$("#view_comments"+ID).prepend(html);
							$("#view"+ID).remove();
							$("#two_comments"+ID).remove();
							}
							});

							return false;
							});
							});
				</script>
			</head>

<body>

<ol>

		<li class="li_msg">
				<form action="../actu/savemessage.php" method="post">
						<textarea class="editbox" cols="23" rows="3" name="message"></textarea><br />
						<input id="POST" name="POST" type="submit" value="POST" />
				</form>
		</li>

<?php
include("../bdd/db.php");

$msql1=mysql_query("select * from messages order by msg_id desc");
while($messagecount=mysql_fetch_array($msql1))
{
$id_msg=$messagecount['msg_id'];
$msgcontent=$messagecount['message'];

$req="SELECT pseudo FROM LOGIN AS l INNER JOIN messages AS m ON l.id = m.idLog WHERE id= $id";
// $req ="insert into messages (message, IdLog) VALUES ('Mon message','$id')";

$msql=mysql_query($req);



while($msg=mysql_fetch_array($msql, MYSQL_ASSOC))
{
?>

<li class="comment_envoyer">

		<div class="comment_squelette">

				<h3 class="Message" >

					<?php

					//Si le membre possède une image, on l'affiche

					if (file_exists('../auth-photos/'.$id.$image.'images.jpg')){
					echo '<img class="avatar" style="float:left;" alt="avatar" src="../auth-photos/'.$id.$image.'images.jpg"/>';
					}

					?><?php
												$idm=$msg['pseudo'];
												print '<strong>'.$idm.'</strong>';

												echo '<br>'.$msgcontent;
											?><!--<strong><//?php print $idm; ?></strong>-->
						<!--<p><//?php echo $msgcontent; ?></p>-->

		<div id="message_conteneur">

<?php

$sql=mysql_query("select * from comments where msg_id_fk='$id_msg' order by com_id");
$comment_count=mysql_num_rows($sql);

if($comment_count>2)
{
$second_count=$comment_count-2;
?>

		<div class="comment_ui" id="view<?php echo $id_msg; ?>">
				<div><a href="#" class="view_comments" id="<?php echo $id_msg; ?>">Voir les <?php echo $comment_count; ?> autres commentaires</a></div>
		</div>

<?php
}
else
{
$second_count=0;
}
?>

		<div id="view_comments<?php echo $id_msg; ?>"></div>

		<div id="two_comments<?php echo $id_msg; ?>">

<?php
$listsql=mysql_query("select * from comments where msg_id_fk='$id_msg' order by com_id limit $second_count,2 ");
while($rowsmall=mysql_fetch_array($listsql))
{
$c_id=$rowsmall['com_id'];
$comment=$rowsmall['comments'];
?>

		<div class="comment_ui">

		<div class="comment_text">

				<div  class="comment_actual_text">

					<?php
				            //Si le membre possède une image, on l'affiche

										if (file_exists('../auth-photos/'.$id.$image.'images.jpg')){
										echo '<img class="avatar" style="float:left;" alt="avatar" src="../auth-photos/'.$id.$image.'images.jpg"/>';
										}

				            ?><div id="comment_post"><?php echo $comment; ?></div></div>
		</div>

</div>

<?php } ?>
		<div class="add_comment">
			<div>
				<?php
				//Si le membre possède une image, on l'affiche

				if (file_exists('../auth-photos/'.$id.$image.'images.jpg')){
				echo '<img class="avatar" style="float:left;" alt="avatar" src="../auth-photos/'.$id.$image.'images.jpg"/>';
				}

			?>
				<form action="../actu/savecomment.php" method="post">
					<input name="mesgid" type="hidden" value="<?php echo $id_msg ?>" />
					<input name="mcomment" id="text_comment" type="text" placeholder="..." />
					<input id="Envoyer" name="" type="submit" value="Envoyer" />
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</li>
<?php
}
}
?>
</ol>

</body>
</html>