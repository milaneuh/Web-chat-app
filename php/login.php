<?php
    //Démarrage de session
    session_start();
    
    //On récupère nos identifiants administrateur de la base de données
    include_once "config.php";

    //On récupère les données récupérée grâce à Ajax
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($email) && !empty($password)){
        //Si tous les champs sont bien inscrits : 

        //Check si l'email & password matchent avec un compte utilisateur dans la base de données
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");

        if(mysqli_num_rows($sql) >0){
            //Si on a un match :

            $rows = mysqli_fetch_assoc($sql);

            //On change le status de l'utilisateur
            $status = "Active now";
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$rows['unique_id']}");
            if($sql2){
                //Si le changement s'est bien passé :

                //On connecte l'utilisateur dans la session et on renvois le message de succés 
                $_SESSION['unique_id'] = $rows['unique_id'];
                echo "success";
            }
        }else{
            echo "Les identifiants sont incorrect !";
        }
    }else{
        echo "Tous les champs sont requis !";
    }
?>