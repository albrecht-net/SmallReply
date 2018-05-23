<?php
// Variablen zuweisen
$dbTable = 'smallreply';

// Array Eingabe
$dataInput = array(
	'ticket' => mysqli_real_escape_string($link, $_POST['ticket']),
	'firstname' => mysqli_real_escape_string($link, $_POST['firstname']),
	'lastname' => mysqli_real_escape_string($link, $_POST['lastname']),
	'email' => mysqli_real_escape_string($link, $_POST['email']),
	'title' => mysqli_real_escape_string($link, $_POST['title']),
	'description' => mysqli_real_escape_string($link, $_POST['description'])
);
$dataFunctions = array(
	'dateCreate' => 'NOW()',
	'dateExpire' => filter_var($_POST['dateExpire'], FILTER_SANITIZE_NUMBER_INT)
);

// Eingabe-Regeln
// Ticket überprüfen, Ticket muss einmalig sein
$sqlquery = "SELECT * FROM `" . $dbTable . "` WHERE `ticket` = '" . $dataInput['ticket'] . "'";

if (!mysqli_num_rows(mysqli_query($link, $sqlquery)) == 0) {
	echo date('H:i:s') . ' Es ist bereits ein Eintrag mit der Ticket-Nummer: ' . $dataInput['ticket'] . ' vorhanden.';
	// exit();
}

// Email-Adresse überprüfen
if (!filter_var($dataInput['email'], FILTER_VALIDATE_EMAIL)) {
	echo date('H:i:s') . ' Die Email-Adresse ' . $dataInput['email'] . ' ist nicht gültig';
	// exit();
}

// Ablaufdatum überprüfen, darf nicht kleiner als 0 sein
if ($dataFunctions['dateExpire'] <= 0) {
	echo date('H:i:s') . ' Das Ablaufdatum muss grösser gleich 0 sein';
	// exit();
}

// Ticket generieren wenn nicht definiert
if (empty($dataInput['ticket'])) {
	$dataInput['ticket'] = uniqid('', false);
}

// Ablaufdatum generieren
if ($dataFunctions['dateExpire'] == 0) {
	$dataFunctions['dateExpire'] = "''";
} else {
	$tempDate = $dataFunctions['dateExpire'];
	$dataFunctions['dateExpire'] = 'CURDATE() + INTERVAL ' . $tempDate . ' DAY';
}

// SQL-Query bereitstellen
$columns = "`" . implode("`, `", array_keys($dataInput)) . "`, `" . implode("`, `", array_keys($dataFunctions)) . "`";
$values = "'" . implode("', '", $dataInput) . "', " . implode(", ", $dataFunctions);
$sqlquery = "INSERT INTO `" . $dbTable . "` (" . $columns . ") VALUES (" . $values . ")";

// SQL-Query ausführen und überprüfen
if (!mysqli_query($link, $sqlquery)) {
	echo date('H:i:s') . ' MySQL Error: ' . mysqli_error($link);
	exit();
} else {
    echo date('H:i:s') . '  Eintrag erfolgreich gespeichert <br>';
    header("Location: index.php");
	exit();
}
?>