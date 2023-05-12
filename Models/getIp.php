<?php
    require_once("DataBase/Db_connexion.php");
    
    if (!isset($_SESSION['ip'])) {
        header('Location: ../views/login.php');
    } else {
        $id_pers = $_GET['code'];
        $request = $db_connexion->prepare("SELECT * FROM utilisateurs WHERE unique_id = ?");
        $request->execute([$id_pers]);
        if ($request->rowCount() === 1) {
            $data = $request->fetch();
        }
    }