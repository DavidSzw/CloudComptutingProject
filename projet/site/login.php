<?php

  /*session_start();
  if(isset($_SESSION["role"]) && ($_SESSION["role"]=="admin")){
    header('Location: admin.php');
    exit();
  }*/

  session_start();

  if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
      header('Location: admin.php');
      exit();
  }

  if(isset($_GET["error"]) && $_GET["error"]=="inc"){
    
    echo '<script type="text/javascript">';
    echo ' alert("Identifiant ou mot de passe incorrect!")';
    echo '</script>';
  }

  $token=strval(random_int(1010101,99999999));
  $_SESSION['csrf_token']=$token;
  
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Récupérer les informations du formulaire
      $username = $_POST["username"];
      $password = $_POST["password"];
  
      // Connexion à la base de données avec PDO
      $host = "votre_host";
      $db_name = "votre_base_de_donnees";
      $username_db = "votre_nom_d_utilisateur";
      $password_db = "votre_mot_de_passe";
  
      try {
          $conn = new PDO("mysql:host=$host;dbname=$db_name", $username_db, $password_db);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
          // Utilisation de requêtes préparées pour éviter les injections SQL
          $sql = "SELECT * FROM users WHERE username = :username";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(":username", $username);
          $stmt->execute();
          $user = $stmt->fetch(PDO::FETCH_ASSOC);
  
          if ($user && password_verify($password, $user["password"])) {
              // Connexion réussie, enregistrez les informations de l'utilisateur dans la session
              $_SESSION["user_id"] = $user["id"];
              $_SESSION["role"] = $user["role"];
  
              // Rediriger vers la page d'administration ou toute autre page appropriée
              header("Location: admin.php");
              exit();
          } else {
              // Identifiant ou mot de passe incorrect
              echo "Identifiant ou mot de passe incorrect";
          }
      } catch (PDOException $e) {
          echo "Erreur : " . $e->getMessage();
      }
  }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Page de connexion</title>
        <link rel="icon" type="image/x-icon" href="img/logo_club.png">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=El+Messiri:wght@700&display=swap');

        * {
          margin: 0;
          padding: 0;
          font-family: 'El Messiri', sans-serif;
        }

        body {
          background: #031323;
          overflow: hidden;
        }

        .fas {
          width: 32px;
        }

        section {
          display: flex;
          justify-content: center;
          align-items: center;
          min-height: 100vh;
         /* background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #e2345a);*/
          background: linear-gradient(-45deg, #ad7752, #e73c1e, #22a6d5, #eae75a);
          background-size: 400% 400%;
          animation: gradient 10s ease infinite;
        }

        @keyframes gradient {
            0% {
              background-position: 0% 50%;
              }
            50% {
              background-position: 100% 50%;
              }
            100% {
              background-position: 0% 50%;
              }
        }

        .box {
          position: relative;
        }

        .box .square {
          position: absolute;
          background: rgba(255, 255, 255, 0.1);
          backdrop-filter: blur(5px);
          box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
          border: 1px solid rgba(255, 255, 255, 0.15);
          border-radius: 15px;
          animation: square 10s linear infinite;
          animation-delay: calc(-1s * var(--i));
        }

        .square img{
          height: 70%;
          padding-top: 15%;
          padding-left: 20%;
        }

        @keyframes square {
          0%, 100% {
            transform: translateY(-20px);
          }

          50% {
            transform: translateY(20px);
          }
        }

        .box .square:nth-child(1) {
          width: 100px;
          height: 100px;
          top: -15px;
          right: -45px;
        }

        .box .square:nth-child(2) {
          width: 150px;
          height: 150px;
          top: 105px;
          left: -125px;
          z-index: 2;
        }

        .box .square:nth-child(3) {
          width: 60px;
          height: 60px;
          bottom: 85px;
          right: -45px;
          z-index: 2;
        }

        .box .square:nth-child(4) {
          width: 50px;
          height: 50px;
          bottom: 35px;
          left: -95px;
        }

        .box .square:nth-child(5) {
          width: 50px;
          height: 50px;
          top: -15px;
          left: -25px;
        }

        .box .square:nth-child(6) {
          width: 85px;
          height: 85px;
          top: 165px;
          right: -155px;
          z-index: 2;
        }

        .container {
          position: relative;
          padding: 50px;
          width: 260px;
          min-height: 380px;
          display: flex;
          justify-content: center;
          align-items: center;
          background: rgba(255, 255, 255, 0.1);
          backdrop-filter: blur(5px);
          border-radius: 10px;
          box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
        }

        .container::after {
          content: '';
          position: absolute;
          top: 5px;
          right: 5px;
          bottom: 5px;
          left: 5px;
          border-radius: 5px;
          pointer-events: none;
          background: linear-gradient( to bottom, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.1) 2% );
        }

        .form {
          position: relative;
          width: 100%;
          height: 100%;
        }

        .form h2 {
          color: #fff;
          letter-spacing: 2px;
          margin-bottom: 30px;
        }

        .form .inputBx {
          position: relative;
          width: 100%;
          margin-bottom: 20px;
        }

        .form .inputBx input {
          width: 80%;
          outline: none;
          border: none;
          border: 1px solid rgba(255, 255, 255, 0.2);
          background: rgba(255, 255, 255, 0.2);
          padding: 8px 10px;
          padding-left: 40px;
          border-radius: 15px;
          color: #fff;
          font-size: 16px;
          box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .form .inputBx .password-control {
          position: absolute;
          top: 11px;
          right: 10px;
          display: inline-block;
          width: 20px;
          height: 20px;
          background: url(https://snipp.ru/demo/495/view.svg) 0 0 no-repeat;
          transition: 0.5s;
        }

        .form .inputBx .view {
          background: url(https://snipp.ru/demo/495/no-view.svg) 0 0 no-repeat;
          transition: 0.5s;
        }

        .form .fas {
          position: absolute;
          top: 13px;
          left: 13px;
        }

        .form input[type="submit"] {
          background: #fff;
          color: #111;
          max-width: 100px;
          padding: 8px 10px;
          box-shadow: none;
          letter-spacing: 1px;
          cursor: pointer;
          transition: 1.5s;
        }

        .form input[type="submit"]:hover {
          background: linear-gradient(115deg, rgba(0,0,0,0.10), rgba(255,255,255,0.25));
          color: #fff;
          transition: .5s;
        }

        .form input::placeholder {
          color: #fff;
        }

        .form span {
          position: absolute;
          left: 30px;
          padding: 10px;
          display: inline-block;
          color: #fff;
          transition: .5s;
          pointer-events: none;
        }

    .form input:focus ~ span,
    .form input:valid ~ span {
      transform: translateX(-30px) translateY(-25px);
      font-size: 12px;
    }

    .form p {
      color: #fff;
      font-size: 15px;
      margin-top: 5px;
    }

    .form p a {
      color: #fff;
    }

    .form p a:hover {
      background-color: #000;
      background-image: linear-gradient(to right, #434343 0%, black 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .form .remember {
      position: relative;
      display: inline-block;
      color: #fff;
      margin-bottom: 10px;
      cursor: pointer;
    }
    </style>
</head>
<body>

<section>
  
  <div class="box">
    
    <div class="square" style="--i:0;"><img src="img/logo_club.png" alt=""></div>
    <div class="square" style="--i:1;"><img src="img/logo_club.png" alt=""></div>
    <div class="square" style="--i:2;"><img src="img/logo_club.png" alt=""></div>
    <div class="square" style="--i:3;"><img src="img/logo_club.png" alt=""></div>
    <div class="square" style="--i:4;"><img src="img/logo_club.png" alt=""></div>
    <div class="square" style="--i:5;"><img src="img/logo_club.png" alt=""></div>
    
   <div class="container"> 
    <div class="form"> 
      <h2>LOGIN to Admin</h2>
      <form action="login_process.php" method="POST">
        <div class="inputBx">
          <input type="text" name="username" id="username" required="required">
          <span>Login</span>
          <i class="fas fa-user-circle"></i>
        </div>
        <div class="inputBx password">
          <input id="password" type="password" name="password" required="required">
          <span>Password</span>
          <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
          <i class="fas fa-key"></i>
        </div>
        <label class="remember"><input type="checkbox"> Remember</label>
        <?php
          echo"<input id='token' type='text' name='token' value=$token required='required' hidden>";
        ?>
        <div class="inputBx">
          <input type="submit" value="Login"> 
        </div>
      </form>
      
      
    </div>
  </div>
    
  </div>
</section>

<script>

function show_hide_password(target){
	var input = document.getElementById('password');
	if (input.getAttribute('type') == 'password') {
		target.classList.add('view');
		input.setAttribute('type', 'text');
	} else {
		target.classList.remove('view');
		input.setAttribute('type', 'password');
	}
	return false;
}

</script>

</div>
</body>
</html>
