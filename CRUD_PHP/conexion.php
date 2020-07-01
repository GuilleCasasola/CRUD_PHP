<?php
    /*Datos de conexion a la base de datos*/
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'notas';
    

    //Create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if ($db->connect_error) {
        die("No se pudo conectar a la base de datos: " . $db->connect_error);
    }
    $db->query("SET NAMES 'utf8'");
?>