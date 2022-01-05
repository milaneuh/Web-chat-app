<?php 
    session_start();
    if(isset($_SESSION['session_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['session_id'];
        $incoming_id = $pdo->quote($_POST['incomming_id']);
        $message = $pdo->quote($_POST['message']);
        if(!empty($message)){
            $result = $pdo->prepare("INSERT INTO message (receiver_id, sender_id, message)
            VALUES (?, ?, ?)") or die();

            $result->execute(array($incoming_id,$outgoing_id,$message));
        }


    }else{
        header("location: ../login.php");
    }
?>