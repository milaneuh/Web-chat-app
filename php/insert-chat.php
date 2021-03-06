<?php 
    session_start();
    if(isset($_SESSION['session_id'])){
        include_once "config.php";

        $outgoing_id = $_SESSION['session_id'];
        $incoming_id = validate(trim($pdo->quote($_POST['incomming_id']),"'"));
        $message = validate(trim($pdo->quote($_POST['message']),"'"));

        if(!empty($message)){
            $result = $pdo->prepare("INSERT INTO messages (user_receiver_id, user_sender_id, message)
            VALUES (?, ?, ?)") or die();

            $result->execute(array($incoming_id,$outgoing_id,$message));
        }


    }else{
        header("location: ../login.php");
    }
?>