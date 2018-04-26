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
$sqlquery = "SELECT * FROM `" . $dbTable . "` WHERE `username` = '" . $dataInput['username'] . "'";
$query = mysqli_query($link, $sqlquery);

// Benutzername abfragen
if (mysqli_num_rows($query) == 0) {
	echo date('H:i:s') . ' Der Benutzername: ' . $dataInput['username'] . ' ist ungültig.';
}

// Passwort abfragen
$dataDb = mysqli_fetch_assoc($query);
if (!password_verify($dataInput['password'], $dataDb['password'])) {
	echo date('H:i:s') . ' Das Passwort ist ungültig';
} else {
	$_SESSION['admin']['uid'] = $dataDb['uid'];
	$_SESSION['admin']['username'] = $dataDb['username'];
    header("Location: index.php");
    exit();
}
?>