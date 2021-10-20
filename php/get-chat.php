<?php 
    //Démarrage de session
    session_start();

    if(isset($_SESSION['unique_id'])){
        //Si un utilisateur est connecté à la session :
        include_once "config.php";

        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";

        //On récupère tous les message la table message et tous les user_id de la table users
        //si l'utilisateur à déjà envoyé un message:
        //  - On récupère tous les message où les identifiants des message == l'identifiants de 
        //    l'utilisateur de la session locale ou l'identifiant de l'utilisateur de la session
        //    avec laquelle on envois un message (Identifiant récupéré grâce à Ajax)
        $sql = "SELECT * FROM message 
                LEFT JOIN users ON users.unique_id = message.sender_id
                WHERE (sender_id = {$outgoing_id} AND receiver_id = {$incoming_id})
                OR (sender_id = {$incoming_id} AND receiver_id = {$outgoing_id}) ORDER BY message_id";
        $query = mysqli_query($conn, $sql);

        if(mysqli_num_rows($query) > 0){
            //Si on a récupéré au minimum 1 message : 

            while($row = mysqli_fetch_assoc($query)){
                if($row['sender_id'] === $outgoing_id){
                    //Si c'est un message envoyé :

                    $output .= '<div class="chat sent">
                                <div class="details">
                                    <p>'. $row['message'] .'</p>
                                </div>
                                </div>';
                }else{
                    //Si c'est un message reçu :
                    
                    $output .= '<div class="chat received">
                                <img src="php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'. $row['message'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">Aucun message disponible.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>