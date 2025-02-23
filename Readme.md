Pour lancer le projet il faut se mettre dans le même répertoire que le Dockerfile et taper: docker-compose up -d puis docker-compose up --build

Une fois que c'est bon vous allez dans un navigateur et vous tapez juste "localhost", normalement ça vous amène sur la page d'accueil du site en passant par le proxy.

Après ça vous pouvez aller dans la page "effectif" des catégories seniors, cadets et juniors et normalement ça vous affiche un tableau avec l'effectif de la catégorie choisie, les données sont directement récupérées depuis la base de données.

Si vous faites "docker ps" dans le terminal vous verrez que y a bien trois conteneurs qui tournent et vous pouvez regarder les logs des différents conteneurs en tapant "docker log nomDuConteneur".
