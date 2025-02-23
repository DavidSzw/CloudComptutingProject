MANUEL D'UTILISATION DU site

Le site est présent en versions : une mobile dans le dossier m
                                 et une pour plus grand écran dans le dossier courant

Le dossier css contient les feuilles pour le style pour les pages
    Ces fichiers sont à modifier seulement pour modifier la forme du site et en connaissances du langage css et html
    
    style.css : regroupe le css de la page d'accueil (versions mobiles et ordinateur)
    style_haut_bas.css : regroupe le style pour les parties hautes et basses de toutes les pages (ie les fichiers haut_de_page.html, haut_de_page.php, bas_de_page.html)
    style_classement.css : regroupe le style de toutes les autres pages du site
    NB: pres ; president ; internationnaux ; contact ; effectif ; dirigeants ; gallerie ; histoire ; login  ; palmares et partenaires ont du css intégrer sur la page php dans le head

Le dossier data contient les données nécéssaires au fonctionnement du site
    Ces fichiers peuvent être modifiés, toutefois les modification impacteront directement le contenu du site et doivent être vérifiés avant de publier
    Seulement les fichiers csv doivent être manipuler régulièrement. ATTENTION à bien utiliser le format csv au réenregistrement, particulièrement si ouverture avec excel

    articles.json : fichier json contenant les actualités affichées sur le site, ne nécessite pas d'être modifier à la main
    bdd_effectif.sql : le fichier de base de données pour l'effectif, regroupe les seniors, les juniors, les cadets, et les dirigeants. Ne nécéssite pas de modification à la main
    login.sql : le fichier de base de données pour les identifiants de connexion. Ne nécessite pas de modification à la main
    seniors.csv; seniorsb.csv; juniors.csv ; cadets.csv : regroupe les classement de la poule de chaque équipe. Ces fichiers doivent être actualisés après chaque journée de championnat. ATTENTION à bien utiliser le format csv au réenregistrement, particulièrement si ouverture avec excel
    calendrier_seniors.csv ; calendrier_seniorsb.csv ; calendrier_juniors.csv ; calendrier_cadets.csv :regroupe les résultats et calendrier de chaque équipe. Ces fichiers doivent être actualisés après chaque match des équipes concernées ou en cas de changement d'horaire ou d'ajout d'un match. ATTENTION à bien utiliser le format csv au réenregistrement, particulièrement si ouverture avec excel

Le dossier img regroupe tous les images du site

le dossier js regroupe les fichiers contenant les scripts du site

accueil
actu
actualites
admin
ajoutarticle
ajoutetsup
bas_de_page
calendrier_complet
calendrier
carroussel
classement_complet
classement
contact
deconnexion
dirigeants
effectif
gallerie
haut_de_page
histoire
image
index
internationaux
login_process
login
palmares
partenaires
president
reseaux
viewactualites


Detail utilisation admin