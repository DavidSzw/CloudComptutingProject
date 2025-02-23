<table id="classement_acc">
    <tr>
        <th>POSITON</th>
        <th>CLUB</th>
        <th>POINTS</th>
    </tr>
<?php

$pos=0;
$last=0;
$classement=[];

if (($handle_e = fopen("data/seniors.csv", "r"))) {
    while (($data = fgetcsv($handle_e, 1000, ";"))) {
        if($data[1]=="SA MONEIN"){
            $pos=$data[0];
        }
        if($data[0]!="POSITION"){
            if($data[0]>$last){
                $last=$data[0];
            }
            $classement[$data[0]]=$data;
        }
    }
    fclose($handle_e);
}

if($pos>2 && $pos<($last-1)){
    for($i=$pos-2;$i<=$pos+2;$i++){
        $nom=$classement[$i][1];
        $points=$classement[$i][7];
        $logo=str_replace(" ", "_", $nom);
        if($classement[$i][1]=="SA MONEIN"){
            echo("<tr class='ligne_class_acc' id='sam_classement'>");
        }else{
            echo("<tr class='ligne_class_acc'>");
        }
        echo("<td class='petite_col'>");
        echo ("$i</td>");
        echo("<td class='large_col'><img src=img/logo_club_seniors/$logo.png alt=$nom class='logo_classement'><span class='nom_classement'>$nom</span></td>");
        echo("<td class='petite_col'>$points");
        echo("</td></tr>");
    }
}else{
    if($pos<=2){
        for($i=1;$i<=5;$i++){
            $nom=$classement[$i][1];
            $points=$classement[$i][7];
            $logo=str_replace(" ", "_", $nom);
            if($classement[$i][1]=="SA MONEIN"){
                echo("<tr class='ligne_class_acc' id='sam_classement'>");
            }else{
                echo("<tr class='ligne_class_acc'>");
            }
            echo("<td class='petite_col'>");
            echo ("$i</td>");
            echo("<td class='large_col'><img src=img/$logo.png alt=$nom class='logo_classement<span class='nom_classement'>$nom</span></td>");
            echo("<td class='petite_col'>$points");
            echo("</td></tr>");
        }
    }else{
        for($i=$last-4;$i<=$last;$i++){
            $nom=$classement[$i][1];
            $points=$classement[$i][7];
            $logo=str_replace(" ", "_", $nom);
            if($classement[$i][1]=="SA MONEIN"){
                echo("<tr class='ligne_class_acc' id='sam_classement'>");
            }else{
                echo("<tr class='ligne_class_acc'>");
            }
            echo("<td class='petite_col'>");
            echo ("$i</td>");
            echo("<td class='large_col'><img src=img/$logo.png alt=$nom class='logo_classement'><span class='nom_classement'>$nom</span></td>");
            echo("<td class='petite_col'>$points");
            echo("</td></tr>");
        }
    }
}

?>
</table>