
<?php

function date_to_string($date){
    $month=['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    $detail=explode("-", $date);
    $m=$month[intval($detail[1]) -1];
    $string="$detail[2] $m $detail[0]";
    return($string);
}

$calendrier=[];
$cpt=0;
if (($handle_e = fopen("data/calendrier_seniors.csv", "r"))) {
    $cpt=0;
    while (($data = fgetcsv($handle_e, 1000, ";"))) {
        if($data[0]!="CHAMPIONNAT"){
            $calendrier[$cpt]=$data;
            $cpt++;
        }
    }
    fclose($handle_e);
}
usort($calendrier,function($x, $y) {return strtotime($x[1]) > strtotime($y[1]);});
$bool=False;

for($i=0;$i<$cpt; $i++){
    $m=$calendrier[$i];
    $imgD=str_replace(' ','_',$m[3]);
    $imgE=str_replace(' ','_',$m[6]);
    $date=date_to_string($m[1]);
    if(($i!=($cpt-1) || $bool) && ($m[1]<date("Y-m-d") || $bool)){
        echo("<div class='affiche' style='display:none;'>
    <div class='entete_calendrier'>");
        
    }else{
        echo("<div class='affiche'>
    <div class='entete_calendrier'>");
        $bool=True;
    }
    echo("<img src='img/$m[0].png' alt=$m[0] class='logo_ligue'>");
    if($i==0){
        echo("<div class='date_fleche'>");
        echo("<p class='date_match'>$date à $m[2]</p>");
        echo("</div>");
        echo("</div>");
        echo(" <div class='match'>");
        echo("<img src='img/logo_club_seniors/$imgD.png' alt=$m[3] class='logo_calendrier'>");
        if($m[4]==""){
            echo("<span class='score_calendrier'> VS </span>");
        }else{
            echo("<span class='score_calendrier'>$m[4] - $m[5]</span>");
        }
        echo("<img src='img/logo_club_seniors/$imgE.png' alt=$m[6] class='logo_calendrier'>");
        echo("</div>");
    }else{
        if($i==$cpt-1){
            echo("<div class='date_fleche'>");
            echo("<p class='date_match'>$date à $m[2]</p>");
            echo("</div>");
            echo("</div>");
            echo(" <div class='match'>");
            echo("<img src='img/logo_club_seniors/$imgD.png' alt=$m[3] class='logo_calendrier'>");
            if($m[4]==""){
                echo("<span class='score_calendrier'> VS </span>");
            }else{
                echo("<span class='score_calendrier'>$m[4] - $m[5]</span>");
            }
            echo("<img src='img/logo_club_seniors/$imgE.png' alt=$m[6] class='logo_calendrier'>");
            echo("</div>");
        }else{
            echo("<div class='date_fleche'>");
            echo("<p class='date_match'>$date à $m[2]</p>");
            echo("</div>");
            echo("</div>");
            echo("<div class='match'>");
            
            echo("<img src='img/logo_club_seniors/$imgD.png' alt=$m[3] class='logo_calendrier'>");
            if($m[4]==""){
                echo("<span class='score_calendrier'> VS </span>");
            }else{
                echo("<span class='score_calendrier'>$m[4] - $m[5]</span>");
            }
            echo("<img src='img/logo_club_seniors/$imgE.png' alt=$m[6] class='logo_calendrier'>");
            echo("</div>");
        }
    }
    echo("</div>");
}

?>