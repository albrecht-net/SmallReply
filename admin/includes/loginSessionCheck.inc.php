<?php
session_start();

// Array Sessiondata
$dataSession = array(
	'uid' => $_SESSION['admin']['uid'],
	'username' => $_SESSION['admin']['username']
);

// Benutzer Session zurücksetzten
function unsetSession() {
	unset($_SESSION['admin']);
	header("Location: login.php");
}

// Überprüft ob User-ID oder Benutzername in der Session leer sind (leer entspricht: kein Benutzer angemeldet)
if (empty($dataSession['uid']) || empty($dataSession['username'])) {
	echo date('H:i:s') . ' Keine Session';
	unsetSession();
	exit();
} elseif (isset($dataSession['uid']) && isset($dataSession['username'])) {
	// Mit der Datenbank verbinden
	include_once '../../../dbh.php';

	// Variablen zuweisen
	$dbTable = 'users';

	// SQL-Query bereitstellen
	$sqlquery = "SELECT * FROM `" . $dbTable . "` WHERE `uid` = '" . $dataSession['uid'] . "' AND `username` = '" . $dataSession['username'] . "'";
	$query = mysqli_query($link, $sqlquery);

	// Prüft ob Session mit Datenbank übereinstimmt (Wenn 1 Resultat: Benutzer vorhanden und korrekt abgeglichen, Session wird nicht zurückgesetzt)
	if (mysqli_num_rows($query) != 1) {
		echo date('H:i:s') . ' Benutzer abfragen fehlgeschlagen';
		unsetSession();
		exit();
	}
}
?>