<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Bewertung</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php
		// Überprüfen ob ein ticket gesetzt wurde
		if (isset($_GET['ticket'])) {
			$_SESSION['ticket'] = $_GET['ticket'];
			echo date('H:i:s') . ' Ein neues Ticket wurde erkannt: ' . $_SESSION['ticket'];
		// Überprüfen ob ein ticket bereits vorhanden ist
		} elseif (isset($_SESSION['ticket'])) {
			echo date('H:i:s') . ' Session mit folgendem Ticket gefunden: ' . $_SESSION['ticket'];
		} else {
			echo date('H:i:s') . ' Kein Ticket gefunden';
			session_unset();
			session_destroy();
			exit();
		}
	?>	<?php
		// Überprüfen ob ein ticket gesetzt wurde
		if (isset($_GET['ticket'])) {
			$_SESSION['ticket'] = $_GET['ticket'];
			echo date('H:i:s') . ' Ein neues Ticket wurde erkannt: ' . $_SESSION['ticket'];
		// Überprüfen ob ein ticket bereits vorhanden ist
		} elseif (isset($_SESSION['ticket'])) {
			echo date('H:i:s') . ' Session mit folgendem Ticket gefunden: ' . $_SESSION['ticket'];
		} else {
			echo date('H:i:s') . ' Kein Ticket gefunden';
			session_unset();
			session_destroy();
			exit();
		}
	?>
	<form action="userRateSubmit.php" method="post">
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