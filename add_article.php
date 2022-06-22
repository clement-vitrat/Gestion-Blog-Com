<?php

    //ETAPE 1 : Récupération des données du formulaire : $_POST
    $titre = $_POST["titre"]; 
    $corps = $_POST["corps"];

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
    //Création de la requete pour créer un nouvel article
    $rqt = "INSERT INTO article(titre, corps, created_at, id_utilisateur) VALUES (:titre, :corps, :created_at, :id_utilisateur);"; 

    try {
        $requete_preparee = $bdd->prepare($rqt); 
        // Associer les paramètres : 
        $requete_preparee->bindParam(":titre", $titre); 
        $requete_preparee->bindParam(':corps', $corps); 
        $requete_preparee->bindParam(':created_at', date('Y-m-d'));
        $requete_preparee->bindParam(':id_utilisateur', $id_user);
        $requete_preparee->execute();
    } catch (Exception $e) {
        if($e->getCode() == 23000 ) {      //Le code 23000 correspond à une entrée dupliquée: cela signifie que l'adresse mail est déjà en bdd
            redirect_with_error("add_article_form.php","duplicate");
        }
    }

    // Une fois que l'on ajoute un article, on revient sur la page de nos articles
    header('Location: dashboard.php');

?>