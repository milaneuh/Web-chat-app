

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
 
-- Base de données du Projet annexe --

-- -------------------------------------------------------- --


-- Structure de la table MESSAGES --

  CREATE DATABASE chat;
  
  USE chat;
  
  CREATE TABLE `message` (
    `message_id` int(11) NOT NULL PRIMARY AUTO_INCREMENT,
    `receiver_id` int(255) NOT NULL,
    `sender_id` int(255) NOT NULL,
    `message` varchar(1000) NOT NULL
  )

-- Insertion de données de la table `message` --


  INSERT INTO `message` (`message_id`, `receiver_id`, `sender_id`, `message`) VALUES
  (1, 1305878197, 1564951526, 'hello !'),
  (2, 1564951526, 1305878197, 'Coucou ! ça va bien ?'),
  (3, 1305878197, 1564951526, 'ça va et toi ?');








-- -------------------------------------------------------- --


-- Création de la table `users` --

  CREATE TABLE `users` (
    `user_id` int(11) NOT NULL PRIMARY AUTO_INCREMENT,
    `unique_id` int(11) NOT NULL,
    `username` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `img` varchar(400) NOT NULL,
    `sta  tus` varchar(255) NOT NULL
  )

-- -------------------------------------------------------- --


-- Déchargement des données de la table `users` --

  INSERT INTO `users` (`user_id`, `unique_id`, `username`, `email`, `password`, `img`, `status`) VALUES
  (1, 1564951526, 'milan', 'toto@gmail.com', 'root', '1634458569pp.png', 'Offline now'),
  (2, 1305878197, 'milan', 'abc@gmail.com', 'root', '1634464040image.jpg', 'Active now'),
  (3, 171179028, 'Joe', 'crazylancss@gmail.com', 'password', '1634562662tumblr_2ff1df976b9c22d8b63abcb10cc99eb0_6cba27ec_1280.png', 'Offline now');
