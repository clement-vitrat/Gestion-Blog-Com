<?php 

    //Création des différents codes d'erreurs
    $errors =  [
        "empty" => "<p class='errors'>Tous les champs doivent être renseignés</p>",
        "password" => "<p class='errors'>Les mots de passes doivent être identiques</p>", 
        "email" => "<p class='errors'>L'email est mal formé</p>", 
        "duplicate" => "<p class='errors'>Cette adresse email est déjà enregistrée</p>", 
        "invalid" => "<p class='errors'>Adresse mail ou mot de passe invalide</p>", 
        "invalid_pass" => "<p class='errors'>Le mot de passe doit contenir au moins 8 caractères, une lettre min et maj, un chiffre, un caractère spécial</p>"
    ];

    /**
     * Redirige vers la page indiquée en paramètre, en donnant en paramètre (GET) un status=error et le type d'erreur 
     * 
     * Les types d'erreurs sont : 
     *  - empty : un des champs est vide
     *  - email : l'email est mal formée
     *  - password : le mot de passe ne correspond pas à sa confirmation
     *  - ... 
     * Attention, l'appel à cette fonction quitte le script en cours 
     * 
     * @param string $location l'url de redirection 
     * @param string $error La clé de l'erreur que l'on renvoie
     * @return void
     */
    function redirect_with_error(string $location, string $error ) {
        header("Location: $location?status=error&error=$error");
        exit; //

    }

    /**
     * Vérifie s'il existe une erreur passée en paramètre (GET) du script et affiche un élément HTML (div) contenant l'erreur
     *
     * @return void
     */
    function check_and_display_error() {
        // Pas très beau, mais fonctionnel ! Challenge : trouvez comment faire mieux !!!
        global $errors; // On rappelle la variable globale $errors définie plus haut
        if(!empty($_GET["error"])) {
            $err = $_GET["error"]; 
            echo "<div class='error'>";
            echo $errors[$err];
            echo "</div>";
        }
    }

    /**
     * Indique si le mot de passe respecte les règles suivantes : 
     *  - au moins huit caractères
     *  - au moins une lettre majuscule
     *  - au moins une lettre miniscule 
     *  - au moins chiffre
     *  - au moins un caractère spécial
     *
     * @param string $password
     * @return boolean true si le mot passe de respecte les règles
     */
    function isValidPassword(string $password) {
        $hasNum = false; 
        $hasMaj = false; 
        $hasMin = false; 
        $hasSpec = false; 
        $isLongEnought = strlen($password) >= 8; 
        $spec_char = ",;:!ù*=)_-('\"é&² ~#{[|`\\^@]}¤?.$/§%µ+°";

        for($i = 0; $i < strlen($password); $i++) {
            $char = $password[$i];
            if($char >= 'A' && $char <= 'Z') {
                $hasMaj = true;
            }
            if($char >= 'a' && $char <= 'z') {
                $hasMin = true;
            }
            if($char >= '0' && $char <= '9') {
                $hasNum = true;
            }
            if(strstr($spec_char, $char)) {
                $hasSpec = true; 
            }
        } 

        return $hasMaj && $hasMin && $hasNum && $hasSpec && $isLongEnought; 
    }



    /** 
     * Création d'une fonction pour lister les différents articles
     */
    function liste_articles() {
        //Création d'une varaible pour récupérer l'id de l'utilisateur
        $id_user = $_SESSION["id_user"];
        //Connexion à la Base de données "projetfs_com"
        $mysqli = new mysqli("localhost", "root", "", "projetfs_com");
        $mysqli->set_charset("utf8");
        //Requete de la base de données projetfs_com pour récupérer les articles créé par l'utilisateur connecté
        $requete = "SELECT a.id,titre,corps,created_at,updated_at,id_utilisateur FROM article a JOIN utilisateur u ON a.id_utilisateur=u.id WHERE u.id=$id_user;";
        $resultat = $mysqli->query($requete);
        echo"<table>
            <caption>Liste de mes articles</caption>
            <thead>
                <tr>
                    <th>Titre de l'article</th>
                    <th>Corps de l'article</th>
                    <th style='text-align:center;'>Date de Créa</th>
                    <th style='text-align:center;'>Date de Modif</th>
                </tr>
            </thead>" ;
        //Affichage des différents articles de l'utilisateur connecté
        while ($row = $resultat->fetch_assoc()) {
            $id_art = $row["id"];
            echo "<tbody>
                <tr>
                    <td>". $row['titre'] . "</td>
                    <td> ". $row['corps'] . "</td>
                    <td style='text-align:center;'> ". $row['created_at'] . "</td>
                    <td style='text-align:center;'> ". $row['updated_at'] . "</td>
                    <td> " . "<a href='modif_article_form.php?id_article=$id_art'><i class='fa-solid fa-pen-to-square'></i></a>" . "</td>
                </tr>
                </tbody>";
        }
        echo "</table>";
        $mysqli->close();
    }

?>