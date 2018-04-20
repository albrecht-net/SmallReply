<?php
// Mit der Datenbank verbinden
include_once '../../../dbh.php';

// Variablen zuweisen
$dbTable = 'users';

// Array Eingabe
$dataInput = array(
	'username' => $_POST['username'],
	'firstname' => $_POST['firstname'],
	'lastname' => $_POST['lastname'],
	'email' => $_POST['email'],
	'password' => $_POST['password'],
	'passwordRepeat' => $_POST['passwordRepeat']
);
$dataFunctions = array(
	'userRegistered' => 'NOW()'
);

// Eingabe-Regeln
// Benutzername überprüfen, Benutzername muss einmalig sein
$sqlresult = "SELECT * FROM `" . $dbTable . "` WHERE `username` = '" . $dataInput['username'] . "'";
$result = mysqli_query($link, $sqlresult);
if (!mysqli_num_rows($result) == 0) {
	echo date('H:i:s') . ' Der Benutzername: ' . $dataInput['ticket'] . ' ist bereits vergeben.';
	// exit();
}
// Email-Adresse überprüfen
if (!filter_var($dataInput['email'], FILTER_VALIDATE_EMAIL)) {
	echo date('H:i:s') . ' Die Email-Adresse ' . $dataInput['email'] . ' ist nicht gültig.';
	// exit();
}
// Passwortübereinstimmung überprüfen
if ($dataInput['password'] !== $dataInput['passwordRepeat']) {
	echo date('H:i:s') . ' Die eingegebenen Passwörter stimmen nicht überein.';
	// exit();
} else {
	unset($dataInput['passwordRepeat']);
}
// Passwortfilter
if (strlen($dataInput['password']) < 8) {
	echo date('H:i:s') . ' Das Passwort muss mindestens 8 Zeichen enthalten';
	// exit();
}

//  Gross- / Kleinschreibung
// Vorname
$dataInput['firstname'] = ucfirst(strtolower($dataInput['firstname']));
// Nachname
$dataInput['lastname'] = ucfirst(strtolower($dataInput['lastname']));
// Email
$dataInput['email'] = strtolower($dataInput['email']);

// Passwort Hash
$dataInput['password'] = password_hash($dataInput['password'], PASSWORD_DEFAULT);

// SQL-Query bereitstellen
$columns = "`" . implode("`, `", array_keys($dataInput)) . "`, `" . implode("`, `", array_keys($dataFunctions)) . "`";
$values = "'" . implode("', '", $dataInput) . "', " . implode(", ", $dataFunctions);

$sqlquery = 'INSERT INTO `' . $dbTable . '` (' . $columns . ') VALUES (' . $values . ')';

// SQL-Query ausführen und überprüfen
if (!mysqli_query($link, $sqlquery)) {
	echo date('H:i:s') . ' MySQL Error: ' . $query . mysqli_error($link);
	exit();
} else {
	echo date('H:i:s') . '  Eintrag erfolgreich gespeichert <br>';
	exit();
}
?>