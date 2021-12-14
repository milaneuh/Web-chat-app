<?php
    //Démarrage de session
    session_start();
    try {
        //On récupère nos identifiants administrateur de la base de données
        include_once "config.php";

        //On récupère les données récupérée grâce à Ajax
        $email = $pdo -> quote($_POST['email']);
        $password = $pdo -> quote( $_POST['password']);


        if(!empty($email) && !empty($password)){
            //Si tous les champs sont bien inscrits : 
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                //Check si l'email & password matchent avec un compte utilisateur dans la base de données
                $response = $pdo->prepare("SELECT * FROM users WHERE email = ?");
                $response->execute(array(trim($email,"'")));

                while($data = $response->fetch()){
                    if($data != null){
                        if(password_verify($password, $data['password'])){
                            //On change le status de l'utilisateur
                            $status = "Active now";
                            try{
                                $response = $pdo->prepare("UPDATE users SET status = ? WHERE unique_id = ?");
                                $response->execute(array($status,$data['unique_id']));
                                    //Si le changement s'est bien passé :
                                    //On connecte l'utilisateur dans la session et on renvois le message de succés 
                                    $_SESSION['unique_id'] = $data['unique_id'];
                                    echo "success";
                            }catch(PDOException $exception){
                                echo "Erreur dans l'enregistrement des données";
                            }
                        }else{
                            echo "Le mot de passe est incorrect.";
                        }
                    }else{
                        echo "Aucun utilisateur correspondant.";
                    }
                }
            }else{
                echo "Cet email est invalide!";
            }
        }else{
            echo "Tous les champs sont requis!";
        }
    } catch(PDOException $exception){
        echo "Impossible de se connecter.";
    }
   

?>