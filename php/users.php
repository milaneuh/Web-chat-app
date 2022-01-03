<?php
    try{
    session_start();
    include_once "config.php";

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
        $output .= $exception;
    }
    echo $output;
?>
