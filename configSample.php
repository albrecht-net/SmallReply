<?php
$data = array(
    // Servername oder IP-Addresse
    'dbHost' => '',

    // Benutzername der MySQL-Datenbank
    'dbUsername' => '',

    // Passwort der MySQL-Datenbank
    'dbPassword' => '',

    // Datenbankname für SmallReply
    'dbName' => ''
);

// Datenbankverbindung
$config['link'] = mysqli_connect($data['dbHost'], $data['dbUsername'], $data['dbPassword'], $data['dbName']);

// Verbindung überprüfen
if (!$config['link']) {
    exit('Connect Error: ' . mysqli_connect_error());
}

// Setup Status
$config['setupActive'] = true;

return $config;
?>