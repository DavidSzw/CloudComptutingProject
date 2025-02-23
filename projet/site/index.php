<?php
    if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod')){
        header('Location: m/accueil.php');
        exit(); 
    }else{
        header('Location:accueil.php');
        exit(); 
    }
?>