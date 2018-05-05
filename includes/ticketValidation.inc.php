<?php
// Mit der Datenbank verbinden
include_once '../../dbh.php';

// Variablen zuweisen
$dbTable = 'smallreply';

// Array Eingabe
$dataValidation = array(
	'ticket' => $_GET['ticket']
);

// SQL-Query bereitstellen (Für Ticket Validierung und Eingabeformular)
$sqlquery = "SELECT CURDATE() <= `dateExpire` AS 'dateValid', `completed`, `title`, `description` FROM `" .  $dbTable . "` WHERE `ticket` = '" . $dataValidation['ticket'] . "'";
$result = mysqli_query($link, $sqlquery);

// Ticket validieren
if (mysqli_num_rows($result) == 0) {
    echo date('H:i:s') . ' Das Ticket ' . $dataValidation['ticket'] . ' ist ungültig.';
    exit();
} else {
    // Abfrage in Array schreiben
    $dataDb = mysqli_fetch_assoc($result);
}

// Datum validieren
if ($dataDb['dateValid'] == 0) {
    echo date('H:i:s') . ' Das Ticket ' . $dataValidation['ticket'] . ' ist nicht mehr gültig.';
    exit();
}

// Status validieren
if ($dataDb['completed'] == 1) {
    echo date('H:i:s') . ' Es wurde bereits auf das Ticket ' . $dataValidation['ticket'] . ' geantwortet.';
    exit();
}
?>