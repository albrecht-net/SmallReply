<?php
session_start();

// Mit der Datenbank verbinden
include_once '../../../dbh.php';

// Array Eingabe
$dataInput = array(
	'username' => mysqli_real_escape_string($link, $_POST['username']),
	'password' => $_POST['password']
);

// SQL-Query bereitstellen
$sqlquery = "SELECT `username`, `password`, `uid` FROM `users` WHERE `username` = '" . $dataInput['username'] . "'";
$result = mysqli_query($link, $sqlquery);

// Benutzername abfragen
if (mysqli_num_rows($result) == 0) {
	echo date('H:i:s') . ' Der Benutzername: ' . $dataInput['username'] . ' ist ungültig.';
} else {
    // Abfrage in Array schreiben
    $dataDb = mysqli_fetch_assoc($result);
}

// Passwort validieren
if (!password_verify($dataInput['password'], $dataDb['password'])) {
    echo date('H:i:s') . ' Das Passwort ist ungültig';
    exit();
} else {
	$_SESSION['uid'] = $dataDb['uid'];
	$_SESSION['username'] = $dataDb['username'];
    header("Location: index.php");
    exit();
}
?>