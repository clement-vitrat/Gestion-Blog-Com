<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tous les articles</title>
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
                <li><a href="dashboard.php">Accueil</a></li>
                <li><a href="add_article_form.php">Ajouter un article</a></li>
                <li><a href="com_articles_affiche.php" class="active">Tous les articles</a></li>
                <li><a href="deconnecter.php">Se déconnecter</a></li>
            </ul>
        </nav>
   

        <?php
            session_start();
        ?>
        

        <!-- CREATION DU TABLEAU AFFICHANT TOUS LES ARTICLES ET LES COMMENTAIRES AVEC LE NOM DU CREATEUR -->
        <?php
            //Création d'une varaible pour récupérer l'id de l'utilisateur
            $id_user = $_SESSION["id_user"];

            //Connexion à la Base de données "projets_com"
            $mysqli = new mysqli("localhost", "root", "", "projetfs_com");
            $mysqli->set_charset("utf8");

            //Requete de la base de données projets_com pour récupérer tous les articles
            $requete_art = "SELECT a.id,titre,corps,created_at,updated_at,email FROM article a JOIN utilisateur u ON a.id_utilisateur=u.id;";
            $resultat_art = $mysqli->query($requete_art);

            //Création de l'en-tete du tableau         
            echo"<table>
                <caption>Liste des articles</caption>
                <thead>
                    <tr>
                        <th>Titre de l'article / Commentaire</th>
                        <th>Corps de l'article / Texte du Commentaire</th>
                        <th style='text-align:center;'>Date de Créa</th>
                        <th style='text-align:center;'>Date de Modif</th>
                        <th>Utilisateur</th>
                        <th></th>
                    </tr>
                </thead>" ;

            //Affichage des différents articles et des commentaires de tous les utilisateurs
            while ($row_art = $resultat_art->fetch_assoc()) {
                $id_art = $row_art["id"];
                echo "<tbody>
                    <tr>
                        <td class='articles'>". $row_art['titre'] . "</td>
                        <td class='articles'> ". $row_art['corps'] . "</td>
                        <td class='articles' style='text-align:center;'> ". $row_art['created_at'] . "</td>
                        <td class='articles' style='text-align:center;'> ". $row_art['updated_at'] . "</td>
                        <td class='articles'> " . $row_art['email'] . "</td>";
                        //Création du boutton pour créer un commentaire
                        echo "<td style='padding: 5px 5px; text-align: center;'> " . "<a href='com_add_articles_form.php?id_article=$id_art'><i class='fa-solid fa-comment'></i></a>" . "</td>
                    </tr>";

                    //Requete de la base de données projets_com pour récupérer les commentaires
                    $requete_com = "SELECT c.id AS id, texte, created_at, updated_at, id_article, id_utilisateur, email FROM commentaire c JOIN utilisateur u ON c.id_utilisateur=u.id WHERE id_article=$id_art;";
                    $resultat_com = $mysqli->query($requete_com);

                    //Affichage des différents commentaires des articles correspondants
                    while ($row_com = $resultat_com->fetch_assoc()) {
                        $id_com = $row_com['id'];
                        echo "<tr>
                            <td class='commentaire'>Commentaire</td>
                            <td class='commentaire'>". $row_com['texte'] . "</td>
                            <td class='commentaire' style='text-align:center;'> ". $row_com['created_at'] . "</td>
                            <td class='commentaire' style='text-align:center;'> ". $row_com['updated_at'] . "</td>
                            <td class='commentaire'> " . $row_com['email'] . "</td>";
                            //Si l'utilisateur connecté afficher un stylo pour modifier un commentaire
                            if ($row_com['id_utilisateur'] == $id_user) {
                                echo "<td class='commentaire' style='padding: 5px 5px; text-align: center;'> " . "<a href='com_modif_articles_form.php?id_commentaire=$id_com'><i class='fa-solid fa-pen-clip'></i></a>" . "</td>";
                            }
                        echo "</tr>";
                    }
                    
                    //Ligne pour séparation entre les articles
                    echo "<tr>
                            <td style='background: #e0e0e0;'></td>
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

        <!-- Demande à l'utilisateur s'il veut ajouter ou modifier un commentaire -->
        <div class="ajart">
            <h1 class="deconnecte" style="margin:0px;">Vous voulez ajouter un commenaire ?</h1>
            <p>Si oui, appuyez sur l'icone <i class='fa-solid fa-comment' style="color:rgb(150, 76, 23);"></i>.</p>
            <h1 class="deconnecte" style="margin-top:10px;">Vous voulez modifier un commentaire ?</h1>
            <p>Si oui, appuez sur l'icone <i class='fa-solid fa-pen-clip' style="color:rgb(150, 76, 23);"></i>.</p>
        </div>

    </body>
</html>