<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Setup</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php
		// Variablen zuweisen
		$cfgFilename = '../config.php';

		// Auf vorhandene Konfiguration prüfen
		if (file_exists($cfgFilename)) {
			echo date('H:i:s') . ' Konfiguration existiert bereits, Installation ist deaktiviert!';
			exit();
		} else {
			echo '<p>Erster Benutzer erstellen</p>';
			echo '<form action="#" method="post">';
			echo '<div>
				<label for="uid">Bentuzername</label>
				<input id="uid" type="text" name="uid">
				</div>';
			echo '<form>';
		}
	?>
</body>
</html>