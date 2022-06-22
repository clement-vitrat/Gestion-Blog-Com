<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Déconnection</title>
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
                <li><a href="register_form.php">S'inscrire</a></li>
                <li><a href="login_form.php">Se connecter</a></li>
            </ul>
        </nav>
        

        <!-- Appel des différentes fonctions php pour se déconnecter et supprimer le cookie -->
        <?php
            # Redémarrage de la session
            session_start();
            # Vide la session
            session_unset();
            # Détruit la session
            session_destroy();

            setcookie(session_name(), '', strtotime("-1 day"));
            
            //Une fois déconnecter, on revient à la page d'accueil
            header('Location : register_form.php');
        ?>

        <!-- Affichage d'un message pour informer que l'utilisateur s'est déconnecté -->
        <h1 class="deconnecte">
            Vous vous êtes déconnecter avec succès !
        </h1>
        
        <!-- Demande à l'utilisateur s'il veut retourner à l'accueil ou se reconnecter -->
        <div class="ajart">
            <p>Vous voulez retourner à l'accueil ?</p>
            <p>Si oui, <a href="index.php">Retourner à l'accueil</a>.</p>
            <p>Voulez-vous vous reconnecter ?</p>
            <p>Si oui, <a href="login_form.php">Reconnectez vous</a>.</p>
        </div>

    </body>
</html>