<?php

// Array Eingabe
$dataInput = array(
	'username' => mysqli_real_escape_string($config['link'], $_POST['username']),
	'firstname' => mysqli_real_escape_string($config['link'], $_POST['firstname']),
	'lastname' => mysqli_real_escape_string($config['link'], $_POST['lastname']),
	'email' => mysqli_real_escape_string($config['link'], $_POST['email']),
	'password' => $_POST['password'],
	'passwordRepeat' => $_POST['passwordRepeat']
);
$dataFunctions = array(
	'userRegistered' => 'NOW()'
);

// Eingabe-Regeln
// Benutzername überprüfen, Benutzername muss einmalig sein
$sqlquery = "SELECT * FROM `users` WHERE `username` = '" . $dataInput['username'] . "'";
if (!mysqli_num_rows(mysqli_query($config['link'], $sqlquery)) == 0) {
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

// Benutzer-ID generieren
$dataInput['uid'] = uniqid();

// SQL-Query bereitstellen
$columns = "`" . implode("`, `", array_keys($dataInput)) . "`, `" . implode("`, `", array_keys($dataFunctions)) . "`";
$values = "'" . implode("', '", $dataInput) . "', " . implode(", ", $dataFunctions);
$sqlquery = "INSERT INTO `users` (" . $columns . ") VALUES (" . $values . ")";

// SQL-Query ausführen und überprüfen
if (!mysqli_query($config['link'], $sqlquery)) {
	echo date('H:i:s') . ' MySQL Error: ' . mysqli_error($config['link']);
	exit();
} else {
    echo date('H:i:s') . '  Eintrag erfolgreich gespeichert <br>';
    header("Location: index.php");
	exit();
}
?>