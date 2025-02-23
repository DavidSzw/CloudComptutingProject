
-- Création de la base de données (remplacez "votre_base_de_donnees" par le nom souhaité)
CREATE DATABASE login;

-- Utilisation de la base de données
USE login;

-- Création de la table "utilisateurs"
CREATE TABLE utilisateurs (
    id int PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE utilisateurs_bloques (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(255) NOT NULL,
    login_attempts INT NOT NULL DEFAULT 0,
    last_login_attempt DATETIME,
    blocked_until DATETIME
);

-- Insertion de l'utilisateur "admin" avec le mot de passe haché et les valeurs par défaut
INSERT INTO utilisateurs (username, password) VALUES ('admin', '$argon2id$v=19$m=65536,t=4,p=2$MW5zVHdKaGlXM3Z0ejZxNg$pcMv5mAuyyFeIqEJGEfSVCo80wm71qXhXH1S80D/CL0');
