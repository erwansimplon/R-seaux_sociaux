<?php
session_start();

select_header();

$id=$_SESSION['id'];
$url_id = $_GET['id'];
html();
?>
	<head>
		<?php
			head_actu_style();
			ajax();
	  ?>

		<!-- fin ajax -->
	</head>

	<body>

	<ol>
	<!-- formulaire pour que l'utilisateur puisse taper son message et l'envoyer -->
		<li class="li_msg">
			<form action="../actu/savemessage.php?idlog=<?php echo $url_id; ?>" method="post">
				<textarea class="editbox" cols="23" rows="3" name="message"></textarea><br />
				<input id="POST" name="POST" type="submit" value="Publier" />
			</form>
		</li>
	<!-- fin -->
				<?php
				// recupération du fichier connection
				connexion_bd();
					// jointure qui relie l'utilisateurs a c'est message
					$req="SELECT * FROM LOGIN LEFT JOIN amis ON LOGIN.id = amis.IdLog LEFT JOIN messages ON LOGIN.id = messages.IdLog where LOGIN.id=$id AND messages.msg_id IS NOT NULL or amis.idami=$id AND messages.msg_id IS NOT NULL GROUP BY messages.msg_id order by messages.msg_id DESC";
					// $req="SELECT DISTINCT l.pseudo, m.msg_id, m.jointure, m.message, m.idLog, a.idami FROM LOGIN AS l INNER JOIN messages AS m ON l.id = $url_id INNER JOIN amis AS a ON a.idami = m.idLog order by m.msg_id DESC";
					// $req ="insert into messages (message, IdLog) VALUES ('Mon message','$id')";
//Select l.id, l.pseudo, a.IdLog, m.IdLog, m.message from LOGIN as l, amis AS a, messages AS m where (l.id=m.IdLog) or (l.id=6 and a.IdLog=l.id) Group By l.pseudo
//Select l.id, l.pseudo, a.IdLog, m.IdLog, m.message from LOGIN as l, amis AS a, messages AS m where (l.id=m.IdLog) or ((l.id=6 and a.IdLog=l.id) or (l.id=6 and a.idami=l.id)) Group By l.pseudo
//Select l.id, l.pseudo, a.IdLog as IdLogAmi, a.idami, m.IdLog as IdLogMessage, m.message from LOGIN as l, amis AS a, messages AS m where (l.id=m.IdLog) or ((l.id=6 and a.IdLog=l.id) or (l.id=6 and a.idami=l.id)) Group By l.pseudo
					$msql=mysql_query($req);


					//bug a corrigé les 2 boucles while on un confli
						while($msg=mysql_fetch_array($msql, MYSQL_ASSOC))
						{
							$id_msg=$msg['msg_id'];
							$msgcontent=strip_tags($msg['message']);
				?>
						<!-- structure des message poster par l'utilisateur -->
						<li class="comment_envoyer">

							<div class="comment_squelette">
								<!-- contenu du message poster -->
								<h3 class="Message" >

									<?php
									$idLog=$msg['IdLog'];
									$pseudo=$msg['pseudo'];
									//Si le membre possède une image, on l'affiche

									if (file_exists('../photos/miniature/'.$idLog.$image.'images.jpg')){
										echo '<img class="avatar" style="float:left;" alt="avatar" src="../photos/miniature/'.$idLog.$image.'images.jpg"/>';
									}
									else {
									echo '<img class="avatar" style="float:left;" alt="avatar" src="../photos/miniature/'.$image.'images.jpg"/>';
								}

									$idm=$msg['pseudo'];
									if ($id == $idLog){
									?>
									<a href="../actu/delete_message.php?msg_id=<?php echo $id_msg; ?>"><h3 class="suppr_msg">X</h3></a>
									<?php } ?>
									<a href="<?php $hachage = $idLog;
			                $URL_NEWS = "../page-user/page-user.php?id=".$hachage."&pseudo=".$idm;
			                print $URL_NEWS;?>"><?php print '<p><strong>'.$idm.'</strong></p></a>';//affiche le pseudo en gras
									echo '<br>'.$msgcontent; //affiche le message
									?>
									<div id="message_conteneur">

										<?php
										// affiche les commentaires dessous du message correspondant
										$sql=mysql_query("SELECT DISTINCT l.pseudo, c.com_id, c.comments, c.msg_id_fk, c.idlog FROM LOGIN AS l INNER JOIN comments AS c ON l.id = c.idLog where c.msg_id_fk='$id_msg' order by c.com_id ASC");
										$comment_count=mysql_num_rows($sql);


										/* permet de voir que 2 commentaires sous les messsage et on doit cliquer sur la div class="comment_ui"
										pour afficher tous les commentaires */

										if($comment_count>2)
										{
											$second_count=$comment_count-2;
										?>

											<div class="comment_ui" id="view<?php echo $id_msg; ?>">
												<div>
													<a href="#" class="view_comments" id="<?php echo $id_msg; ?>"><p>
														Voir les <?php echo $comment_count; ?> autres commentaires</p></a>
												</div>
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
													$listsql=mysql_query("SELECT DISTINCT l.pseudo, c.com_id, c.comments, c.msg_id_fk, c.idlog FROM LOGIN AS l INNER JOIN comments AS c ON l.id = c.IdLog where c.msg_id_fk='$id_msg' order by c.com_id ASC limit $second_count,2 ");

													while($rowsmall=mysql_fetch_array($listsql))
													{
														$c_id=$rowsmall['com_id'];
														$comment=strip_tags($rowsmall['comments']);
														$idLog_com=$rowsmall['idlog'];
														$ps=$rowsmall['pseudo'];
														?>

																<div class="comment_ui">

																<div class="comment_text">
																	<div  class="comment_actual_text">
																		<?php if($id == $idLog_com){ ?>
																		<a href="../actu/delete_comment.php?com_id=<?php echo $c_id; ?>"><h3 class="suppr_msg">X</h3></a>
																		<?php
																		}
																		//Si le membre possède une image, on l'affiche
																		if (file_exists('../photos/miniature/'.$idLog_com.$image.'images.jpg')){
																		echo '<img class="avatar" style="float:left;" alt="avatar"
																		src="../photos/miniature/'.$idLog_com.$image.'images.jpg"/>';
																		}
																		else {
																		echo '<img class="avatar" style="float:left;" alt="avatar" src="../photos/miniature/'.$image.'images.jpg"/>';
																	}
															?>
															<div id="comment_post"><b><?php echo $ps.'</b><br>'.$comment; ?></div>
														</div>
													</div>
												</div>

												<?php
													}
												?>
												<div class="add_comment">
													<div>
														<?php
														//Si le membre possède une image, on l'affiche

														if (file_exists('../photos/miniature/'.$id.$image.'images.jpg')){
															echo '<img class="avatar" style="float:left;" alt="avatar"
															src="../photos/miniature/'.$id.$image.'images.jpg"/>';
														}
														else {
														echo '<img class="avatar" style="float:left;" alt="avatar" src="../photos/miniature/'.$image.'images.jpg"/>';
													}
														?>
														<!-- formulaire qui permet a l'utilisateur d'écrire un commentaire -->

														<form action="../actu/savecomment.php" method="post">
															<input name="mesgid" type="hidden" value="<?php echo $id_msg ?>" />
															<input name="mcomment" id="text_comment" type="text" placeholder="..." />
															<input id="Envoyer" class="envoyer-color" name="" type="submit" value="Envoyer" />
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>
						<?php
							}

						?>
					</ol>
			</body>
</html>
