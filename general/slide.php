<HTML>
<HEAD>
  <meta http-equiv="content-Type" content="text/html; charset=uf-8">
  <title>Slide</title>
  <script language="JavaScript" src="slide.js"></script>
  <link rel="stylesheet" type="text/css" href="slide.css">
</HEAD>

<BODY onLoad="preload(<?php'../auth-photos/profil/'$id.$image.$i.'.jpg'; ?>)">
  <h2>Manuel</h2>
  <img src="../auth-photos/profil/'$id.$image.$i.'.jpg" id="Puzzle" name="Puzzle">
  <a href="javascript:arret()"><img src=<?php'../auth-photos/profil/'$id.$image.$i.'.jpg'?> id="Slide" name="Slide" alt="clic pour arreter"></a><br/>
  <a href="javascript:chgSlide(-1)"><b> << </b></a> &nbsp; <script language="JavaScript">autoSlide('Slide')</script> &nbsp; <a href="javascript:chgSlide(1)"><b> >> </b></a>



</BODY>
</HTML>
