document.addEventListener('DOMContentLoaded', function() {

    var slide = document.getElementById("photo_couv");
    h=slide.clientHeight;
    w=slide.clientHeight*2 +4;

    slide.children.item(0).setAttribute("width", w +"px");
    document.getElementById("top").style.height=h+20+"px";
    document.getElementById("top").style.width=w+13+"px";

    match=document.getElementsByClassName('rencontre');
    if(match.length>0){
      document.getElementById("fond_classement").style.height=360*(match.length/2+0.4) +"px";
    }

    actus=document.getElementsByClassName('actu');
    if(actus.length>=0 && actus.length<9){
      document.getElementById("actu_plus").style.display='none';
      document.getElementsByClassName("div_actu")[0].style.height=90+(635*(Math.ceil(actus.length/4)))+'px';
    }
});

function show_news(i){
  actu_c=document.getElementById('actu_'+i);
  actu_c.style.transform="scale(1.1,1.1)";
  actu_c.style.transition = "transform 0.3s linear";
}
  
function hide_news(i){

  actu_c=document.getElementById('actu_'+i);
  actu_c.style.transform="scale(1,1)";
  actu_c.style.transition = "transform 0.5s linear";
}

function plus_dactu(){

  actus=document.getElementsByClassName('actu');
  nbr_actu=actus.length;
  grille=document.getElementsByClassName('grille_actu')[0];
  global=document.getElementsByClassName("div_actu")[0];
  hauteur=global.clientHeight;

  actuJson=fetch("data/articles.json")
    .then(res=>res.json())
    .then(data=>{
      actuJson=JSON.stringify(data);
      const obj = JSON.parse(actuJson);
      len=obj.length;


      if(len>nbr_actu){

        global.style.height=hauteur+420+'px';
        indice=len-nbr_actu;
      
        for(let i=indice; (i>indice-4 && i>=0); i--){
          lien=document.createElement("a");
          lien.href="viewactualites.php?id="+obj[i].id;

          div=document.createElement("div");
          div.classList.add('actu');
          div.onmouseover=function(){show_news(i)};
          div.onmouseleave=function(){hide_news(i)};
          div.id='actu_'+i;

          img=document.createElement("div");
          img.classList.add('imgActu');
          img.style.background="url(img/"+obj[i].image_titre+") center no-repeat";

          p=document.createElement("p");
          p.classList.add("text_actu");

          span_titre=document.createElement("span");
          span_text=document.createElement("span");

          span_text.classList.add('apercu_actu');
          span_text.innerHTML=obj[i].texte.substr(0,150)+"...";

          span_titre.classList.add("titre_actu");
          span_titre.innerHTML=obj[i].titre.toUpperCase();

          p.appendChild(span_titre);
          p.appendChild(span_text);
          div.appendChild(img);
          div.appendChild(p);
          lien.appendChild(div);

          grille.appendChild(lien);
          if(i-1===0){
            document.getElementById("actu_plus").style.display='none';
          }
        }
      }
    });
}


function plus_dactu_m(){

  actus=document.getElementsByClassName('actu');
  nbr_actu=actus.length;
  grille=document.getElementsByClassName('grille_actu')[0];
  global=document.getElementsByClassName("div_actu_m")[0];
  hauteur=global.clientHeight;
  
  actuJson=fetch("../data/articles.json")
    .then(res=>res.json())
    .then(data=>{
      actuJson=JSON.stringify(data);
      const obj = JSON.parse(actuJson);
      len=obj.length;
  
  
      if(len>nbr_actu){
  
        global.style.height=hauteur+340+'px';
        indice=len-nbr_actu;
      
        for(let i=indice; (i>indice-3 && i>=0); i--){
          lien=document.createElement("a");
          lien.href="viewactualites.php?id="+obj[i].id;
  
          div=document.createElement("div");
          div.classList.add('actu');
          div.style.background="url(../img/"+obj[i].image_titre+") center no-repeat";
          div.onmouseover=function(){show_news(i)};
          div.onmouseleave=function(){hide_news(i)};
          div.id='actu_'+i;
          p=document.createElement("p");
          p.classList.add("text_actu");
  
          span_titre=document.createElement("span");
          span_text=document.createElement("span");
  
          span_text.classList.add('apercu_actu');
          span_text.innerHTML=obj[i].texte.substr(0,150)+"...";
  
          span_titre.classList.add("titre_actu");
          span_titre.innerHTML=obj[i].titre.toUpperCase();
  
          p.appendChild(span_titre);
          p.appendChild(span_text);
          div.appendChild(p);
          lien.appendChild(div);
  
          grille.appendChild(lien);
          if(i-1===0){
            document.getElementById("actu_plus").style.display='none';
          }
        }
      }
    });
}

/*
function supprActu(id){
  actuJson=fetch("/data/articles.json")
    .then(res=>res.json())
    .then(data=>{
      actuJson=JSON.stringify(data);
      const obj = JSON.parse(actuJson);
      
      obj.forEach(actu => {
        if(actu["id"]==id){
          console.log(actu["titre"]);
          unset(actu);
        }
      });

    });
}*/