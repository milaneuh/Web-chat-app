<?php
    session_start();
    include_once "config.php";
    $email = trim($pdo -> quote($_POST['email']), "'");
    $username = trim($pdo -> quote($_POST['username']), "'");
    $password = trim($pdo -> quote( $_POST['password']), "'");
    $confirmPassword = trim($pdo -> quote( $_POST['confirmPassword']), "'");
        
    
    if(!empty($email) && !empty($username) && !empty($password) && !empty($confirmPassword)){
                //Si tous les champs sont bien inscrits : 

                //Verification de la validité de l'email
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    
                    //Verification de la présence de l'email dans la BDD:
                    //Prépatation de la requête
                    $response = $pdo->prepare('SELECT * from users WHERE email = ?');
                    //Éxecution de la requête
                    $response->execute([$email]);
                    //Analyse de la reponse, si $reponse possède un email alors 
                    //l'utilisateur possède déjà un compte
                    $data = $response->fetch();
                    $data['email'] ??= 'unused';

                    if($data['email'] == 'unused'){
                        //On vérifie si l'utilisateur a bien rentré une image
                        if(isset($_FILES['image'])){
                            //Si il y a bien une image:
                            
                            $img_name = $_FILES['image']['name']; //On récupère le nom de l'image
                            $img_type = $_FILES['image']['type']; //On récupère le type de l'image
                            $tmp_name = $_FILES['image']['tmp_name']; //Ce nom temporaire est utilisé pour sauvegarder/ou modifier l'emplacement de fichier dans notre dossier
                            

                            //On récupère l'extension
                            $img_explode = explode('.',$img_name);
                            $img_ext = end($img_explode); //Ici on récupère l'extension de l'image

                            $extension = ['png', 'jpeg', 'jpg']; //Une liste de toutes les extensions valides
                        
                            if(in_array($img_ext,$extension) == true){
                                //Si l'extension de l'image de l'utilisateur matche avec nos extensions valide :
                                $time = time(); 
                                //On récupère le timestamp
                                //On a besoin de ça pour remplacer le nom de l'image avec le timestamp
                                //comme ça toutes les images ont un nom unique.
                                //On met l'image dans notre dossier
                                $new_img_name = $time.$img_name;

                              
                                    if(move_uploaded_file($tmp_name,"images/".$new_img_name)){ 
                                        //Si le transfers de l'image vers notre dossier est un succés :
                                        $status = "Active now"; //Si l'utilisateur a correctement inscrit ses donénes alors son status sera actif
                                        $random_id = rand(time(),10000000); //Création d'un id random pour l'utilisateur
                                        
                                        if($password === $confirmPassword){
                                            
                                            try{
                                                //Encryption du mot de passe
                                                $hashedPassword = password_hash($password,PASSWORD_BCRYPT);
                                                
                                                //On insère nos données dans la database
                                                $response = $pdo->prepare('INSERT INTO users (session_id, username, email, password, img, status) VALUES (?,?,?,?,?,?)');

                                                $response->execute(array($random_id,trim($username,"'"),trim($email,"'"),trim($hashedPassword,"'"),trim($new_img_name,"'"),trim($status,"'")));                 
                                        
                                                //Si les données se sont bien enregistrée
                                                $response = $pdo->prepare('SELECT * from users WHERE email = ?');
                                                $response->execute(array(trim($email,"'")));
                                               

                                                $data =  $response->fetch();
                                                $_SESSION['session_id'] = $data['session_id'];
                                                echo "success";
                                                
                                            }
                                            catch (PDOException $exception) {
                                                echo "Erreur lors de l'enregistrement des données.";
                                            }
                                        }else{
                                            echo "Le mot de passe et la confirmation de mot de passe doivent être égaux !";
                                        }  
                                    }else{
                                        echo "Erreur lors de l'enregistrement de l'image.";
                                    }
                            }else{
                                echo "Veuillez choisir une extension d'image supportée par l'application";
                            }
                        }else{
                            echo "Veuillez choisir une image!";
                        }
                    }else{          
                        echo "Cet email est déjà utilisé !";
                    }
                
                }else{
                    echo "Cet email n'est pas valide!";
                }
            }else{
                echo "Tous les champs sont requis!";
            }
    
?>