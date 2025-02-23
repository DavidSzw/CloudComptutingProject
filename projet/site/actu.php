<?php

    $actualites = file_get_contents('data/articles.json');
	$array_data = json_decode($actualites, true);
    $len=count($array_data)-1;
	for($i=0;$i<4;$i++){
        $j=$len-$i;
        $titre=mb_strtoupper($array_data[$j]["titre"],"UTF-8");
        $img=$array_data[$j]["image_titre"];
        $apercu=substr($array_data[$j]["texte"],0,100);
        $id=$array_data[$j]["id"];
        $date=$array_data[$j]["date"];
        if($i%2==0){
            echo("<div class='actu_haute' onmouseover='show_news($i)' onmouseleave='hide_news($i)' >");
        }else{ 
            echo("<div class='actu_basse' onmouseover='show_news($i)' onmouseleave='hide_news($i)'>");
        }
        echo"<a href='viewactualites.php?id=$id'>";
        echo("<div class='imgActu'>");
        echo"<img src='/img/$img'>";
        echo("</div>");
        echo("<p class='text_actu'><span class=actuDate>$date</span><span class='titre_actu'>$titre</span>");
        echo("<span class='apercu_actu'>$apercu...</span>");
        echo "<span class='suite'> Lire la suite </span>";
        echo("</p>");
        echo("</a>");
        echo("</div>");
    }

?>
