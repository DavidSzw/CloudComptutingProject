<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>S.A.Monein</title>
        <link rel="icon" type="image/x-icon" href="img/logo_club.png">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="css/style_haut_bas.css"/>
        <link rel="stylesheet" href="css/style_classement.css"/>      
        <link href="https://fonts.cdnfonts.com/css/archivo-black" rel="stylesheet"> 
        <link href="https://fonts.cdnfonts.com/css/homemade-apple" rel="stylesheet">
                       
        <script type="text/javascript" src="js/script_haut_bas.js"></script>
        <script type="text/javascript" src="js/script_classement.js"></script>
    </head>
    <body>

    <?php
        //categorie est : seniors ; juniors ou cadets
        $categorie=$_GET["cat"];
        $page="CLASSEMENT";
    ?>

    <div id="top">
        <div class="caroussel">
            <?php
                include('image.php');
            ?>
        </div>
        <?php
            include('haut_de_page.html');
        ?>
    </div>
    <?php
    echo"
        <div class='l' id='classement_complet' class=taille_$categorie>
        <div id='fond_classement' class=taille_$categorie>

        </div>";
        if($categorie=="seniors"){
            echo("<h2>Classement équipe première</h2>");
        }else{
            echo("<h2>Classement équipe $categorie</h2>");
        }

        //A SUPPRIMER
        if($categorie=="cadets" || $categorie=="juniors"){
            echo"<p class='indisponible'>La poule n'est pas encore sorti, elle sera disponible en Septembre</p>";
        }else{
            //A SUPPRIMER JUSQUE Là
            //oublie pas l'accolade à la fin

        echo("<table id='classement_$categorie'>");
    
            echo"
    <tr>
        <th>POSITON</th>
        <th>CLUB</th>
        <th>JOUÉ</th>
        <th>GAGNÉ</th>
        <th>NUL</th>
        <th>PERDU</th>
        <th>+/-</th>
        <th>POINTS</th>
    </tr>";

        $classement=[];

        if (($handle_e = fopen("data/$categorie.csv", "r"))) {
            while (($data = fgetcsv($handle_e, 1000, ";"))) {
                if($data[1]==$club){
                    $pos=$data[0];
                }
                if($data[0]!="POSITION"){
                    $classement[$data[0]]=$data;
                }
            }
            fclose($handle_e);
        }

        for($i=1;$i<=count($classement); $i++){
            $ligne=$classement[$i];
            $logo=str_replace(" ", "_", $ligne[1]);

            if($i==$pos){
                echo("<tr id='ligne_samonein'>");
            }else{
                echo("<tr>");
            }

            echo("<td class='col_chiffre'>$ligne[0]</td>");
            echo("<td class='col_nom'><img src='img/logo_club_$categorie/$logo.png' alt=$logo>$ligne[1]</td>");
            for($j=2;$j<8;$j++){
                echo("<td class='col_chiffre'>$ligne[$j]</td>");
            }
            echo("</tr>");
        }

        $classement=[];
        if($categorie=="seniors"){

            echo("</table><br><h2>Classement équipe réserve</h2>");

            echo("<table id='classement_$categorie'>");
            echo"<tr>
                    <th>POSITON</th>
                    <th>CLUB</th>
                    <th>JOUÉ</th>
                    <th>GAGNÉ</th>
                    <th>NUL</th>
                    <th>PERDU</th>
                    <th>+/-</th>
                    <th>POINTS</th>
                </tr>";


            if (($handle_e = fopen("data/seniorsb.csv", "r"))) {
                while (($data = fgetcsv($handle_e, 1000, ";"))) {
                    if($data[1]==$club){
                        $pos=$data[0];
                    }
                    if($data[0]!="POSITION"){
                        $classement[$data[0]]=$data;
                    }
                }
                fclose($handle_e);
            }
    
            for($i=1;$i<=count($classement); $i++){
                $ligne=$classement[$i];
                $logo=str_replace(" ", "_", $ligne[1]);
    
                if($i==$pos){
                    echo("<tr id='ligne_samonein'>");
                }else{
                    echo("<tr>");
                }
    
                echo("<td class='col_chiffre'>$ligne[0]</td>");
                echo("<td class='col_nom'><img src='img/logo_club_$categorie/$logo.png' alt=$logo>$ligne[1]</td>");
                for($j=2;$j<8;$j++){
                    echo("<td class='col_chiffre'>$ligne[$j]</td>");
                }
                echo("</tr>");
            }
    
        }
    }//accolade à supprimer pour cadets
        
    ?>

    </table>
    </div>

    <?php 
        include('bas_de_page.html');
    ?>
    </body>

</html>