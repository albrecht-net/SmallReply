<?php
	// Überprüfen ob ein ticket gesetzt wurde
	if (isset($_GET['ticket'])) {
		session_start();
		$_SESSION['ticket'] = $_GET['ticket'];
	// Überprüfen ob ein ticket bereits vorhanden ist
	} elseif (session_status == PHP_SESSION_ACTIVE) {
		
	} else {
		echo date('H:i:s') . ' Kein Ticket gefunden';
		exit();
	}
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<form action="" method="post">
		<div>
			<label for="rateValue">Schlecht - Gut</label>
			<input id="rateValue" type="range" name="rateValue" min="0" max="4" step="1">
		</div>
		<div>
			<label for="rateComment">Ihre Bewertung</label>
			<textarea id="rateComment" name="rateComment" rows="10"></textarea>
		</div>
		<div>
			<input type="submit" value="Absenden" name="submitRate">
		</div>
	</form>
</body>
</html>