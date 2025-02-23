USE mydb;

CREATE TABLE IF NOT EXISTS seniors (
    id INT PRIMARY KEY,
    photo VARCHAR(255),
    poste VARCHAR(50),
    nom VARCHAR(100),
    prenom VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS juniors (
    id INT PRIMARY KEY,
    photo VARCHAR(255),
    poste VARCHAR(50),
    nom VARCHAR(100),
    prenom VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS cadets (
    id INT PRIMARY KEY,
    photo VARCHAR(255),
    poste VARCHAR(50),
    nom VARCHAR(100),
    prenom VARCHAR(100)
);

INSERT INTO seniors (`id`, `photo`, `poste`, `nom`, `prenom`) VALUES (26598578,'img/bdd/649e8f7eea8e2_juliencuyala.png','ailier','Cuyala','Julien'),
(36010808,'img/bdd/649e8dbf98f56_sylvainboucau.png','demidouverture','Boucau','Sylvain'),
(154292882,'img/bdd/649e8c140a2ad_romainlapassade.png','troisiemeligne','Lapassade','Romain'),
(377346079,'img/bdd/649e87513af9d_alexislabourdette.png','pilier','Labourdette','Alexis'),
(459553480,'img/bdd/649e8ba55ea6f_kevinreynaud.png','troisiemeligne','Reynaud','Kevin'),
(512078856,'img/bdd/649e8c32f2d12_clementbesse.png','troisiemeligne','Besse','Clement'),
(557566080,'img/bdd/649dc68b781c5_thomasfourtine.png','arriere','Fourtine','Thomas'),
(577284773,'img/bdd/649e887cddb61_remiportelaborde.png','pilier','Porte-Laborde','Remi'),
(614605144,'img/bdd/649e8ede69b76_mickaelmarques.png','centre','Marques','Mickael'),
(623528061,'img/bdd/649e892096549_stephenpoussier.png','talonneur','Poussier','Stephen'),
(637465210,'img/bdd/649dc54384568_anthonybordenave.png','arriere','Bordenave','Anthony'),
(641893028,'img/bdd/649e8abc16b43_nicolaspomme.png','deuxiemeligne','Pomme','Nicolas'),
(664976529,'img/bdd/649e8d35aaf87_gabriellasserre.png','demidemelee','Lasserre','Gabriel'),
(721633873,'img/bdd/649e8b10dcb48_matheohourgras.png','deuxiemeligne','Hourgras','Matheo'),
(732180683,'img/bdd/649e8eb5eabc7_theogarcia.png','centre','Garcia','Theo'),
(776768285,'img/bdd/649e8c961c345_remietcheverry.png','troisiemeligne','Etcheverry','Remi'),
(842469567,'img/bdd/649e8bfd55cf8_theolauilhe.png','troisiemeligne','Lauilhe','Theo'),
(859617143,'img/bdd/649e8c7653bee_enzobertranet.png','troisiemeligne','Bertranet','Enzo'),
(862463773,'img/bdd/649e8bc0d889e_pirricklacassy.png','troisiemeligne','Lacassy','Pierrick'),
(906180196,'img/bdd/649e876ac92d5_davidcommenges.png','pilier','Commenges','David'),
(922865296,'img/bdd/649e8f1e497cc_peioetchart.png','ailier','Etchart','Peio'),
(982404354,'img/bdd/649e8aa69e027_maximesoler.png','deuxiemeligne','Soler','Maxime'),
(1001957709,'img/bdd/649e8ad5d8ffd_remilabarthe.png','deuxiemeligne','Labarthe','Remi'),
(1053939860,'img/bdd/649e8a4d72504_baptistesarthou.png','talonneur','Sarthou-Garris','Baptiste'),
(1088790592,'img/bdd/649e8e5722b68_guillaumebiscar.png','centre','Biscar','Guillaume'),
(1230454254,'img/bdd/649e898959bbb_christophepereira.png','talonneur','Pereira','Christophe'),
(1242747894,'img/bdd/649e883307437_theomaurice.png','pilier','Maurice','Theo'),
(1334411357,'img/bdd/649e8c4fcc126_gregoireolympie.png','troisiemeligne','Olympie','Gregoire'),
(1373712511,'img/bdd/649e879021035_anthonycommenges.png','pilier','Commenges','Anthony'),
(1511675696,'img/bdd/649e8cb24f2a2_maximeescudero.png','troisiemeligne','Escudero','Maxime'),
(1522324302,'img/bdd/649e8bdcab0f3_thomasdomecq.png','troisiemeligne','Domecq','Thomas'),
(1530956774,'img/bdd/649e890283278_kevindessa.png','talonneur','Dessa','Kevin'),
(1556135078,'img/bdd/649e8f9ca126a_dylandefaye.png','ailier','Defaye','Dylan'),
(1687133213,'img/bdd/649e8d1f40033_baptistebloemzaad.png','demidemelee','Bloemzaad','Baptiste'),
(1757485048,'img/bdd/649e8b786b282_osirismassetat.png','deuxiemeligne','Massetat','Osiris'),
(1803148427,'img/bdd/649e8b4b8b41d_offelamicq.png','deuxiemeligne','Lamicq','Offe'),
(1853197780,'img/bdd/649e8f510df6d_enzopoirier.png','ailier','Poirier','Enzo'),
(1951194027,'img/bdd/649e8e9c146c0_floriansoler.png','centre','Soler','Florian'),
(1962401971,'img/bdd/649e8f68944a3_gwendallediscot.png','ailier','Lediscot','Gwendal'),
(2012238560,'img/bdd/649e8d06ec5a7_baptistecamet.png','demidemelee','Camet','Baptiste'),
(2028855069,'img/bdd/649e8f3a5454c_zacharieverdier.png','ailier','Verdier','Zacharie'),
(2111915116,'img/bdd/649e87ce5723f_theolailhacar.png','pilier','Lailhacar','Theo');

INSERT INTO juniors (`id`, `photo`, `poste`, `nom`, `prenom`) VALUES 
(30000001, 'img/bdd/junior_001.png', 'pilier', 'Moreau', 'Lucas'),
(30000002, 'img/bdd/junior_002.png', 'talonneur', 'Petit', 'Noah'),
(30000003, 'img/bdd/junior_003.png', 'deuxiemeligne', 'Leroy', 'Ethan'),
(30000004, 'img/bdd/junior_004.png', 'troisiemeligne', 'Roux', 'Hugo'),
(30000005, 'img/bdd/junior_005.png', 'demidemelee', 'Girard', 'Léo'),
(30000006, 'img/bdd/junior_006.png', 'demidouverture', 'Fournier', 'Théo'),
(30000007, 'img/bdd/junior_007.png', 'centre', 'Blanc', 'Mathis'),
(30000008, 'img/bdd/junior_008.png', 'ailier', 'Dupuis', 'Elias'),
(30000009, 'img/bdd/junior_009.png', 'arriere', 'Gauthier', 'Raphaël'),
(30000010, 'img/bdd/junior_010.png', 'pilier', 'Lemoine', 'Tom'),
(30000011, 'img/bdd/junior_011.png', 'talonneur', 'Barbier', 'Jules'),
(30000012, 'img/bdd/junior_012.png', 'deuxiemeligne', 'Caron', 'Nathan'),
(30000013, 'img/bdd/junior_013.png', 'troisiemeligne', 'Renaud', 'Louis'),
(30000014, 'img/bdd/junior_014.png', 'demidemelee', 'Dufour', 'Axel'),
(30000015, 'img/bdd/junior_015.png', 'demidouverture', 'Perrin', 'Evan'),
(30000016, 'img/bdd/junior_016.png', 'centre', 'Lefèvre', 'Timéo'),
(30000017, 'img/bdd/junior_017.png', 'ailier', 'Berger', 'Enzo'),
(30000018, 'img/bdd/junior_018.png', 'arriere', 'Marchand', 'Gabin'),
(30000019, 'img/bdd/junior_019.png', 'pilier', 'Clement', 'Sacha'),
(30000020, 'img/bdd/junior_020.png', 'talonneur', 'Roy', 'Liam');

INSERT INTO cadets (`id`, `photo`, `poste`, `nom`, `prenom`) VALUES 
(40000001, 'img/bdd/cadet_001.png', 'pilier', 'Lacroix', 'Matéo'),
(40000002, 'img/bdd/cadet_002.png', 'talonneur', 'Faure', 'Arthur'),
(40000003, 'img/bdd/cadet_003.png', 'deuxiemeligne', 'Vidal', 'Kylian'),
(40000004, 'img/bdd/cadet_004.png', 'troisiemeligne', 'Benoit', 'Victor'),
(40000005, 'img/bdd/cadet_005.png', 'demidemelee', 'Guillot', 'Malo'),
(40000006, 'img/bdd/cadet_006.png', 'demidouverture', 'Pascal', 'Adam'),
(40000007, 'img/bdd/cadet_007.png', 'centre', 'Rey', 'Noé'),
(40000008, 'img/bdd/cadet_008.png', 'ailier', 'Colin', 'Eliott'),
(40000009, 'img/bdd/cadet_009.png', 'arriere', 'Bailly', 'Samuel'),
(40000010, 'img/bdd/cadet_010.png', 'pilier', 'Joly', 'Maël'),
(40000011, 'img/bdd/cadet_011.png', 'talonneur', 'Brunet', 'Yanis'),
(40000012, 'img/bdd/cadet_012.png', 'deuxiemeligne', 'Fabre', 'Diego'),
(40000013, 'img/bdd/cadet_013.png', 'troisiemeligne', 'Gomez', 'Tristan'),
(40000014, 'img/bdd/cadet_014.png', 'demidemelee', 'Lopes', 'Loris'),
(40000015, 'img/bdd/cadet_015.png', 'demidouverture', 'Riviere', 'Nolan'),
(40000016, 'img/bdd/cadet_016.png', 'centre', 'Millet', 'Isaac'),
(40000017, 'img/bdd/cadet_017.png', 'ailier', 'Bourgeois', 'Ruben'),
(40000018, 'img/bdd/cadet_018.png', 'arriere', 'Charpentier', 'Antoine'),
(40000019, 'img/bdd/cadet_019.png', 'pilier', 'Dumont', 'Bastien'),
(40000020, 'img/bdd/cadet_020.png', 'talonneur', 'Legrand', 'Clément');

SHOW TABLES;
SELECT * FROM seniors;