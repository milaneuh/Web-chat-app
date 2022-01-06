<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['session_id'])){
    header("location: login.php");
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
    <section class="chat-area">
      <header>

        <?php 
            $user_id = $pdo->quote($_GET['user_id']);
            $result = $pdo->prepare("SELECT * FROM users WHERE session_id = ? ");
            $result->execute(array(trim($user_id, "'")));
            $data = $result->fetch();
            if(!$data['username'] &&  !$data['status']){
              throw new Exception("No match was found in the database.");
            }else{
          ?>

        <a href="users.php" class="back-arrow"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $data['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $data['username'] ?></span>
          <p><?php echo $data['status']; } ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Ecrivez votre message ici ..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>

  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>