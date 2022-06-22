<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
        <!-- APPEL DES DIFFERENTES PAGES DE STYLE -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/login_register.css">
        <!-- APPEL DE LA FEUILLE DE STYLE POUR LES PETITS ICONES -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <!-- CREATION DE L'ICON POUR MA PAGE HTML -->
        <link href="img/icon.JPG" rel="icon">
    </head>

    <body>
        <!-- CREATION DE MON MENU -->
        <nav>
            <!-- Création du titre du menu -->
            <div class="logo">
                <a href="index.php">GESTION DE <strong>BLOG</strong></a>
            </div>
            <!-- Création du bouton pour le menu au format smartphone -->
            <label for="btn" class="icon">
                <span class="fa fa-bars"></span>
            </label>
            <input type="checkbox"  id="btn"> 
            <!-- Création du menu avec les sous-menus -->
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="register_form.php" class="active">S'inscrire</a></li>
                <li><a href="login_form.php">Se connecter</a></li>
            </ul>
        </nav>


        <!-- IMAGE DE MISE EN PAGE -->
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        width="800px" height="600px" viewBox="0 0 800 600" enable-background="new 0 0 800 600" xml:space="preserve">
            <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="174.7899" y1="186.34" x2="330.1259" y2="186.34" gradientTransform="matrix(0.8538 0.5206 -0.5206 0.8538 147.9521 -79.1468)">
                <stop  offset="0" style="stop-color:#FFC035"/>
                <stop  offset="0.221" style="stop-color:#F9A639"/>
                <stop  offset="1" style="stop-color:#E64F48"/>
            </linearGradient>
            <circle fill="url(#SVGID_1_)" cx="266.498" cy="211.378" r="77.668"/>
            <linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="290.551" y1="282.9592" x2="485.449" y2="282.9592">
                <stop  offset="0" style="stop-color:#FFA33A"/>
                <stop  offset="0.0992" style="stop-color:#E4A544"/>
                <stop  offset="0.9624" style="stop-color:#00B59C"/>
            </linearGradient>
            <circle fill="url(#SVGID_2_)" cx="388" cy="282.959" r="97.449"/>
            <linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="180.3469" y1="362.2723" x2="249.7487" y2="362.2723">
                <stop  offset="0" style="stop-color:#12B3D6"/>
                <stop  offset="1" style="stop-color:#7853A8"/>
            </linearGradient>
            <circle fill="url(#SVGID_3_)" cx="215.048" cy="362.272" r="34.701"/>
            <linearGradient id="SVGID_4_" gradientUnits="userSpaceOnUse" x1="367.3469" y1="375.3673" x2="596.9388" y2="375.3673">
                <stop  offset="0" style="stop-color:#12B3D6"/>
                <stop  offset="1" style="stop-color:#7853A8"/>
            </linearGradient>
            <circle fill="url(#SVGID_4_)" cx="482.143" cy="375.367" r="114.796"/>
            <linearGradient id="SVGID_5_" gradientUnits="userSpaceOnUse" x1="365.4405" y1="172.8044" x2="492.4478" y2="172.8044" gradientTransform="matrix(0.8954 0.4453 -0.4453 0.8954 127.9825 -160.7537)">
                <stop  offset="0" style="stop-color:#FFA33A"/>
                <stop  offset="1" style="stop-color:#DF3D8E"/>
            </linearGradient>
            <circle fill="url(#SVGID_5_)" cx="435.095" cy="184.986" r="63.504"/>
        </svg>
        

        <!-- CREATION DU FORMULAIRE D'INSCRIPTION -->
        <div class="register">
            <h1>Inscription</h1>

            <?php
                include_once('utils.php');
                check_and_display_error();
            ?>

            <!-- Création du formulaire pour s'inscrire (nouvel utilisateur) -->
            <form action="register.php" method="post">
                <input id="input" type="email" name="email" class="mail" placeholder="ADRESSE MAIL" required>
                <input id="input" type="password" name="password" class="mdp" placeholder="MOT DE PASSE"  required >
                <input id="input" type="password" name="conf_password" class="mdp" placeholder="CONFIRMER LE MOT DE PASSE" required />
              <button type="submit">S'inscrire</button>
            </form>
        </div>
        

    </body>
</html>