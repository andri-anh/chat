<?php
session_start();
include_once("../Models/DataBase/Db_connexion.php");


if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $request = $db_connexion->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $request->execute([$email]);
        $data = $request->fetch();

        $countData = $request->rowCount();

        if ($countData === 1) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                if (password_verify($password, $data['password'])) {
                    $_SESSION['ip'] = $data['unique_id'];
                    $_SESSION['userName'] = $data['userName'];
                    
                    $session = $_SESSION['ip'];
                    $status = 1;
                    $stmt = $db_connexion->prepare("UPDATE utilisateurs SET status='{$status}' WHERE unique_id = ?");
                    $login = $stmt->execute([$session]);
                    if ($login) {
                        echo "success";
                    }
                } else echo "Mot de passe incorrect !";
                
            } else echo $email . " non valide !";
        } else echo "Compte non existant !";
    } else echo "Tous les champs sont requis !";
}
