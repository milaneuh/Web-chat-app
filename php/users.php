<?php
    try{
        session_start();
        include "config.php";
        //On récupère l'identifiant de l'utilisateur connecté
        $receiver_id = $_SESSION['session_id'];
        $output = "";

        //Préparation de la requête
        $response = $pdo->prepare("SELECT * from users WHERE NOT session_id = ?");
        //Éxecution de la requête
        $response->execute(array($receiver_id));
        $data = $response->fetch();
        if(!is_null($data)){
            include "data.php";
        }else{
            $output .= "Aucun utilisateur disponible pour chat";
        }
    }catch (PDOException $exception){
        $output .= 'Erreur de connexion à la base de données';
    }
    echo $output;
?>
