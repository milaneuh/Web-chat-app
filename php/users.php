<?php
    try{
        session_start();
        // Création du DSN
        $dsn = 'mysql:host=localhost;dbname=chat;port=3306;charset=utf8';
  
        // Création et test de la connexion
        $pdo = new PDO($dsn,'root','');
        
        //On récupère l'identifiant de l'utilisateur connecté
        $receiver_id = $_SESSION["session_id"];
        $output = "";

    $receiver_id = $_SESSION["unique_id"];
    $output = "";

    //Préparation de la requête
    $response = $pdo->prepare("SELECT * from users WHERE NOT unique_id = ? ");
    //Éxecution de la requête
    $response->execute(array($receiver_id));
 
    if($response->fetch() !=null){
        include "data.php";
    }else{
        $output .= "Aucun utilisateurs disponible pour chat";
    }
    }catch (PDOException $exception){
        $output .= 'Erreur de connexion à la base de données';
    }
    echo $output;
?>
