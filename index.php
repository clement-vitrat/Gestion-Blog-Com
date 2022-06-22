<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion de blog</title>
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
                <a href="index.php">GESTION DE <strong>BLOG</strong></a>
            </div>
            <!-- Création du bouton pour le menu au format smartphone -->
            <label for="btn" class="icon">
                <span class="fa fa-bars"></span>
            </label>
            <input type="checkbox"  id="btn">   
            <!-- Création du menu avec les sous-menus -->
            <ul>
                <li><a href="index.php" class="active">Accueil</a></li>
                <li><a href="register_form.php">S'inscrire</a></li>
                <li><a href="login_form.php">Se connecter</a></li>
            </ul>
        </nav>
   
        <?php
            include_once('utils.php');
            check_and_display_error();
        ?>
        
        <!-- CREATION DU TABLEAU AFFICHANT TOUS LES ARTICLES AVEC LE NOM DU CREATEUR -->
        <?php
            //Connexion à la Base de données "projetfs"
            $mysqli = new mysqli("localhost", "root", "", "projetfs_com");
            $mysqli->set_charset("utf8");
            //Requete de la base de données projets_com pour récupérer tous les articles
            $requete_art = "SELECT a.id,titre,corps,created_at,updated_at,email FROM article a JOIN utilisateur u ON a.id_utilisateur=u.id;";
            $resultat_art = $mysqli->query($requete_art);
        ?>
        <!-- Créaction du tableau -->
        <table>
            <caption>Liste des articles</caption>
            <thead>
                <tr>
                    <th>Titre de l'article / Commentaire</th>
                    <th>Corps de l'article / Texte du Commentaire</th>
                    <th style='text-align:center;'>Date de Créa</th>
                    <th style='text-align:center;'>Date de Modif</th>
                    <th>Utilisateur</th>
                </tr>
            </thead>
            <?php
               //Affichage des différents articles de l'utilisateur connecté
            while ($row_art = $resultat_art->fetch_assoc()) {
                $id_art = $row_art["id"];
                echo "<tbody>
                    <tr>
                        <td class='articles'>". $row_art['titre'] . "</td>
                        <td class='articles'> ". $row_art['corps'] . "</td>
                        <td class='articles' style='text-align:center;'> ". $row_art['created_at'] . "</td>
                        <td class='articles' style='text-align:center;'> ". $row_art['updated_at'] . "</td>
                        <td class='articles'> " . $row_art['email'] . "</td>
                    </tr>";
                    //Requete de la base de données projets_com pour récupérer les commentaires
                    $requete_com = "SELECT c.id, texte, created_at, updated_at, id_article, email FROM commentaire c JOIN utilisateur u ON c.id_utilisateur=u.id WHERE id_article=$id_art;";
                    $resultat_com = $mysqli->query($requete_com);
                    //Affichage des différents commentaires de l'article affiché
                    while ($row_com = $resultat_com->fetch_assoc()) {
                        echo "<tr>
                            <td class='commentaire'>Commentaire</td>
                            <td class='commentaire'>". $row_com['texte'] . "</td>
                            <td class='commentaire' style='text-align:center;'> ". $row_com['created_at'] . "</td>
                            <td class='commentaire' style='text-align:center;'> ". $row_com['updated_at'] . "</td>
                            <td class='commentaire'> " . $row_com['email'] . "</td>
                        </tr>";
                    }
                    echo "<tr>
                            <td style='background: #e0e0e0;'></td>
                            <td style='background: #e0e0e0;'></td>
                            <td style='background: #e0e0e0;'></td>
                            <td style='background: #e0e0e0;'></td>
                            <td style='background: #e0e0e0;'></td>
                        </tr>";
                echo "</tbody>";
            }
            echo "</table>";
            $mysqli->close();
        ?>

        <!-- Demande à l'utilisateur s'il veut ajouter un article ou non -->
        <div class="ajart">
            <p>Vous voulez ajouter un article ?</p>
            <p>Vous voulez ajouter un commentaire ?</p>
            <p>Si oui, <a href="register_form.php">Incrivez-vous</a> ou <a href="login_form.php">Connectez-vous</a> !</p>
        </div>

    </body>
</html>