<?php
if(isset($_GET["id"])){

    $id=$_GET["id"];
    $actualites = file_get_contents('data/articles.json');
    $array_data = json_decode($actualites, true);
    $len=count($array_data);
    $list_json=[];
    file_put_contents('data/articles.json', "[");
    
    for($i=0; $i<$len ;$i++){
        if($array_data[$i]['id']==$id){
            $img="img/".$array_data[$i]['image_titre'];
            $nb_img=count($array_data[$i]['photos']);
            for($j=0;$j<$nb_img;$j++){
                $photo=$array_data[$i]['photos'][$j];
                unlink($photo);
            }
            unset($array_data[$i]);
            unlink($img);
        }else{
            $data_json=json_encode($array_data[$i]);
            file_put_contents('data/articles.json', $data_json, FILE_APPEND);
            if($i+1!=$len && ($i+2!=$len || $array_data[$i+1]['id']!=$id)){
                file_put_contents('data/articles.json', ",", FILE_APPEND);
            }
        }
    }
    print_r($list_json);
    file_put_contents('data/articles.json', "]", FILE_APPEND);
    
    header('Location: admin.php?actu=suppr');
    exit();

}