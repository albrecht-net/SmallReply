<?php
	// Überprüfen ob Submit geklickt wurde
	if (isset($_POST['submitRate'])) {

		session_start();

		// Mit der Datenbank verbinden
		include_once '../../../../smallreply/includes/dbh.php';

		// Variablen zuweisen
		$dbTable = 'smallreply';
		$ticket = $_SESSION['ticket'];
		
		// Array Eingabe
		$dataInput = array(
			'rateValue' => $_POST['rateValue'],
			'rateComment' => $_POST['rateComment'],
			'completed' => 1
		);
		$dataFunction = array(
			'dateCompleted' => 'NOW()'
		);

		// Eingabe-Regeln
		// Ticket überprüfen
		$sqlresult = "SELECT * FROM `" . $dbTable . "` WHERE `ticket` = '" . $ticket . "'";
		$result = mysqli_query($link, $sqlresult);

		if (!mysqli_num_rows($result) == 1) {
			echo date('H:i:s') . ' Es ist kein Eintrag mit der Ticket-Nummer: ' . $ticket . ' vorhanden.';
			// exit();
		}

		// SQL-Query bereitstellen
		$set = [];
		foreach ($dataInput as $column => $value) {
			$set[] = "`" . $column . "` = '" . $value . "'";
		}
		
		foreach ($dataFunction as $column => $value) {
			$set[] = "`" . $column . "` = " . $value;
		}

		$sqlquery = "UPDATE `" . $dbTable . "` SET " . implode(", ", $set) . " WHERE `" . $dbTable . "`.`ticket` = '" . $ticket . "'";

		// SQL-Query ausführen und überprüfen
		if (!mysqli_query($link, $sqlquery)) {
			echo date('H:i:s') . ' MySQL Error: ' . $query . mysqli_error($link);
			exit();
		} else {
			echo date('H:i:s') . '  Eintrag erfolgreich gespeichert <br>';
			session_unset();
			session_destroy();
			exit();
		}

	} else {
		echo date('H:i:s') . ' Submit wurde nicht geklickt';
		exit();
	}
?>