<?php
// Mit der Datenbank verbinden
include_once 'config.php';

// Array Eingabe
$dataInput = array(
    'rateValue' => filter_var($_POST['rateValue'], FILTER_SANITIZE_NUMBER_INT),
    'rateComment' => mysqli_real_escape_string($config['link'], $_POST['rateComment']),
    'completed' => 1
);
$dataFunction = array(
    'dateCompleted' => 'NOW()'
);

// Ticket validieren
include_once 'includes/ticketValidation.inc.php';

// SQL-Query bereitstellen
$set = [];
foreach ($dataInput as $column => $value) {
    $set[] = "`" . $column . "` = '" . $value . "'";
}

foreach ($dataFunction as $column => $value) {
    $set[] = "`" . $column . "` = " . $value;
}

$sqlquery = "UPDATE `smallreply` SET " . implode(", ", $set) . " WHERE `smallreply`.`ticket` = '" . $dataValidation['ticket'] . "'";

// SQL-Query ausführen und überprüfen
if (!mysqli_query($config['link'], $sqlquery)) {
    echo date('H:i:s') . ' MySQL Error: ' . mysqli_error($config['link']);
    exit();
} else {
    echo date('H:i:s') . '  Eintrag erfolgreich gespeichert <br>';
    exit();
}
?>