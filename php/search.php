<?php
    session_start();
    include_once "config.php";


    $receiver_id = $_SESSION['session_id'];
    $search = $pdo -> quote($_POST['search']);
    $output = "";

    $response = $pdo->prepare("SELECT * FROM users WHERE NOT session_id = ? AND (username LIKE ?)");
    $response->execute(array($receiver_id,$search));
    
    $data = $response->fetch();

    if( !is_null($data)){
        include_once "data.php";
    }else{
        $output .= 'Aucun utilisateur trouvé.';
    }
    echo $output;
?>

