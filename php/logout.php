<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        //Si un utilisateur est connecté alors on arrive ici, sinon on va sur la page de login
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn,$_GET['logout_id']);
        if(isset($logout_id)){
            //Si on a un identifiant de déconnexion :
            $status = "Offline now";
            //Quand l'utilisateur se déconnecte on change son status en offline et on l'envois sur le formulaire de
            //login. Si il se login alors on change son status en active
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$logout_id}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
        }else{
            header("location: ../users.php");
        }
    }else{
        header("location: ../login.php");
    }

?>
