<?php
include_once("../Models/Database/Db_connexion.php");

if (isset($_POST['userName']) && isset($_POST['email']) && isset($_POST['password'])) {
    $userName = htmlspecialchars($_POST['userName']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $check = $db_connexion->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $check->execute([$email]);
    $data = $check->fetch();

    $result = $check->rowCount();
    if ($result == 0) {
        if (!empty($userName) && !empty($email) && !empty($password)) {
            if (strlen($userName) >= 4) {
                if (strlen($email) >= 6) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if (strlen($password) >= 6) {
                            // $password = hash("sha256", $password);
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            $unique_id = rand(time(), 10000);
                        
                            if (isset($_FILES['image'])) {
                                $img_name = $_FILES['image']['name'];
                                $tmp_name = $_FILES['image']['tmp_name'];

                                $img_explode = explode('.', $img_name);
                                $img_extension = end($img_explode);

                                $extensions = ['jpeg', 'jpg', 'png'];
                                if (in_array($img_extension, $extensions) === true) {
                                    $time = time();
                                    $new_image_name = $time . $img_name;

                                    if (move_uploaded_file($tmp_name, "../public/uploads/images/" . $new_image_name)) {
                                        $status = 0;

                                        $insert = $db_connexion->prepare("INSERT INTO utilisateurs(unique_id, userName, email, fileName, password, status) VALUES (:unique_id, :userName, :email, :fileName, :password, :status)");

                                        if ($insert) {
                                            $insert->execute([
                                                'unique_id' => $unique_id,
                                                'userName' => $userName,
                                                'email' => $email,
                                                'fileName' => $new_image_name,
                                                'password' => $password,
                                                'status' => $status
                                            ]);

                                            echo "Succès: inscription réussie !";
                                        } else echo "Il y a des erreurs quelque part.";
                                        
                                    }
                                } else echo "Veuillez utiliser un fichier image de type: jpeg, jpg et png";
                            } else echo "Le photo de profile ne peut pas être vide.";
                        } else echo "Le mot de passe doit avoir un minimum de 6 caractères.";
                    } else echo "Email invalide.";
                } else echo "L'email doit avoir un minimum de 6 caractères.";
            } else echo "Le nom d'utilisateur doit avoir un minimum de 4 caractères.";
        } else echo "Tous les champs sont requis.";
    } else echo $email . " déjà existe.";
}
