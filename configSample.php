<?php
$config = array(
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
$link = mysqli_connect($config['dbHost'], $config['dbUsername'], $config['dbPassword'], $config['dbName']);

// Verbindung überprüfen
if (!$link) {
    exit('Connect Error: ' . mysqli_connect_error());
}

return $link;
?>