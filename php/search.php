<?php
    session_start();
    include_once "config.php";
    $receiver_id = $_SESSION['unique_id'];
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $output = "";

    $sql = "SELECT * FROM users WHERE NOT unique_id = {$receiver_id} AND (username LIKE '%{$search}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'Aucun utilisateur trouvé.';
    }
    echo $output;
?>

