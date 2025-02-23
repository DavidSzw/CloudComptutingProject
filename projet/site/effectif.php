<?php
session_start();

// Connexion sécurisée à la base de données
function connectDB() {
    $host = "db"; // Nom du service MySQL dans Docker
    $db = "mydb"; // Nom de la base dans db.sql
    $user = "user";
    $pass = "password";
    $charset = "utf8mb4";
    $port = "3306"; // Port par défaut de MySQL
    
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}

// Validation de la catégorie
$valid_categories = ['seniors', 'juniors', 'cadets']; // Toutes les catégories de db.sql
$categorie = isset($_GET['cat']) && in_array($_GET['cat'], $valid_categories) 
    ? $_GET['cat'] 
    : 'seniors';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>S.A.Monein - <?php echo htmlspecialchars($categorie); ?></title>
    <link rel="icon" type="image/x-icon" href="img/logo_club.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style_haut_bas.css"/>
    <link rel="stylesheet" href="css/style_classement.css"/>
    <link href="https://fonts.cdnfonts.com/css/archivo-black" rel="stylesheet"> 
    <link href="https://fonts.cdnfonts.com/css/homemade-apple" rel="stylesheet">
    <style>
        .effectif {
            display: flex;
            flex-wrap: wrap;
            justify-content: left;
        }

        .poste {
            margin: 8px;
            text-align: center;
            font-weight: bold;
        }
        
        .poste button:hover {
            transform: scale(1.165);
        }

        .poste button {
            background-color: #3f4e87;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 15px;
            font-family: "Open Sans", sans-serif;
            color: #ffffff;
            font-weight: bold;
        }

        .joueurs {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .effectif-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .effectif-table th, .effectif-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .effectif-table th {
            background-color: #3f4e87;
            color: white;
        }

        .effectif-table img {
            width: 100px;
            height: auto;
            cursor: pointer;
        }

        .affJoueur {
            display: table-row;
        }

        .hideJoueur {
            display: none;
        }

        .blur {
            filter: blur(30px);
        }

        #zoom {
            position: fixed;
            z-index: 2;
            height: 100%;
            width: 100%;
            top: 0;
            display: none;
        }

        #zoom_haut {
            position: fixed;
            height: 20%;
            width: 100%;
            top: 0;
        }

        #zoom_bas {
            position: fixed;
            height: 20%;
            width: 100%;
            bottom: 0;
        }

        #zoom_joueur {
            position: fixed;
            z-index: 3;
            display: none;
            top: 20%;
            width: 100%;
        }

        #zoom_joueur img {
            width: 95%;
            margin-left: 2.5%;
            margin-right: 2.5%;
        }

        .category-nav {
            margin: 20px 0;
            text-align: center;
        }

        .category-nav a {
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #3f4e87;
            color: white;
            text-decoration: none;
            border-radius: 15px;
            font-family: "Open Sans", sans-serif;
        }

        .category-nav a:hover {
            background-color: #2a365f;
        }
    </style>

    <script type="text/javascript" src="js/script_haut_bas.js"></script>
    <script type="text/javascript" src="js/script_classement.js"></script>
</head>
<body>
    <div id="top" class="global">
        <div class="caroussel">
            <?php include('image.php'); ?>
        </div>
        <?php include('haut_de_page.html'); ?>
    </div>

    <!-- Navigation entre catégories -->
    <div class="category-nav global">
        <a href="?cat=seniors">Seniors</a>
        <a href="?cat=juniors">Juniors</a>
        <a href="?cat=cadets">Cadets</a>
    </div>

    <div class="effectif global">
        <div class="poste"><button onclick="showPlayers('pilier')">Piliers</button></div>
        <div class="poste"><button onclick="showPlayers('talonneur')">Talonneurs</button></div>
        <div class="poste"><button onclick="showPlayers('deuxiemeligne')">Deuxièmes lignes</button></div>
        <div class="poste"><button onclick="showPlayers('troisiemeligne')">Troisièmes lignes</button></div>
        <div class="poste"><button onclick="showPlayers('demidemelee')">Demis de mêlée</button></div>
        <div class="poste"><button onclick="showPlayers('demidouverture')">Demis d'ouverture</button></div>
        <div class="poste"><button onclick="showPlayers('centre')">Centres</button></div>
        <div class="poste"><button onclick="showPlayers('ailier')">Ailiers</button></div>
        <div class="poste"><button onclick="showPlayers('arriere')">Arrières</button></div>
        <div class="poste"><button onclick="showPlayers('staff')">Staff</button></div>
    </div>

    <div class="joueurs global" id="joueursContainer">
        <?php
        $pdo = connectDB();
        
        try {
            $stmt = $pdo->prepare("SELECT id, photo, poste, nom, prenom FROM `$categorie`");
            $stmt->execute();
            
            echo "<h2>Liste des " . htmlspecialchars($categorie) . "</h2>";
            echo "<table class='effectif-table'>";
            echo "<tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Poste</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                  </tr>";
            
            while ($row = $stmt->fetch()) {
                $name = htmlspecialchars($row['prenom'] . $row['nom']);
                echo "<tr class='joueur " . htmlspecialchars($row['poste']) . " affJoueur'";
                echo " onclick='affDetailsJoueur(\"$name\")'";
                echo ">";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td><img src='" . htmlspecialchars($row['photo']) . "' alt='Photo de " . htmlspecialchars($row['prenom']) . "'></td>";
                echo "<td>" . htmlspecialchars($row['poste']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } catch (PDOException $e) {
            echo "<p>Erreur lors de la récupération des données : " . htmlspecialchars($e->getMessage()) . "</p>";
        }
        $pdo = null; // Fermeture explicite de la connexion
        ?>
    </div>

    <?php 
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        echo "<div class='global'>";
        echo "<form action='ajoutetsup.php?cat=" . urlencode($categorie) . "' method='POST' enctype='multipart/form-data'>";
        echo '<label for="poste">Poste :</label>';
        echo '<input type="text" name="poste" id="poste" required oninvalid="this.setCustomValidity(`Entrez un poste!`)" oninput="this.setCustomValidity(``)">';
        echo '<label for="nom">Nom :</label>';
        echo '<input type="text" name="nom" id="nom" required oninvalid="this.setCustomValidity(`Entrez un nom!`)" oninput="this.setCustomValidity(``)">';
        echo '<label for="prenom">Prénom :</label>';
        echo '<input type="text" name="prenom" id="prenom" required oninvalid="this.setCustomValidity(`Entrez un prénom!`)" oninput="this.setCustomValidity(``)">';
        echo '<label for="photo">Photo :</label>';
        echo '<input type="file" name="photo" id="photo" required oninvalid="this.setCustomValidity(`Entrez une photo!`)" oninput="this.setCustomValidity(``)">';
        echo '<label for="details">Photo détaillée :</label>';
        echo '<input type="file" name="details" id="details" required oninvalid="this.setCustomValidity(`Entrez une photo!`)" oninput="this.setCustomValidity(``)">';
        echo '<input type="submit" value="Ajouter joueur">';
        echo '</form>';
        echo "</div>";
    }

    include('bas_de_page.html');

    if (isset($_GET["error"])) {
        $message = $_GET["error"] === "manque" 
            ? "Veuillez remplir tous les champs!"
            : "Veuillez rentrer un poste valide (en minuscules, au singulier et sans accent)!";
        echo "<script>alert('" . htmlspecialchars($message) . "');</script>";
    }
    ?>

    <div id="zoom">
        <div id="zoom_haut" onclick="cacher()"></div>
        <div id="zoom_joueur"></div>
        <div id="zoom_bas" onclick="cacher()"></div>
    </div>

    <script>
        function showPlayers(poste) {
            const joueurs = document.querySelectorAll('.joueur');
            joueurs.forEach(elmt => {
                if (elmt.classList.contains('affJoueur')) {
                    elmt.classList.remove('affJoueur');
                    elmt.classList.add('hideJoueur');
                }
                if (elmt.classList.contains(poste)) {
                    elmt.classList.remove('hideJoueur');
                    elmt.classList.add('affJoueur');
                }
            });
        }

        function affDetailsJoueur(nom) {
            const globals = document.querySelectorAll('.global');
            const divAff = document.getElementById("zoom_joueur");
            document.getElementById("zoom").style.display = 'block';
            const bande = document.createElement('img');
            bande.src = "img/zoom_joueurs/" + nom + ".png";
            bande.alt = nom;
            bande.classList.add("img_detail");
            divAff.appendChild(bande);
            divAff.style.display = 'block';
            globals.forEach(item => item.classList.add('blur'));
        }

        function cacher() {
            const globals = document.querySelectorAll('.global');
            const divAff = document.getElementById("zoom_joueur");
            const imgDet = divAff.querySelector(".img_detail");
            document.getElementById("zoom").style.display = 'none';
            divAff.style.display = 'none';
            if (imgDet) divAff.removeChild(imgDet);
            globals.forEach(item => item.classList.remove('blur'));
        }
    </script>
</body>
</html>