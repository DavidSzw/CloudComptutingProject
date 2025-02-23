
document.addEventListener('DOMContentLoaded', function() {

    document.getElementById("defilement_sponso2").style.transform = "translateX(100%)";
    document.getElementById("defilement_sponso3").style.transform = "translateX(200%)";
    slideSponso();
});

document.addEventListener('scroll', function () {

    const header=document.querySelectorAll('.onglet');
    if(header.length!=0){
      header[0].classList.toggle('sticky', window.scrollY>100);
    }
});


function slideSponso(){

  var sponsor=document.getElementsByClassName("defilement")[0];
  sponsor.style.transform = "translateX(0%)";   
  sponsor.style.transition = "transform 0.01s linear";
  sponsor.style.display='flex';
  if(handleVisibilityChange()==-1){
    setTimeout(function(){
      slideSponso();
    },1000);  
    

  }else{
  
    setTimeout(function(){
      sponsor.style.transform = "translateX(-200%)";   
      sponsor.style.transition = "transform 120s linear";

      setTimeout(function(){
        sponsor.style.display="none";
        slideSponso();
      },120000)
    },1000);
  }
}

var hidden, visibilityChange;
if (typeof document.hidden !== "undefined") { // Opera 12.10 and Firefox 18 and later support
  hidden = "hidden";
  visibilityChange = "visibilitychange";
} else if (typeof document.msHidden !== "undefined") {
  hidden = "msHidden";
  visibilityChange = "msvisibilitychange";
} else if (typeof document.webkitHidden !== "undefined") {
  hidden = "webkitHidden";
  visibilityChange = "webkitvisibilitychange";
}

function handleVisibilityChange() {

  if (document.hidden) {
    return (-1);
  } else {
    return(1);
  }
}


function afficher_onglet(id){
  
  deroulant=document.getElementById(id+"_m");
  document.getElementById(id).classList.toggle("menu_link_aff");
  document.getElementById(id).classList.toggle("menu_link");
  if(deroulant.style.display=="block"){
    deroulant.style.display="none";
  }else{
    deroulant.style.display="block";
  }

}