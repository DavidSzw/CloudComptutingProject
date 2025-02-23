DROP DATABASE IF EXISTS effectif;
CREATE DATABASE effectif;
USE effectif;

CREATE TABLE cadets(
    id int PRIMARY KEY,
    photo VARCHAR(45),
    poste VARCHAR(25),
    nom VARCHAR(30),
    prenom VARCHAR(30)
);

CREATE TABLE juniors(
    id int PRIMARY KEY,
    photo VARCHAR(45),
    poste VARCHAR(25),
    nom VARCHAR(30),
    prenom VARCHAR(30)
);

CREATE TABLE seniors(
    id int PRIMARY KEY,
    photo VARCHAR(45),
    poste VARCHAR(25),
    nom VARCHAR(30),
    prenom VARCHAR(30)
);

CREATE TABLE dirigeants(
    id int PRIMARY KEY,
    photo VARCHAR(45),
    poste VARCHAR(25),
    nom VARCHAR(30),
    prenom VARCHAR(30)
);