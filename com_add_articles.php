<?php

    //ETAPE 1 : Récupération les données du formulaire : $_POST
    $texte = $_POST["texte"];
    $id_article = $_POST["id_article"];    


    //CONNEXION à la base de donnée
    require_once('bdd.php');
    try {
        $bdd_options = ["PDO::ATTR_ERR_MODE" => PDO::ERRMODE_EXCEPTION];
        $bdd = new PDO("mysql:host=localhost;dbname=$db_name;port=$db_port", $db_user, $db_pass, $bdd_options); 
    } catch(Exception $e) {
        echo $e->getMessage();
        exit;
    }


    //Préparation de la requête d'insertion dans la base de données
    session_start();
    $id_user = $_SESSION["id_user"];

    //Création de la requete pour créer un nouveau commentaire
    $rqt = "INSERT INTO commentaire(texte, created_at, id_utilisateur, id_article) VALUES (:texte, :created_at, :id_utilisateur, :id_article);"; 

    //Variable pour déterminer la date actuelle
    $day = date('Y-m-d');

    try {
        $requete_preparee = $bdd->prepare($rqt); 
        // Associer les paramètres : 
        $requete_preparee->bindParam(":texte", $texte); 
        $requete_preparee->bindParam(':created_at', $day); 
        $requete_preparee->bindParam(":id_utilisateur", $id_user); 
        $requete_preparee->bindParam(":id_article", $id_article); 
        $requete_preparee->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
        if($e->getCode() == 23000 ) { // Le code 23000 correspond à une entrée dupliquée :cela signifie que l'adresse mail est déjà en bdd
            redirect_with_error("com_add_articles_form.php","duplicate");
        }
    }


    // Une fois que l'on ajoute un article, on revient sur la page de nos articles
    header('Location: com_articles_affiche.php');

?>