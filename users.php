<?php
    session_start();
    if(!isset($_SESSION['session_id'])){
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

    <!-- On récupère les informations de l'utilisateur enregistré dans la session --> 
    <?php
        include_once "php/config.php";
        $result = $pdo->prepare("SELECT * FROM users WHERE session_id = ? ");
        $result->execute(array($_SESSION['session_id']));
        $data = $result->fetch();  
 
    ?>

    <section class="users">
        <header>

            <!-- Bouton de déconnexion -->
            <a href="php/logout.php?logout_id=<?php echo $data['session_id']; ?>" class="logout">
               <span class="material-icons" style="font-size: 30px; padding: 0">
                power_settings_new
                </span>
            </a>

            <!-- Affichage des informations de l'utilisateur de la session -->
            <div class="content">
                <img src="php/images/<?php echo $data['img']?>" alt="">
                <div class="details">
                    <span><?php echo $data['username'] ?></span>
                    <p><?php echo $data['status'] ?></p>
                </div>
            </div>
        </header>

        <!-- Barre de recherche -->
        <div class="search">
            <span class="text">Entrez un nom à chercher ... </span>
            <input type="text" placeholder="Entrez un nom à chercher ...">
            <button><i class="fas fa-search"></i></button>
        </div>

        <!-- Div qui contiendra les utilisateurs disponibles -->
        <div class="usersList">
            
        </div>
    </section>
</div>
<script src="javascript/users.js"></script>
</body>
</html>