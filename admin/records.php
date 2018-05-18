<?php
// Prüfen ob Benutzer angemeldet
if (!include_once 'includes/loginSessionCheck.inc.php') {
	echo date('H:i:s') . ' Datei einbinden fehlgeschlagen';
	exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Erfasste Umfragen</title>

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
				<li class="nav-item">
					<a class="nav-link" href="index.php">Home</a>
				</li>
                <li class="nav-item">
                    <a class="nav-link" href="newReply.php">Neuer Eintrag</a>
                </li>
				<li class="nav-item active">
					<a class="nav-link" href="records.php">Einträge<span class="sr-only">(current)</span></a>
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
    
	<?php
		// Mit der Datenbank verbinden
		include_once '../config.php';

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