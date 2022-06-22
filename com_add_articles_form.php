<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Créer un commentaire</title>
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
                <a href="dashboard.php">GESTION DE <strong>BLOG</strong></a>
            </div>
            <!-- Création du bouton pour le menu au format smartphone -->
            <label for="btn" class="icon">
                <span class="fa fa-bars"></span>
            </label>
            <input type="checkbox"  id="btn"> 
            <!-- Création du menu avec les sous-menus -->
            <ul>
                <li><a href="dashboard.php">Accueil</a></li>
                <li><a href="add_article_form.php">Ajouter un article</a></li>
                <li><a href="com_articles_affiche.php">Tous les articles</a></li>
                <li><a href="deconnecter.php">Se déconnecter</a></li>
            </ul>
        </nav>
        

        <!-- CONNEXION à la base de données projetfs_com pour récupérer les informations concernant les informations de l'article dont je souhaite commenter -->
        <?php
            $id_article = $_GET["id_article"];
            $mysqli = new mysqli("localhost", "root", "", "projetfs_com");
            $mysqli->set_charset("utf8");
            $requete = "SELECT id,titre,corps,id_utilisateur FROM article WHERE id=$id_article;";
            $resultat = $mysqli->query($requete);
            $article = $resultat->fetch_assoc();
        ?>


        <!-- CREATION DU FORMULAIRE POUR CREER UN COMMENTAIRE -->
        <div class="modifier">
            <h1>Créer un commentaire pour l'article N°<?php echo $id_article; ?></h1>

            <?php
                if(!empty($_GET["status"])) {
                    if($_GET["status"] == "registered") {
                        echo "<div class='success'>Le commentaire a été créé</div>";
                    }
                }
            ?>

            <!-- Création du formulaire pour créer un commentaire sur l'article séléctionné -->
            <form action="com_add_articles.php" method="post">
                <p><textarea style="display:none;" type="text" name="id_article"><?php echo $article['id']; ?></textarea></p>
                <p class="information titre">Titre de l'article :</p>
                <p class="information texte"><?php echo $article['titre']; ?></p>
                <p class="information titre">Corps de l'article :</p>
                <p class="information texte"><?php echo $article['corps']; ?></p> 
                <p><textarea type="text" name="texte" required placeholder="Texte du commentaire"></textarea></p>
                <button type="submit">Ajouter un commentaire</button>
            </form>
        </div>


    </body>
</html>