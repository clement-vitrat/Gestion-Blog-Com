<?php 

    //APPEL du fichier avec les différentes fonctions
    include_once('utils.php'); 

    //ETAPE 1 : Traitement des champs de formulaire
    if( empty($_POST['email']) || empty($_POST['password']) || empty($_POST['conf_password'])) {
        // Informer que les champs sont vides 
        redirect_with_error("register_form.php", "empty");
    }
    //Récupération des données du formulaires : $_POST
    $email = $_POST['email']; 
    $password = $_POST['password'];
    $conf = $_POST['conf_password']; 

    //ETAPE 2 : Validation de la conformité de l'email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL )) {
        redirect_with_error("register_form.php","email");
    }

    //ETAPE 3 : Vérification que la confirmation est correcte
    if($_POST["password"] !== $_POST["conf_password"]) {
        redirect_with_error("register_form.php","password"); 
    } if(!isValidPassword($password)) {
        redirect_with_error("register_form.php","invalid_pass"); 
    }

    //ETAPE 4 : Hasher le mot de passe 
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
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
    $rqt = "INSERT INTO utilisateur(email, password) VALUES (:email, :password);"; 

    try {
        $requete_preparee = $bdd->prepare($rqt); 
    
        // Associer les paramètres : 
        $requete_preparee->bindParam(":email", $email); 
        $requete_preparee->bindParam(':password', $hash); 
        $requete_preparee->execute();
    } catch (Exception $e) { 
        if($e->getCode() == 23000 ) { // Le code 23000 correspond à une entrée dupliquée :cela signifie que l'adresse mail est déjà en bdd
            redirect_with_error("register_form.php","duplicate");
        }
    }
    
    // Une fois que l'on a CREE un compte, on est REDIRIGE vers la page de CONNEXION
    header('Location: login_form.php?status=registered');

?>