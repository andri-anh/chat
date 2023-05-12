<?php
    require_once("DataBase/Db_connexion.php");
    
    if (!isset($_SESSION['ip'])) {
        header('Location: ../views/login.php');
    } else {
        $ip = $_SESSION['ip'];
        $request = $db_connexion->prepare("SELECT * FROM utilisateurs WHERE unique_id= ?");
        $request->execute([$ip]);
        if ($request->rowCount() === 1) {
            $data = $request->fetch();
        }
    }