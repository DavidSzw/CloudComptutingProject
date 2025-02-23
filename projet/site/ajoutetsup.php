<?php
// Fonction pour établir la connexion à la base de données
function connectDB() {
  $username = "new";
  $password = "1234AZer";
  $mysqli = new mysqli("localhost", $username, $password, "effectif");
  if ($mysqli->connect_errno) {
    die("Échec de la connexion à la base de données: " . $mysqli->connect_error);
  }
  return $mysqli;
}

// Fonction pour insérer un joueur dans la base de données
function ajouterJoueur($poste, $photoPath, $nom, $prenom, $cat) {
  $mysqli = connectDB();
  $stmt = $mysqli->prepare("INSERT INTO $cat (id, poste, photo, nom, prenom) VALUES ( ?, ?, ?, ?, ?)");
  if (!$stmt) {
    die("Échec de la préparation de la requête: " . $mysqli->error);
  }
  $id=rand();
  $stmt->bind_param("issss", $id, $poste, $photoPath, $nom, $prenom);
  if ($stmt->execute()) {
    echo "Le joueur a été ajouté avec succès.";
    header("Location: admin.php");
    exit();
  } else {
    echo "Une erreur s'est produite lors de l'ajout du joueur: " . $stmt->error;
  }
  $stmt->close();
  $mysqli->close();
}

// Fonction pour supprimer un joueur de la base de données
function supprimerJoueur($joueurId, $categorie) {
  $mysqli = connectDB();
  $stmt = $mysqli->prepare("SELECT photo FROM $categorie where id=?");

  if (!$stmt) {
    die("Échec de la préparation de la requête: " . $mysqli->error);
  }
  $stmt->bind_param("i", $joueurId);
  if ($stmt->execute()) {
    mysqli_stmt_bind_result($stmt, $photo);
    while (mysqli_stmt_fetch($stmt)) {
      unlink($photo);
    }
  }

  $stmt = $mysqli->prepare("DELETE FROM $categorie WHERE id = ?");
  echo"good";
  if (!$stmt) {
    die("Échec de la préparation de la requête: " . $mysqli->error);
  }
  $stmt->bind_param("i", $joueurId);
  if ($stmt->execute()) {
    echo "Le joueur $joueurId a été supprimé avec succès.";
  } else {
    echo "Une erreur s'est produite lors de la suppression du joueur: " . $stmt->error;
  }
  $stmt->close();
  $mysqli->close();
}

// Vérifier si le formulaire est soumis pour ajouter un joueur
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["poste"]) && isset($_FILES["photo"]) && isset($_POST["nom"]) && isset($_POST["prenom"])){
  if(isset($_GET['cat']) && $_GET['cat']=='dirigeants'){
    if($_POST["poste"]!="" && $_FILES["photo"]["name"]!="" && $_POST["nom"]!="" && $_POST["prenom"]!=""){
    
      $list_poste=["bureau", "dirigeants"];
      if(in_array($_POST["poste"], $list_poste)){
  
        $poste = str_replace(" ", "", $_POST["poste"]);
        $poste = str_replace("'", "", $poste);
        $photo = $_FILES["photo"];
        $nom=$_POST["nom"];
        $prenom=$_POST["prenom"];
  
        // Traiter le téléchargement de la photo
        $photoName = uniqid() . '_' . $photo["name"];
        $photoPath = "img/bdd/" . $photoName;
        move_uploaded_file($photo["tmp_name"], $photoPath);
  
        ajouterJoueur($poste, $photoPath,$nom, $prenom, $_GET["cat"]);
  
      }else{
        header('Location: dirigeants.php?error=poste');
        exit();
      }
    }else{
      header('Location: dirigeants.php?error=manque');
      exit();
    }

  }else{
    if($_POST["poste"]!="" && $_FILES["photo"]["name"]!="" && $_POST["nom"]!="" && $_POST["prenom"]!=""){
    
      $list_poste=["pilier", "talonneur", "deuxieme ligne", "troisieme ligne", "demi de melee", "demi d'ouverture", "centre", "ailier", "arriere", "staff"];
      if(in_array($_POST["poste"], $list_poste)){
  
        $poste = str_replace(" ", "", $_POST["poste"]);
        $poste = str_replace("'", "", $poste);
        $photo = $_FILES["photo"];
        $nom=$_POST["nom"];
        $prenom=$_POST["prenom"];
  
        // Traiter le téléchargement de la photo
        $photoName = uniqid() . '_' . $photo["name"];
        $photoPath = "img/bdd/" . $photoName;
        move_uploaded_file($photo["tmp_name"], $photoPath);
  
        if(isset($_FILES["details"])){
          $photoDetName = $prenom . $nom . ".png";
          $photoDetPath = "img/zoom_joueurs/" . $photoDetName;
          move_uploaded_file($_FILES["details"]["tmp_name"], $photoDetPath);
        }
  
        ajouterJoueur($poste, $photoPath,$nom, $prenom, $_GET["cat"]);
  
      }else{
        $cat=$_GET['cat'];
        header("Location: effectif.php?cat=$cat&error=poste");
        exit();
      }
    }else{
      $cat=$_GET['cat'];
      header("Location: effectif.php?cat=$cat&error=manque");
      exit();
    }
  }
}




// Vérifier si l'identifiant du joueur est passé pour le supprimer
if (isset($_POST["supprimer"]) && isset($_POST["cat"]) && is_numeric($_POST["supprimer"])) {
  $joueurId = $_POST["supprimer"];
  $categorie=$_POST["cat"];
  supprimerJoueur($joueurId, $categorie);
}
?>
