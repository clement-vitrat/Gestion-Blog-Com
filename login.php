<?php
    
    //APPEL du fichier avec les différentes fonctions
    include_once('utils.php');

    //ETAPE 1 : Récupération des données dd formulaires : $_POST
    $email = $_POST["email"]; 
    $password = $_POST["password"];

    //ETAPE 2 : CONNEXION à la base 
    try {
        include_once('bdd.php');
        $bdd_options = ["PDO::ATTR_ERR_MODE" => PDO::ERRMODE_EXCEPTION];
        $bdd = new PDO("mysql:host=localhost;dbname=$db_name;port=$db_port", $db_user, $db_pass, $bdd_options); 
    } catch(Exception $e) {
        // On affiche les erreurs relative à la BDD SEULEMENT EN DEV!!!!!!
        echo $e->getMessage();
        http_response_code(500);
        exit; 
    }

    //ETAPE 3 : Récupération de l'utilisateur (*) à partir de son email 
    $rqt = "SELECT * FROM utilisateur WHERE email=:email"; 
    try {
        $requete_preparee = $bdd->prepare($rqt); 
        $requete_preparee->bindParam(':email', $email); 
        $requete_preparee->execute(); 
        $user = $requete_preparee->fetch(PDO::FETCH_ASSOC);
    } catch(Exception $e) {
        // On affiche les erreurs relative à la BDD SEULEMENT EN DEV!!!!!!
        echo $e->getMessage();
        http_response_code(500);
        exit; 
    }
    if(empty($user)) {
        redirect_with_error("login_form.php", "invalid");
    }

    //ETAPE 4 : Vérification du mot de passe
    $hash = $user["password"]; 

    if(!password_verify($password, $hash)) {
        // 4.1 : si erreur on lui indique 
        redirect_with_error("login_form.php", "invalid");
    } 
    //Création de la variable utilisateur connecté pour la session en cours
    else{
        session_start();
        $_SESSION["user"] = $user["email"];
        $_SESSION["id_user"] = $user["id"];
    }

    //Si ok on l'envoi sur une page de succes (genre dashboard)
    header('Location: dashboard.php');

?>