<?php 
    //Démarrage de session
    session_start();

    if(isset($_SESSION['session_id'])){
        //Si un utilisateur est connecté à la session :
        include_once "config.php";

        $outgoing_id = $_SESSION['session_id'];
        $incoming_id =validate(trim( $pdo->quote($_POST['incoming_id']),"'"));
        $output = "";

        //On récupère tous les message la table message et tous les user_id de la table users
        //si l'utilisateur à déjà envoyé un message:
        //  - On récupère tous les message où les identifiants des message == l'identifiants de 
        //    l'utilisateur de la session locale ou l'identifiant de l'utilisateur de la session
        //    avec laquelle on envois un message (Identifiant récupéré grâce à Ajax)
    
        $result = $pdo->prepare("SELECT * FROM messages 
        LEFT JOIN users ON users.session_id = messages.user_sender_id
        WHERE (user_sender_id = ? AND user_receiver_id = ?)
        OR (user_sender_id = ? AND user_receiver_id = ?) ORDER BY message_id");

        $result->execute(array($outgoing_id,$incoming_id,$incoming_id,$outgoing_id));

      


            while( $data = $result->fetch()){
                if(sizeof($data) >= 1){
                    //Si on a récupéré au minimum 1 message : 
        
                    if($data['user_sender_id'] === $outgoing_id){
                        //Si c'est un message envoyé :

                        $output .= '<div class="chat sent">
                                    <div class="details">
                                        <p>'. $data['message'] .'</p>
                                    </div>
                                    </div>';
                    }else{
                        //Si c'est un message reçu :
                        
                        $output .= '<div class="chat received">
                                    <img src="php/images/'.$data['img'].'" alt="">
                                    <div class="details">
                                        <p>'. $data['message'] .'</p>
                                    </div>
                                    </div>';
                    }
                }else{
                    $output .= '<div class="text">Aucun messages disponible.</div>';
                }
            }
       
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>