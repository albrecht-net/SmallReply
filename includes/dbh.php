<?php
	// Database-Handler

	$dbServername = 'server address';
	$dbUsername = 'user for MySQL';
	$dbPassword = 'user password';
	$dbName = 'table name';

	// Mit der Datenbank verbinden
	$link = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

	// Verbindung überprüfen
	if (!$link) {
		exit('Connect Error: ' . mysqli_connect_error());
	}
?>