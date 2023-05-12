<?php
    include_once("DataBase/Db_connexion.php");

    $request = $db_connexion->query("SELECT * FROM utilisateurs");
    $results = $request->fetchAll();