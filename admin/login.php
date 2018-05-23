<?php
// Überprüfen ob Submit geklickt wurde
if (isset($_POST['submit']) && !empty($_POST['username'])) {
	if (!include 'includes/login.inc.php') {
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
	<title>Login</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<form action="login.php" method="POST">
			<div>
				<label for="username">Benutzername</label>
				<input id="username" type="text" name="username">
			</div>
			<div>
				<label for="password">Passwort</label>
				<input id="password" type="password" name="password">
			</div>
			<div>
				<input type="submit" value="Absenden" name="submit">
			</div>
	</form>
</body>
</html>