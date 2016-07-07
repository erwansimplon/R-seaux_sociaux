
slide = new Array('../auth-photos/profil/'.$id.$image.'images.jpg)

//changement manuel
slide_manuel = 0
img = slide.length - 1
function chgSlide(direction) {
  if (document.images) {
     slide_manuel = slide_manuel + direction
     if (slide_manuel > img) {
        slide_manuel = 0
     }
     if (slide_manuel < 0) {
        slide_manuel = img
     }
     document.Puzzle.src = slide[slide_manuel]
  }
}

//changement automatique
//vitesse de defilement en milliseconds
speed = 1000;
i = 0;
function autoSlide(imgname) {
  if (document.images)
  {
    document.getElementById(imgname).src = slide[i];
    i++;
    if (i > slide.length-1) i = 0;
    b=imgname;
    objet_timer = setTimeout('autoSlide(b)',speed);
  }
}

//arreter le defilement
function arret() {
	clearTimeout(objet_timer);
}


//prechargement des images de Dreamweaver
function preload() { //v3.0
  var d=document; if(d.images){
    if(!d.img_chargement) d.img_chargement=new Array();
  var i,j=d.img_chargement.length,a=preload.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.img_chargement[j]=new Image; d.img_chargement[j++].src=a[i];}
  }
}
