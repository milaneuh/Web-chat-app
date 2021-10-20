<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location : login.php");
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ProjetAnnexe</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <?php
        include_once "php/config.php";
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
        }
    ?>
    <section class="users">
        <header>
            <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">
               <span class="material-icons" style="font-size: 30px; padding: 0">
                power_settings_new
                </span>
            </a>
            <div class="content">
                <img src="php/images/<?php echo $row['img']?>" alt="">
                <div class="details">
                    <span><?php echo $row['username'] ?></span>
                    <p><?php echo $row['status'] ?></p>
                </div>
            </div>
        </header>
        <div class="search">
            <span class="text">Entrez un nom à chercher ... </span>
            <input type="text" placeholder="Entrez un nom à chercher ...">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="usersList">
            
        </div>
    </section>
</div>
<script src="javascript/users.js"></script>
</body>
</html>