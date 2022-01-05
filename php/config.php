<?php
  // Création du DSN
  $dsn = 'mysql:host=localhost;dbname=chat;port=3306;charset=utf8';
  
  // Création et test de la connexion
  
  try {
      $pdo = new PDO($dsn,'root','');
  }
  catch (PDOException $exception) {
      exit('Erreur de connexion à la base de données');
  } 

    //Protection face aux injections SQL
    function validate($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data,ENT_QUOTES);
      return $data;
    }
  ?>