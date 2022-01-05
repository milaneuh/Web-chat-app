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

        //Prépatation de la requête
        $response = $pdo->prepare("SELECT * from users WHERE NOT session_id = ? ");
        //Éxecution de la requête
        $response->execute(array($receiver_id));
    
        //Si la réponse n'est pas nulle 
        if($response->fetch() !=null){
            //On renvois data.php, qui s'occupe d'intégrer les données récupérées
            //dans une div HTML
            include "data.php";
        }else{
            //Si la réponse est nulle, on renvois une erreur;
            $output .= "Aucun utilisateurs disponible pour chat";
        }
    }catch (PDOException $exception){
        $output .= 'Erreur de connexion à la base de données';
    }
    echo $output;
?>