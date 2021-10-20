<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);



    if(!empty($email) && !empty($username) && !empty($password) &&!empty($confirmPassword)){
        //Si tous les champs sont bien inscrits : 

        //Check si l'email est valide
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //Check si email déjà existant dans la database
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                //Si l'email est déjà existant dans la base de données :
                echo "$email - Cet email est déjà utilisé !";
            }else{
                //Check si l'utilisateur a bien rentrée une image
                if(isset($_FILES['image'])){
                    //Si le fichier est inscrit
                    $img_name = $_FILES['image']['name']; //On récupère le nom de l'image
                    $img_type = $_FILES['image']['type']; //On récupère le type de l'image
                    $tmp_name = $_FILES['image']['tmp_name']; //Ce nom temporaire est utilisé pour sauvegarder/ou modifier l'emplacement de fichier dans notre dossier
                    

                    //On récupère l'extension
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode); //Ici on récupère l'extension de l'image

                    $extension = ['png', 'jpeg', 'jpg']; //Une liste de toutes les extensions valides
                   
                    if(in_array($img_ext,$extension) == true){
                        //Si l'extension de l'image de l'utilisateur matche avec nos extensions valide :
                        $time = time(); //On récupère le timestamp
                                       //On a besoin de ça pour remplacer le nom de l'image avec le timestamp
                                       //comme ça toutes les images ont un nom unique.
                                         //On met l'image dans notre dossier
                        $new_img_name = $time.$img_name;
                        if($password === $confirmPassword){
                            if(move_uploaded_file($tmp_name,"images/".$new_img_name)){ 
                                //Si le transfers de l'image vers notre dossier est un succés :
                                $status = "Active now"; //Si l'utilisateur a correctement inscrit ses donénes alors son status sera actif
                                $random_id = rand(time(),10000000); //Création d'un id random pour l'utilisateur

                                //On insère nos données dans la database
                                $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, username, email, password, img, status)
                                VALUES ({$random_id},'{$username}','{$email}','{$password}','{$new_img_name}','{$status}')");
                                if($sql2){
                                    //Si les données se sont bien enregistrée
                                    $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                    if(mysqli_num_rows($sql3) > 0){
                                        $rows = mysqli_fetch_assoc($sql3);
                                        $_SESSION['unique_id'] = $rows['unique_id'];
                                        echo "success";
                                    }
                                }else{
                                    echo "Impossible d'enregistrer l'utilisateur";
                                }      
                            }
                        }else{
                            echo "Le mot de passe et la confirmation de mot de passe doivent être égaux !";
                        }
                    }else{
                        echo "Veuillez choisir une extension d'image supportée par l'application";
                    }
                }else{
                    echo "Veuillez choisir une image !";
                }
            }
        }else{
            echo "Cet email n'est pas valide !";
        }
    }else{
        echo "Tous les champs sont requis !";
    }
?>