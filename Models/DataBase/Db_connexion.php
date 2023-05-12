<?php

try  {
    $db_connexion = new PDO("mysql:host=localhost; dbname=chatApp", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8'
    ]);

} catch (Exception $e) {
    echo "Erreur: ".$e->getMessage();
}