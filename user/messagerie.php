<?php
connexion_bd();
html();
head_style();
$i = "1";
$u = "1";
$b = "1";
$h = "1";
$c = "1";
$m = "1";
$r = "1";
$q = "1";
$fo = "1";
$bo="1";
$msg="1";
$body = "1";
?>
<head>
  <?php js_move();?>
</head>
  <body>
  <div id="chat_box" class="chat_box">
	<div id="chat_head" class="chat_head">Channel</div>
  <div class="chat_body">
<?php
  $membre = mysql_query("SELECT * FROM `amis` WHERE idami=$id ORDER BY connect=1 ASC");
  while($amis = mysql_fetch_array($membre)){
    $idlog=$amis['IdLog'];
    ?>

    <script type="text/javascript">

    $(document).ready(function(){
      var bo = <?php echo $u; ?>;
      var bot = bo.toString();
      var bott = "#env_msg";
      var bouton = bott + bot;
      var mesg = "#test978";
      var messages = mesg + bot;
      var mesg_body = ".msg_body";
      var messages_body = mesg_body + bot;
      console.log(messages);
      console.log(bouton);
      console.log(messages_body);
      $(bouton).click(function()
      {
        var auto_refresh = setInterval( //auto_refresh du chat
          function ()
          {$(messages_body).load('../user/select_msg.php?id=<?php echo $id; ?>&idlog=<?php echo $idlog; ?>').fadeIn("slow");}, 2000);
        var message = $(messages).val();

        $(messages).val("");
          $.ajax({
          type: "GET",
          url: "../user/ajax.php",
          data: "message="+message+'&id='+<?php echo $id; ?>+'&idlog='+<?php echo $idlog; ?>,
          cache: false,
            success: function(html){
            $(messages_body).prepend(html);
            }
        });
        return false;
      });

      //Variables pour le Channel et sélection user
      var i = <?php echo $u; ?>;
      var j = i.toString();
      var k = ".user";
      var l = k + j;
      //Variable pour sélectionner les messages box

      var g = ".msg_box";
      var h = g + j;

      var o = ".msg_head";
      var p = o + j;

      var q = ".msg_body";
      var r = q + j;

      var x = ".reduire";
      var y = x + j;

      var foo = ".msg_footer";
      var foot = foo + j;

      var m = ".close";
      var n = m + j;

      $(h).hide();

      $('.chat_head').click(function(){
        $(l).slideToggle('slow');
      });

      $(l).click(function() {
        $(h).show();
      });

      $(y).click(function(){
        $(r).slideToggle('slow');
        $(foot).slideToggle('slow');
      });

      $(n).click(function(){
        $(h).hide();
      });
    });

    </script>
    <?php if($amis['connect'] >= 1){ ?>
			<div id="user" class="user<?php echo $u++; ?>">

			<?php

                      if (file_exists('../photos/miniature/'.$idlog.$image.'images.jpg')){
                        echo '<img class="avatar avatar_box" style="float:left;" alt="avatar" src="../photos/miniature/'.$idlog.$image.'images.jpg"/>';
                      }
                      else {
                          echo '<img class="avatar avatar_box" style="float:left;" alt="avatar" src="../photos/miniature/'.$image.'images.jpg"/>';
                      }
              			echo '<h3 class="nom_channel">'.$amis['pseudo'].'</h3><br />';
          		?>
        	</div>
        <?php }
        else{
          ?>
          <div id="user_dec" class="user<?php echo $u++; ?>">

    			<?php

                          if (file_exists('../photos/miniature/'.$idlog.$image.'images.jpg')){
                            echo '<img class="avatar avatar_box" style="float:left;" alt="avatar" src="../photos/miniature/'.$idlog.$image.'images.jpg"/>';
                          }
                          else {
                              echo '<img class="avatar avatar_box" style="float:left;" alt="avatar" src="../photos/miniature/'.$image.'images.jpg"/>';
                          }
                  			echo '<h3 class="nom_channel">'.$amis['pseudo'].'</h3><br />';
              		?>
            	</div>
      <?php
        }
        }

      ?>
    </div>
</div>

<?php
$membre5 = mysql_query("SELECT * FROM `amis` WHERE idami=$id ORDER BY connect=1 ASC");
while($amis2 = mysql_fetch_array($membre5)){
$idlog1=$amis2['IdLog'];
$pseudo=$amis2['pseudo'];
?>
<div id="msg_box" class="msg_box<?php echo $b++; ?>">
	<div id="msg_head" class="msg_head<?php echo $h++; ?>">
    <div id="close" class="close<?php echo $c++; ?>">x</div>
    <div id="reduire" class="reduire<?php echo $r++; ?>">-</div>
        <?php
        if (file_exists('../photos/miniature/'.$idlog1.$image.'images.jpg')){
          echo '<img class="avatar avatar_msg" style="float:left;" alt="avatar" src="../photos/miniature/'.$idlog1.$image.'images.jpg"/>';
        }
        else {
            echo '<img class="avatar avatar_msg" style="float:left;" alt="avatar" src="../photos/miniature/'.$image.'images.jpg"/>';
        }
        echo '<h4 class="nom">'.$amis2['pseudo'].'</h4><br />';
        ?>

          	</div>

            <div id="msg_body" class="msg_body<?php echo $q++; ?>">
              <script>var focus = document.getElementById("msg_ami").lastChild;
                      console.log(focus);
                      focus.focus();</script>
              <?php
              $reponse = mysql_query("SELECT DISTINCT * FROM minichat where author_id = $id and msg_ami_id = $idlog1 and message != '' AND message IS NOT NULL || author_id = $idlog1 and msg_ami_id = $id and message != '' AND message IS NOT NULL ORDER BY id ASC");
              while($val = mysql_fetch_array($reponse)){
                echo '<p id="msg_ami" class ="msg_a"><b>'.$val['pseudo'].'
                à '.date('H:i',$val['timestamp']).' : </b>'. htmlentities(stripslashes($val['message'])) .'</p>';
              }
?>
            </div>

            <div class="msg_footer<?php echo $fo++;?>" id="message">


                      <textarea class="msg_input" rows="4" type="text" name="message" id="test978<?php echo $msg++;?>"></textarea>
                      <button id="env_msg<?php echo $bo++;?>" class="env_msg" value="Envoyer">Envoyer</button>

            </div>
            <?php

            ?>
            </div>
            <?php

            }
            break;
            ?>
</body>
</html>
