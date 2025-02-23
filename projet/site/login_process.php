<?php 

// Ajouter la protection contre le Clickjacking
header("X-Frame-Options: SAMEORIGIN");

// Ajouter le Content Security Policy (CSP)
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'");

// Activer le X-XSS-Protection
header("X-XSS-Protection: 1; mode=block");

// Activer le X-Content-Type-Options
header("X-Content-Type-Options: nosniff");

session_start();

// Vérifier si le formulaire de connexion est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifier le token CSRF
    $token = $_POST['token']; // Vous devez générer ce token côté client et l'inclure dans chaque requête

    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        header("Location : login.php");
        die("Token CSRF invalide.");
        
    }

    // Récupérer les identifiants de l'utilisateur
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST["password"];

    // Connexion à la base de données (utilisation de variables d'environnement)
    $db_host = "localhost";
    $db_name = "login";
    $db_user = "new";
    $db_pass = "1234AZer";

    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données");
    }

    // Vérifier si l'adresse IP de l'utilisateur existe dans la table des utilisateurs bloqués
    $query = "SELECT * FROM utilisateurs_bloques WHERE ip_address = :ip_address";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['ip_address' => $_SERVER['REMOTE_ADDR']]);
    $blocked_user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Restaurer l'accès pour les personnes bloquées après la période de blocage
    if ($blocked_user && strtotime($blocked_user['blocked_until']) <= time()) {
        $username = $_POST["username"];
        $query = "UPDATE utilisateurs_bloques SET blocked_until = NULL WHERE ip_address = :ip_address";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['ip_address' => $_SERVER['REMOTE_ADDR']]);
    }

    if ($blocked_user && strtotime($blocked_user['blocked_until']) > time()) {
        // L'adresse IP de l'utilisateur est bloquée jusqu'à une date future, afficher un message d'erreur
        $timeRemaining = strtotime($blocked_user['blocked_until']) - time();
        echo "Votre adresse IP est bloquée en raison de trop de tentatives infructueuses. Veuillez réessayer après " . gmdate("i:s", $timeRemaining) . ".";
        exit;
    }

    // Vérifier les identifiants de l'administrateur dans la base de données
    $query = "SELECT * FROM utilisateurs WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Authentification réussie, définir la session de l'administrateur
        $_SESSION["role"] = "admin";

        // Réinitialiser le nombre de tentatives infructueuses et l'heure de la dernière tentative pour cette adresse IP
        $query = "DELETE FROM utilisateurs_bloques WHERE ip_address = :ip_address";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['ip_address' => $_SERVER['REMOTE_ADDR']]);

        // Réinitialiser le nombre de tentatives infructueuses et l'heure de la dernière tentative pour cet utilisateur
        $query = "UPDATE utilisateurs_bloques SET login_attempts = 0, last_login_attempt = NULL WHERE ip_address = :ip_address";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['ip_address' => $_SERVER['REMOTE_ADDR']]);

        // Rediriger vers la page d'administration
        header("Location: admin.php");
        exit;
    } else {
        // Identifiants invalides, afficher un message d'erreur générique
        echo "Identifiants invalides. Veuillez réessayer.";

        if ($blocked_user) {
            // L'adresse IP de l'utilisateur est déjà bloquée, mise à jour du compteur de tentatives infructueuses
            $query = "UPDATE utilisateurs_bloques SET login_attempts = login_attempts + 1, last_login_attempt = :last_login_attempt WHERE ip_address = :ip_address";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['last_login_attempt' => date('Y-m-d H:i:s'), 'ip_address' => $_SERVER['REMOTE_ADDR']]);
        } else {
            // L'adresse IP de l'utilisateur n'est pas encore bloquée, l'ajouter à la table
            $query = "INSERT INTO utilisateurs_bloques (ip_address, login_attempts, last_login_attempt) VALUES (:ip_address, 1, :last_login_attempt)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['ip_address' => $_SERVER['REMOTE_ADDR'], 'last_login_attempt' => date('Y-m-d H:i:s')]);
        }

        // Vérifier le nombre de tentatives infructueuses pour l'adresse IP
        $maxAttempts = 5;
        if ($blocked_user['login_attempts'] + 1 >= $maxAttempts) {
            // Bloquer la personne qui essaie de se connecter pour une durée de 5 minutes
            $blockedUntil = strtotime("+5 minutes");
            $query = "UPDATE utilisateurs_bloques SET blocked_until = :blocked_until WHERE ip_address = :ip_address";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['blocked_until' => date('Y-m-d H:i:s', $blockedUntil), 'ip_address' => $_SERVER['REMOTE_ADDR']]);
        }

        header("Location: login.php?error=inc");
        exit;
    }
}

// Fonction pour hacher le mot de passe avec Argon2id
function hashPassword($password) {
    // Utiliser l'algorithme de hachage Argon2id
    $options = [
        'memory_cost' => 1 << 16, // 64 MB
        'time_cost' => 4,
        'threads' => 2,
    ];
    $hashedPassword = password_hash($password, PASSWORD_ARGON2ID, $options);
    return $hashedPassword;
}
/*
// Générer un nouveau token CSRF
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;

// Insérer l'utilisateur admin avec le mot de passe haché dans la base de données
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username_admin = "admin";
    $password_admin = "mot_de_passe_admin"; // Générez un mot de passe fort aléatoire pour l'administrateur

    // Hacher le mot de passe avec Argon2id avant l'insertion dans la base de données
    $hashed_password_admin = hashPassword($password_admin);

    // Insérer l'utilisateur admin dans la table utilisateurs en utilisant une requête préparée
    $query = "INSERT INTO utilisateurs (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['username' => $username_admin, 'password' => $hashed_password_admin]);

    echo "Utilisateur admin créé avec succès.";

} catch (PDOException $e) {
    echo htmlspecialchars("Erreur lors de la création de l'utilisateur admin : " . $e->getMessage());
}
*/

?>





















