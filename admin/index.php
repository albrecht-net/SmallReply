<?php
// Konfiguration einbinden
require_once('../config.php');

// Prüfen ob Benutzer angemeldet
if (!include_once 'includes/loginSessionCheck.inc.php') {
	echo date('H:i:s') . ' Datei einbinden fehlgeschlagen';
	exit();
}
// Überprüfen ob Submit geklickt wurde
if (isset($_POST['submit'])) {
	if (!include 'includes/newReply.inc.php') {
		echo date('H:i:s') . ' Datei einbinden fehlgeschlagen';
	}
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Dashboard</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" async></script>
	<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous" async></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">SmallReply</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
				</li>
                <li class="nav-item">
                    <a class="nav-link" href="newReply.php">Neuer Eintrag</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="records.php">Einträge</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="register.php">Neuer Benutzer</a>
				</li>
			</ul>
		</div>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Abmelden</a>
				</li>
			</ul>
		</div>
	</nav>
</body>
</html>