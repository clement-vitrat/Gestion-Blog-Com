<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
        <!-- APPEL DES DIFFERENTES PAGES DE STYLE -->
        <link rel="stylesheet" href="css/style.css">
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
                <a href="dashboard.php">GESTION DE <strong>BLOG</strong></a>
            </div>
            <!-- Création du bouton pour le menu au format smartphone -->
            <label for="btn" class="icon">
                <span class="fa fa-bars"></span>
            </label>
            <input type="checkbox"  id="btn"> 
            <!-- Création du menu avec les sous-menus -->
            <ul>
                <li><a href="dashboard.php" class="active">Accueil</a></li>
                <li><a href="add_article_form.php">Ajouter un article</a></li>
                <li><a href="com_articles_affiche.php">Tous les articles</a></li>
                <li><a href="deconnecter.php">Se déconnecter</a></li>
            </ul>
        </nav>
        

        <!-- Message pour informer a l'utilisateur qu'il s'est bien connecté -->
        <p class="connecte">
            <?php
                # Redémarrage de la session
                session_start();
                echo "Bonjour <span>";
                echo $_SESSION['user'];
                echo "</span>, vous vous êtes connecté avec succès ! Bravo !!";
            ?>
        </p>


        <!-- Appel du fichier utils.php pour afficher les différents articles de l'utilisateur -->
        <?php
            include_once('utils.php'); 
            liste_articles();
        ?>


        <!-- Demande à l'utilisateur s'il veut modifier un article -->
        <div class="ajart">
            <h1 class="deconnecte" style="margin:0px;">Vous voulez modifier un article ?</h1>
            <p>Si oui, appuyez sur l'icone <i class='fa-solid fa-pen-to-square' style="color:rgb(150, 76, 23);"></i>.</p>
        </div>

    </body>
</html>
