<?php
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
  
}else{
  header('Location: login.php');
}

if(isset($_GET['erreur']) && $_GET['erreur']=="ajout"){
  echo '<script type="text/javascript">';
  echo ' alert("Erreur lors de l`ajout. Remplissez bien tous les champs")';
  echo '</script>';
}

if(isset($_GET['actu']) && $_GET['actu']=="suppr"){
  echo '<script type="text/javascript">';
  echo ' alert("l`article a bien été supprimé!")';
  echo '</script>';
}
?>
<!DOCTYPE html>
<html>

    <head>
      <meta charset="utf-8">
      <title>S.A.Monein</title>
      <link rel="icon" type="image/x-icon" href="img/logo_club.png">
      <link href="https://fonts.cdnfonts.com/css/archivo-black" rel="stylesheet"> 
      <link href="https://fonts.cdnfonts.com/css/homemade-apple" rel="stylesheet">

      <style>

        body{
          font-family: 'Open Sans';
        }

        .joueur img{
          width: 70%;
        }

        .container_cat{
          display: grid;
          grid-template-columns: 20% 20% 20% 20% 20%;
        }

        .titrejuniors, .titreseniors, .titrecadets, .titredirigeants{
        }

        .formArt{
          height: 200px;
          display: flex;
          align-items: center;
        }

        .formArt textarea{
          height :80%;
          width:15%;
        }

        .formArt label{
          margin-left: 3%;
        }

        .backlink{
          display: flex;
          justify-content: space-between;
          width: 30%;
          margin-left: 10px;
          margin-top: 15px;
        }

        .backlink a{
          height:30px;
          border: 1px solid #06187a;
          border-radius: 5% / 50%;
          text-decoration: none;
          color: black;
        }

        .backlink p{
          text-align: center;
          margin-top: 3px;
          margin-left: 8px;
          margin-right: 8px;
        }

        .deco{
          display: block;
          margin-left: 10px;
          border: 1px solid #06187a;
          border-radius: 5% / 50%;
          height:25px;
          width: 150px;
          text-align: center;
          padding-top: 3px;
        }

        .deco a{
          text-decoration: none;
          color: black;
        }

        #pageTitre{
          text-align: center;
        }

        h4{
          margin-left: 100px;
          font-size: 23px;
        }

        .forms{
          margin-top: 120px;
        }

      </style>
    </head>
  <body>

    <div>
      <h1 id="pageTitre">PORTAIL ADMINISTRATEUR</h3>
      <span class="deco">
        <a href="deconnexion.php"> se déconnecter</a>
      </span>
      <div class="backlink">
        <a href='actualites.php'><p>retour à Actualités</p></a>

        <a href='effectif.php'><p>retour à effectif</p></a>
        <a href='accueil.php'><p>retour à Accueil</p></a>
      </div>
    </div>

    <div>
      <p id="confirmation">

      </p>
    </div>

    <div class="joueurs_container">
      <?php
      //mettre à jour la requete ajax pour supprimer de l interface

      // Récupérer la liste des joueurs depuis la base de données
      // Effectuer les opérations de lecture dans votre base de données pour obtenir les joueurs
      // Connexion à la base de données
      $mysqli = new mysqli("localhost", "new", "1234AZer", "effectif");

      // Vérifier la connexion
      if ($mysqli->connect_errno) {
          // Gestion de l'erreur de connexion
          die("Échec de la connexion à la base de données: " . $mysqli->connect_error);
      }

      $cats=['seniors', 'juniors', 'cadets', 'dirigeants'];

      foreach($cats as $cat){
        // Récupérer les joueurs
        $result = $mysqli->query("SELECT id, poste, photo FROM $cat ORDER BY nom");
        echo "<h3 id=titre$cat onclick=afficherEff('$cat',0)>Afficher effectif $cat</h3>";
        echo "<div class='container_cat' id='container_$cat' style='display:none'>";
        
        // Vérifier si des joueurs ont été trouvés
        if ($result->num_rows > 0) {
          // Afficher les joueurs
          while ($joueur = $result->fetch_assoc()) {
              echo '<div class="joueur" id="'.$joueur['id'].'">';
              echo '<img src="' . $joueur["photo"] . '" alt="' . $joueur["poste"] . '">';
              echo "<button onclick=supprimerJoueur($joueur[id],'$cat')>Supprimer</button>";
              echo '</div>';
          }
      } else {
          echo 'Aucun joueur trouvé.';
      }
      echo"</div>";

      }

      // Fermer la connexion à la base de données
      $result->close();
      $mysqli->close();
      ?>
    </div>

    <div class="forms">
    <h4>Ajouter une actualités</h4>
    <form action="ajoutarticle.php" method="POST" enctype="multipart/form-data"  class="formArt">
      <label for="titre">Titre :</label>
      <input type="text" name="titre" id="titre" required oninvalid="this.setCustomValidity(`Entrez un titre!`)" oninput="setCustomValidity(``)">
      <label for="texte">Texte :</label>
      <textarea name="texte" id ="texte" required oninvalid="this.setCustomValidity(`Entrez un texte!`)" oninput="setCustomValidity(``)"></textarea>

      <label for="image_titre">Image illustration :</label>
      <input type="file" name="image_titre" id="image_titre" required oninvalid="this.setCustomValidity(`Entrez une image pour illustrer l'article!`)" oninput="setCustomValidity(``)">


      <label for="images">Image :</label>
      <input type="file" name="images[]" id="images[]" multiple="multiple"/>
        
      <input type="submit" value="Publier article">
    </form>

    <h4>Ajouter des photos à la gallerie</h4>
    <form action="ajoutarticle.php" method="POST" enctype="multipart/form-data">

      <label for="gallerie">Ajouter des photos :</label>
      <input type="file" name="gallerie[]" id="gallerie[]" multiple="multiple" required oninvalid="this.setCustomValidity(`Entrez une image au minimum!`)" oninput="setCustomValidity(``)"/>
        
      <input type="submit" value="Ajouter à la gallerie">
    </form>
    </div>

  <script>
    function supprimerJoueur(joueurId, cat) {
      // Envoyer une requête AJAX pour supprimer le joueur en utilisant le joueurId
      console.log(cat);
      aSupprimer=document.getElementById(joueurId);
      conf=document.getElementById("confirmation");
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'ajoutetsup.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            aSupprimer.remove();
            conf.innerHTML="Le joueur a bien été supprimé";
          } else {
            conf.innerHTML="Erreur lors de la suppression du joueur";
          }
        }
      };
      xhr.send('supprimer=' + joueurId + '&cat='+cat);
    }

    function afficherEff(cat){
      cont=document.getElementById('container_'+cat);
      if(cont.style.display=="none"){
        document.getElementById('titre'+cat).innerText="Masquer effectif "+cat;
        document.getElementById('container_'+cat).style.display="grid";
      }else{
        document.getElementById('titre'+cat).innerText="Afficher effectif "+cat;
        document.getElementById('container_'+cat).style.display="none";
      }
    }
  </script>

  </body>
</html>
