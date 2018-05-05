<?php
// Überprüfen ob Submit geklickt wurde
if (isset($_POST['submit'])) {
	if (!include 'includes/userRate.inc.php') {
		echo date('H:i:s') . ' Datei einbinden fehlgeschlagen';
	}
}
// Überprüfen ob ein Ticket gesetzt wurde
if (isset($_GET['ticket'])) {
	if (!include 'includes/ticketValidation.inc.php') {
		echo date('H:i:s') . ' Datei einbinden fehlgeschlagen';
	}
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
	<title>Bewertung</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>
        <?php echo $dataDb['title'] ?>
    </h1>
    <br>
    <p>
        <?php echo $dataDb['description'] ?>
    </p>
    <br>
    
	<form action="<?php echo 'index.php?ticket=' . $dataInput['ticket'] ?>" method="post">
		<div>
			<label for="rateValue">Schlecht - Gut</label>
			<input id="rateValue" type="range" name="rateValue" min="0" max="4" step="1">
		</div>
		<div>
			<label for="rateComment">Ihre Bewertung</label>
			<textarea id="rateComment" name="rateComment" rows="10"></textarea>
		</div>
		<div>
			<input type="submit" value="Absenden" name="submit">
		</div>
	</form>
</body>
</html>