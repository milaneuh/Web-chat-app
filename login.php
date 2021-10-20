<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ProjetAnnexe</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>
<body>
<div class="wrapper">
    <section class="form login">
        <header>Sign In</header>
        <!-- ------------------------------ -->
        <!-- ---FORMULAIRE DE CONNEXION---- -->
        <!-- ------------------------------ -->

        <form action="#">
            <!-- MESSAGE D'ERREUR -->
            <div class="errorTxt">
                This is an error message
            </div>

            <!-- INPUT EMAIL -->
            <div class="input">
                <div class="fields">
                    <input type="email" placeholder="Email" name="email">
                </div>
            </div>
            
            <!-- INPUT PASSWORD -->
            <div class="input">
                <div class="fields">
                    <input type="password" placeholder="Password" name="password">
                </div>
            </div>

            <!-- BOUTON DE CONNEXION -->
            <div class="fields button">
                <input type="submit" value="SIGN IN">
            </div>
        </form>
        
        <!-- BOUTON DE CREATION DE COMPTE -->
        <div class="link"><a href="index.php">Create New Account</a></div>
    </section>
</div>
<script src="javascript/login.js"></script>
</body>
</html>