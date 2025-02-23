<?php
    session_start();            
?>
            
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>S.A.Monein</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/style_haut_bas.css"/>   
        <link rel="icon" type="image/x-icon" href="img/logo_club.png">
        <link href="https://fonts.cdnfonts.com/css/archivo-black" rel="stylesheet"> 
        <link href="https://fonts.cdnfonts.com/css/homemade-apple" rel="stylesheet">               
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/script_haut_bas.js"></script>
    </head>
    <body>
    <div class="l" id="top">

            <?php
                if(!isset($_SESSION["role"])){
                    echo ("<a href='login.php'><button class='connexion_butt'>Se connecter</button></a>");
                }else{
                    echo ("<a href='admin.php'><button class='connexion_butt'>Portail admin</button></a>");
                }
            ?>
        <div class="caroussel">
            <?php
                include('carroussel.html');
            ?>
        </div>
 
        <?php
            include('haut_de_page.html');
        ?>
    </div>

    <div class="l" id="classement">
                
        <img src="img/SAISON 2023-24.png" alt="monein" id="fond_classement">
        <div class="calendrier_classement">
            <div class="titre_classement">
            <h2><i class="fas fa-trophy" style="margin-right: 20px;"></i>CLASSEMENT</h2>
            <h2><i class="fas fa-calendar" style="margin-right: 20px;"></i>CALENDRIER</h2>


            </div>
            <div class="classement_content">
                <div id="div_classement">
                    <?php
                        include('classement.php');
                    ?>
                </div>

                <div class=div_calendrier>
                    <div class="calendrier">
                        <div class="cote_calendrier" id="fleche_calendrier_gauche"  onclick='previous_game()'>
                            <img src='img/gauche.png' alt='gauche' class='img_button'>
                        </div>
                        <?php
                            include('calendrier.php');
                        ?>
                        <div class="cote_calendrier" id="fleche_calendrier_droite" onclick='next_game()'>
                            <img src='img/droite.png' alt='droite' class='img_button'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div_bouton">
                <div class="bouton_complet">
                    <a href="classement_complet.php?cat=seniors">
                        Voir le classement complet
                    </a>
                </div>
                <div class="bouton_complet">
                    <a href="calendrier_complet.php?cat=seniors">
                        Voir le calendrier complet
                    </a>
                </div>
            </div>
            
        </div>
        <div class="actualite">
            <div class="titre_actualite">
                <hr id="hr_gauche_actu">
                <hr id="hr_droite_actu">
                <h2>ACTUALITÉS</h2>
            </div>
            <div class="actu_content">
                <?php
                    include('actu.php');
                ?>
            </div>
        </div>
    </div>

    <div class="l" id="socialmedia">
        <div id="back_social"></div>
        <div>
            <div class="ticket_reseau">
                <a href="https://www.instagram.com/s.a.monein/" target="_blank"><img src="img/logo_insta.png" alt="instagram" class="logo_titre_social" id="logo_titre_social_insta"></a>
                <a href="https://www.facebook.com/groups/385508398204726" target="_blank"><img src="img/facebook.png" alt="facebook" class="logo_titre_social"></a>
                <?php
                    include('reseaux.html');
                ?>
            </div>
        </div>
        <div id="instagram">
        <a href="https://www.instagram.com/s.a.monein/" target="_blank" id="lien_insta"><img src="img/logo_insta.png" alt="instagram" class="logo_rs" ><span class="nom_rs">s.a.monein</span></a>
        <div id="instafeed"></div>

    	<script src="https://cdn.jsdelivr.net/gh/stevenschobert/instafeed.js@2.0.0rc1/src/instafeed.min.js"></script>
    	<script type="text/javascript">
    	var userFeed = new Instafeed({
    		get: 'user',
    		target: "instafeed",
            limit:8,
    		accessToken: 'IGQVJWU1FobWNCVHg2NEJkMTVnaGo5MWpLbmE3WXF6VmpFNHZArd2U1M3IwV2NzbEd2dEkyWXhaVEVhNDRnUW1SUm9kZAWJvTFRhZAG5aUUJfNVhoZAUQxUkw3cFlhX25uQWpPd0JqQmhsR2lFOG5PZAlJfbQZDZD'
    	});
    	userFeed.run();
    	</script>
        </div>
  
    </div>

    <div class="l" id="photos">
        <div class="div_photo"><img src="img/bande1.png" alt="photo1"></div>
        <div class="div_photo"><img src="img/bande2.png" alt="photo1"></div>
        <div class="div_photo"><img src="img/bande3.png" alt="photo1"></div>
        <div class="div_photo"><img src="img/bande4.png" alt="photo1"></div>
        <div class="div_photo"><img src="img/bande5.png" alt="photo1"></div>
        <div class="div_photo"><a href="gallerie.php"><figure class="figure_lien_photo"><img src="img/bande6.png" alt="photo1"><figcaption class="lien_photo"><i class="fas fa-images" style="margin-right:10px;font-size:20px;font-family: 'Font Awesome 5 Free';"></i>Voir La Galerie</figcaption></figure></a>
        </div>

    </div>

    
    </div>

    <?php
        include('bas_de_page.html');
    ?>
 
    </body>

</html