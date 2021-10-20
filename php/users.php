<?php
    session_start();
    include_once "config.php";
    $receiver_id = $_SESSION['unique_id'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$receiver_id}");
    $output = "";

    if(mysqli_num_rows($sql) == 1){
        $output .= "Aucun utilisateurs disponible pour chat";
    }elseif(mysqli_num_rows($sql) > 0){
       include "data.php";
    }
    echo $output;
?>