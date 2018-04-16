<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Erfasste Umfragen</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php
		// Mit der Datenbank verbinden
		include_once '../../../smallreply/includes/dbh.php';

		// Variablen zuweisen
		$dbTable = 'smallreply';

		// SQL-Query bereitstellen
		$sqlquery = "SELECT * FROM `" . $dbTable . "`";
		$result = mysqli_query($link, $sqlquery);

		// Prüfen ob Datensätze vorhanden
		if (mysqli_num_rows($result) < 1) {
			echo date('H:i:s') . ' Keine Datensätze vorhanden';
			exit();
		} else {
			echo '<table>';
			echo '<tr>';
			echo '<td>Ticket</td>';
			echo '<td>Vorname</td>';
			echo '<td>Nachname</td>';
			echo '<td>Email</td>';
			echo '<td>Erstelldatum</td>';
			echo '<td>Titel</td>';
			echo '<td>Beschreibung</td>';
			echo '<td>Ablaufdaum</td>';
			echo '</tr>';
			while ($row = mysqli_fetch_assoc($result)) {
				echo '<tr>';
				echo '<td>' . $row['ticket'] . '</td>';
				echo '<td>' . $row['firstname'] . '</td>';
				echo '<td>' . $row['lastname'] . '</td>';
				echo '<td>' . $row['email'] . '</td>';
				echo '<td>' . $row['dateCreate'] . '</td>';
				echo '<td>' . $row['title'] . '</td>';
				echo '<td>' . $row['description'] . '</td>';
				echo '<td>' . $row['dateExpire'] . '</td>';
				echo '</tr>';
			}
		}

	?>
</body>
</html>