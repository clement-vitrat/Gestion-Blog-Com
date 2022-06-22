<?php

    //ETAPE 1 : Récupération des données du formulaire : $_POST
    $titre = $_POST["titre"]; 
    $corps = $_POST["corps"];
    $id = $_POST["id_article"];

    
    //CONNEXION à la base de donnée
    require_once('bdd.php');
    try {
        $bdd_options = ["PDO::ATTR_ERR_MODE" => PDO::ERRMODE_EXCEPTION];
        $bdd = new PDO("mysql:host=localhost;dbname=$db_name;port=$db_port", $db_user, $db_pass, $bdd_options); 
    } catch(Exception $e) {
        echo $e->getMessage();
        exit;
    }


    //MISE A JOUR D'UN ARTICLE DANS LA BASE DE DONNEES
    //Requete de la base de données projetfs_com pour mettre à jour l'article sélectionné
    $rqt = "UPDATE article SET titre=:titre, corps=:corps, updated_at=:updated_at WHERE id=:id  "; 

    //Variable pour déterminer la date actuelle
    $today = date('Y-m-d');

    try {
        $requete_preparee = $bdd->prepare($rqt); 
        // Associer les paramètres : 
        $requete_preparee->bindParam(":id", $id);
        $requete_preparee->bindParam(":titre", $titre); 
        $requete_preparee->bindParam(":corps", $corps); 
        $requete_preparee->bindParam(":updated_at", $today);
        $requete_preparee->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
        if($e->getCode() == 23000 ) { // Le code 23000 correspond à une entrée dupliquée :cela signifie que l'adresse mail est déjà en bdd
            redirect_with_error("modif_article_form.php","duplicate");
        }
    }
    

    // Une fois que l'article mis à jour, on revient sur la page de nos articles
    header('Location: dashboard.php');

?>