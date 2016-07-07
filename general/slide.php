<html>
<head>
  <meta http-equiv="content-Type" content="text/html; charset=uf-8">
  <title>Slide</title>
  <script language="JavaScript" src="slide.js"></script>
  <link rel="stylesheet" type="text/css" href="slide.css">
</head>

<body onLoad="preload(<?php'../auth-photos/'.$id.$image.'images.jpg'; ?>)">
  <h2>Manuel</h2>
  <img src="<?php'../auth-photos/profil/'.$id.$image.'images.jpg'?> id="Puzzle" name="Puzzle">
  <a href="javascript:arret()"><img src=<?php'../auth-photos/profil/'.$id.$image.'images.jpg'?> 
  id="Slide" name="Slide" alt="clic pour arreter"></a><br/>
  
  <a href="javascript:chgSlide(-1)"><b> << </b></a> &nbsp; 
  <script language="JavaScript">autoSlide('Slide')</script> &nbsp; 
  <a href="javascript:chgSlide(1)"><b> >> </b></a>



</body>
</html>
