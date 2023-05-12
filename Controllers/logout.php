<?php
    session_start();

    if (isset($_SESSION['ip'])) {
        include_once("../Models/DataBase/Db_connexion.php");
        $logout_code = htmlspecialchars($_GET['logout_code']);
        
        if (isset($logout_code)) {
            $status = 0;
            $stmt = $db_connexion->prepare("UPDATE utilisateurs SET status='{$status}'");
            $logout = $stmt->execute();

            if ($logout) {
                session_unset();
                session_destroy();
                header('Location: ../views/login.php'); exit;
            }

        } else header('Location: ../views/utilisateurs.php');

    } else header('Location: ../views/login.php');