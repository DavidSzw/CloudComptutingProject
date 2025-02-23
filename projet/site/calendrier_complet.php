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
        $page="CALENDRIER";
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
    <div class="l" id="classement_complet">
        <div id="fond_classement">
        </div>

    <?php
        echo("<h2>Calendrier équipes $categorie <span class='note'>(Les horaires sont succeptibles de changer en cours de saison)</span></h2>");

        function date_to_string($date){
            $month=['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
            $detail=explode("-", $date);
            $m=$month[intval($detail[1]) -1];
            $string="$detail[2] $m $detail[0]";
            return($string);
        }

        //A SUPPRIMER
        if($categorie=="cadets" || $categorie=="juniors"){
            echo"<p class='indisponible'>Le calendrier n'est pas encore sorti, il sera disponible en Septembre</p>";
        }else{

            //A SUPPRIMER JUSQUE Là
            //oublie pas l'accolade à la fin

        $calendrier=[];
        $cpt=0;
        if (($handle_e = fopen("data/calendrier_$categorie.csv", "r"))) {
            $cpt=0;
            while (($data = fgetcsv($handle_e, 1000, ";"))) {
                if($data[0]!="CHAMPIONNAT"){
                    $calendrier[$cpt]=$data;
                    if($categorie=="seniors"){
                        $calendrier[$cpt]["reserve"]=0;
                    }else{
                        $calendrier[$cpt]["reserve"]=3;
                    }
                    $cpt++;
                }
            }
            fclose($handle_e);
        }

        if($categorie=="seniors"){
            if (($handle_e = fopen("data/calendrier_seniorsb.csv", "r"))) {
                while (($data = fgetcsv($handle_e, 1000, ";"))) {
                    if($data[0]!="CHAMPIONNAT"){
                        $calendrier[$cpt]=$data;
                        $calendrier[$cpt]["reserve"]=1;
                        $cpt++;
                    }
                }
                fclose($handle_e);
            }
        }
        usort($calendrier,function($x, $y) {return strtotime($x[1]) > strtotime($y[1]);});
        $bool=False;

        for($i=0;$i<$cpt; $i++){
            $m=$calendrier[$i];
            $imgD=str_replace(' ','_',$m[3]);
            $imgE=str_replace(' ','_',$m[6]);
            $date=date_to_string($m[1]);

            if($m["reserve"]==0){
                echo"<div class='rencontre premiere'>";
                echo"<div class='info_rencontre'>";
                echo"<p>$m[0]</p>";
                echo"<p>$date à $m[2]</p>";
                echo"</div>";
                echo"<div class='match'>";
                echo"<span class='nom_equipe_g'>$m[3]</span>";
                echo"<img src='img/logo_club_seniors/$imgD.png' alt='$m[3]'>";
                if($m[4]==""){
                    echo"<span> VS </span>";
                }else{
                    echo"<span class='resultat'>$m[4] - $m[5]</span>";
                }
                echo"<img src='img/logo_club_seniors/$imgE.png' alt='$m[6]'>";
                echo"<span class='nom_equipe_d'>$m[6]</span>";
                echo"</div>";
                echo"</div>";
            }else{


                if($m["reserve"]==3){
                    echo"<div class='rencontre jeune'>";
                    echo"<div class='info_rencontre'>";
                    echo"<p>$m[0]</p>";
                    echo"<p>$date à $m[2]</p>";
                    echo"</div>";
                    echo"<div class='match'>";
                    echo"<span class='nom_equipe_g'>$m[3]</span>";
                    echo"<img src='img/logo_club_$categorie/$imgD.png' alt='$m[3]'>";
                    if($m[4]==""){
                        echo"<span> VS </span>";
                    }else{
                        echo"<span class='resultat'>$m[4] - $m[5]</span>";
                    }
                    echo"<img src='img/logo_club_$categorie/$imgE.png' alt='$m[6]'>";
                    echo"<span class='nom_equipe_d'>$m[6]</span>";
                    echo"</div>";
                    echo"</div>";
                }else{
                    echo"<div class='rencontre reserve'>";
                    echo"<div class='info_rencontre'>";
                    echo"<p>$m[0]</p>";
                    echo"<p>$date à $m[2]</p>";
                    echo"</div>";
                    echo"<div class='match'>";
                    echo"<span class='nom_equipe_g'>$m[3] RESERVE</span>";
                    echo"<img src='img/logo_club_seniors/$imgD.png' alt='$m[3]'>";
                    if($m[4]==""){
                        echo"<span> VS </span>";
                    }else{
                        echo"<span class='resultat'>$m[4] - $m[5]</span>";
                   }
                    echo"<img src='img/logo_club_seniors/$imgE.png' alt='$m[6]'>";
                    echo"<span class='nom_equipe_d'>$m[6] RESERVE</span>";
                    echo"</div>";
                    echo"</div>";
                }
            }   
        }
        }//supprimer celle la pour les cadets et juniors
    ?>
    </div>

    <?php 
        include('bas_de_page.html');
    ?>
</body>

</html>