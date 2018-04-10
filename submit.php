<?php
	// Überprüfen ob Submit geklickt wurde
	if (isset($_POST['submit'])) {

		// Mit der Datenbank verbinden
		include_once 'includes/dbh.php';

		// Variablen zuweisen
		$dbTable = 'smallreply';
		
		// Array Eingabe
		$dataInput = array(
			'ticket' => $_POST['ticket'],
			'firstname' => $_POST['firstname'],
			'lastname' => $_POST['lastname'],
			'email' => $_POST['email'],
			'title' => $_POST['title'],
			'description' => $_POST['description']
        );
        $dataDate = array(
            'dateCreate' => 'NOW()',
            'dateExpire' => $_POST['dateExpire']
        );

		// Eingabe-Regeln
		// Ticket überprüfen, Ticket muss einmalig sein
		$sqlresult = "SELECT * FROM `" . $dbTable . "` WHERE `ticket` = '" . $dataInput['ticket'] . "'";
		$result = mysqli_query($link, $sqlresult);

		if (!mysqli_num_rows($result) == 0) {
			echo date('H:i:s') . ' Es ist bereits ein Eintrag mit der Ticket-Nummer: ' . $dataInput['ticket'] . ' vorhanden.';
			// exit();
		}

		// Email-Adresse überprüfen
		if (!filter_var($dataInput['email'], FILTER_VALIDATE_EMAIL)) {
			echo date('H:i:s') . ' Die Email-Adresse ' . $dataInput['email'] . ' ist nicht gültig';
			// exit();
		}

		// Ablaufdatum überprüfen, darf nicht kleiner als 0 sein
		if ($dataDate['dateExpire'] <= 0) {
			echo date('H:i:s') . ' Das Ablaufdatum muss grösser gleich 0 sein';
			// exit();
		}



        // Ticket generieren wenn nicht definiert
        if (empty($dataInput['ticket'])) {
            $dataInput['ticket'] = uniqid('', false);
        }

		// Ablaufdatum generieren
		if ($dataDate['dateExpire'] == 0) {
			$dataDate['dateExpire'] = "''";
		} else {
			$tempDate = $dataDate['dateExpire'];
			$dataDate['dateExpire'] = 'CURDATE() + INTERVAL ' . $tempDate . ' DAY';
		}

		// SQL-Query bereitstellen
        $columns = "`" . implode("`, `", array_keys($dataInput)) . "`, `" . implode("`, `", array_keys($dataDate)) . "`";
        $values = "'" . implode("', '", $dataInput) . "', " . implode(", ", $dataDate);

        $sqlquery = 'INSERT INTO `' . $dbTable . '` (' . $columns . ') VALUES (' . $values . ')';

		echo $sqlquery;

        // SQL-Query ausführen und überprüfen
        if (!mysqli_query($link, $sqlquery)) {
            echo date('H:i:s') . ' MySQL Error: ' . $query . mysqli_error($link);
            exit();
        } else {
            echo date('H:i:s') . '  Eintrag erfolgreich gespeichert <br>';
        }

	} else {
		echo date('H:i:s') . ' Submit wurde nicht geklickt';
		exit();
	}
?>