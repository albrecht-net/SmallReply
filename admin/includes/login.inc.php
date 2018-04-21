<?php
// Mit der Datenbank verbinden
include_once '../../../dbh.php';

// Variablen zuweisen
$dbTable = 'users';

// Array Eingabe
$dataInput = array(
	'username' => $_POST['username'],
	'password' => $_POST['password']
);

// SQL-Query bereitstellen
$sqlresult = "SELECT * FROM `" . $dbTable . "` WHERE `username` = '" . $dataInput['username'] . "'";
$result = mysqli_query($link, $sqlresult);

// Benutzername abfragen
if (mysqli_num_rows($result) == 0) {
	echo date('H:i:s') . ' Der Benutzername: ' . $dataInput['username'] . ' ist ungültig.';
	// exit();
}

// Passwort abfragen
$dataDb = mysqli_fetch_assoc($result);
if (!password_verify($dataInput['password'], $dataDb['password'])) {
	echo date('H:i:s') . ' Das Passwort ist ungültig';
	// exit();
} else {
	$_SESSION['uid'] = $dataDb['uid'];
	$_SESSION['username'] = $dataDb['username'];
	echo date('H:i:s') . ' Erfolgreich angemeldet!';
}
?>