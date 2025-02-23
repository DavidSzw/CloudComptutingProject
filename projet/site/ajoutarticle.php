<?php
if(isset($_POST["titre"])){
    $titre=$_POST["titre"];
    $texte=$_POST["texte"];
    $image=$_FILES["image_titre"];

    $photoName = uniqid() . '_' . $image["name"];
    $photoPathTotal = "img/article/" . $photoName;
    $photoPathtitre = "article/" . $photoName;
    $res=move_uploaded_file($image["tmp_name"], $photoPathTotal);

    $articles = file_get_contents('data/articles.json');
    $array_articles = json_decode($articles, true);
    $len=count($array_articles);
    $id=$array_articles[$len-1]["id"] +1;

    $date=date("Y-m-d");

    $list_img=$_FILES['images'];
    if($list_img["name"][0]==""){
        $total=0;
    }else{
        $total = count($list_img['name']);
    }
    $photos=[];

    for($i=0; $i<$total; $i++){
        $photoName = uniqid() . '_' . $list_img["name"][$i];
        $photoPathTotal = "img/article/" . $photoName;
        $photoPath = "article/" . $photoName;
        $res=move_uploaded_file($list_img["tmp_name"][$i], $photoPathTotal);
        $photos[$i]=$photoPathTotal;
    }

    $new_article=array('id' => $id, 'titre'=>$titre, 'date'=>$date, 'image_titre'=>$photoPathtitre, 'texte'=>$texte, 'photos'=>$photos);
    $article=json_encode($new_article);


    $array_articles[]=json_decode($article);
    $final_data = json_encode($array_articles);
    file_put_contents('data/articles.json', $final_data);

    header("Location:admin.php");
    exit();
}else{
    if(isset($_FILES["gallerie" ])){
        $list_img=$_FILES['gallerie'];
        $total = count($list_img['name']);
        $photos=[];
        $date=date("m-d");
        $year=date("Y");
        if($date<"08-01"){
            $saison=$year-1 . "-" .$year;
        }else{
            $saison=$year . "-" .$year+1;
        }

        if(!is_dir("img/gallerie/".$saison)){
            mkdir("img/gallerie/".$saison);
        }

        for($i=0; $i<$total; $i++){
            $photoName = uniqid() . '_' . $list_img["name"][$i];
            $photoPathTotal = "img/gallerie/".$saison."/" . $photoName;
            $res=move_uploaded_file($list_img["tmp_name"][$i], $photoPathTotal);
        }
        header("Location:admin.php");
        exit();
    }else{
        header("Location:admin.php?erreur=ajout");
        exit();
    }
}

?>