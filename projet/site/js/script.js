document.addEventListener('DOMContentLoaded', function() {
  var match=document.getElementsByClassName("affiche");
  var nbr_match=match.length;
  
  if(match[0].style.display!="none"){
    document.getElementById("fleche_calendrier_gauche").style.display="none";
  }else{
    if(match[nbr_match-1].style.display!="none"){
      document.getElementById("fleche_calendrier_droite").style.display="none";
    }
  }

  var slide = document.getElementsByClassName("slide");

  width=slide[0].clientHeight*2 +4;
  var_height=slide[0].clientHeight;
  for(i=0;i<5;i++){
    slide[i].children.item(0).setAttribute("width", width+"px");
  }

  document.getElementById("top").style.height=var_height+20+"px";
  document.getElementById("top").style.width=width+13+"px";
  
  /*

  actu_h=document.getElementsByClassName("actualite")[0].clientHeight;
  actu_mt=document.getElementsByClassName("actualite")[0].offsetTop - var_height+60;

  document.getElementById("classement").style.height= actu_h + actu_mt + "px";*/

});


function previous_game(){
  var match=document.getElementsByClassName("affiche");
  var nbr_match=match.length;
  
  for(var i=0; i<nbr_match; i++){
    if(match[i].style.display!="none" && i!=0){
      match[i-1].style.display="block";
      match[i].style.display="none";
      if(i==1){
        document.getElementById("fleche_calendrier_gauche").style.display="none";
      }else{
        if(i==nbr_match-1){
          document.getElementById("fleche_calendrier_droite").style.display="flex";
        }
      }
    }
  }
}

function next_game(){
  var match=document.getElementsByClassName("affiche");
  var nbr_match=match.length;
  
  for(var i=nbr_match-1; i>=0; i--){
    if(match[i].style.display!="none" && i!=nbr_match-1){
      match[i+1].style.display="block";
      match[i].style.display="none";
      if(i==nbr_match-2){
        document.getElementById("fleche_calendrier_droite").style.display="none";
      }else{
        if(i==0){
          document.getElementById("fleche_calendrier_gauche").style.display="flex";
        }
      }
    }
  }
}

function show_news(i){
  actu_c=document.getElementsByClassName("actu_content")[0].children;
  actu_c[i].style.transform="scale(1.1,1.1)";
  actu_c[i].style.transition = "transform 0.5s";
}

function hide_news(i){

  actu_c=document.getElementsByClassName("actu_content")[0].children;
  actu_c[i].style.transform="scale(1,1)";
  actu_c[i].style.transition = "transform 0.5s";
}

var slides = document.getElementsByClassName("slide");
var currentSlide = 0;

function showSlide() {

  var previousSlide = currentSlide;
  currentSlide = (currentSlide + 1) % slides.length;

  slides[currentSlide].style.display="none";

  

  setTimeout(function() {
    

    slides[currentSlide].style.transform = "translateX(100%)";
    slides[currentSlide].style.display = "block";

    setTimeout(function() {


      slides[currentSlide].style.transform = "translateX(0%)";
      slides[currentSlide].style.transition = "transform 0.9s";

      slides[previousSlide].style.transform = "translateX(-100%)";
      slides[previousSlide].style.transition = "transform 0.9s";

     
    }, 1000);
  }, 1000);
  
}


setInterval(showSlide, 5000);

