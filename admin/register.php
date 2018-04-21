<?php
// Überprüfen ob Submit geklickt wurde
if (isset($_POST['submit'])) {
	if (!include 'includes/register.inc.php') {
		echo date('H:i:s') . ' Datei einbinden fehlgeschlagen';
	}
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Registirieren</title>

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
					<a class="nav-link" href="index.html">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="records.php">Einträge</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="register.php">Neuer Benutzer<span class="sr-only">(current)</span></a>
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

	<form action="register.php" method="POST">
			<div>
				<label for="username">Benutzername</label>
				<input id="username" type="text" name="username">
			</div>
			<div>
				<label for="firstname">Vorname</label>
				<input id="firstname" type="text" name="firstname">	
			</div>
			<div>
				<label for="lastname">Nachname</label>
				<input id="lastname" type="text" name="lastname">
			</div>
			<div>
				<label for="email">Email</label>
				<input id="email" type="email" name="email">
			</div>
			<div>
				<label for="password">Passwort</label>
				<input id="password" type="password" name="password">
			</div>
			</div>
			<div>
				<label for="passwordRepeat">Passwort wiederholen</label>
				<input id="passwordRepeat" type="password" name="passwordRepeat">
			</div>
			<div>
				<input type="submit" value="Absenden" name="submit">
			</div>
	</form>
</body>
</html>