<?php
// Array Eingabe
$dataSetup = array(
    'step' => $_GET['step'],
    'configTemplate' => file('configSample.php'),
    'configFile' => 'config.php',
    'tables' => array(
        'smallreply',
        'users'
    )
);

// Auf vorhandene Konfiguration prüfen
if (file_exists($dataSetup['configFile'])) {
    // Konfiguration einbinden
    include_once($dataSetup['configFile']);

    if ($config['setupActive'] !== true) {
        echo date('H:i:s') . ' Konfiguration existiert bereits, Installation ist deaktiviert!';
        exit();
    }

    if (in_array($dataSetup['step'], array(0, 1, 2))) {
        $dataSetup['step'] = 3;
    }
} elseif (in_array($dataSetup['step'], array(3, 4))) {
    $dataSetup['step'] = 0;
}

// HTML Header
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Setup Konfiguration</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" async></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous" async></script>
</head>
<body>
<?php

switch ($dataSetup['step']) {
    case (0): // Willkommensseite
        ?>
        <p>Willkommen bei SmallReply. Um mit dem Einrichten zu beginnen, benötigen wir einige Informationen zur Datenbank:</p>
        <ul>
            <li>Datenbank-Server</li>
            <li>Datenbank-Benutzername</li>
            <li>Datenbank-Passwort</li>
            <li>Datenbank-Name</li>
        </ul>
        <p>Diese Informationen werden für die Erstellung der Datei <code>config.php</code> genutzt. </p>
        <p>Mit diesem Setup wird ausserdem der erste Benutzer für den Administratoren-Zugriff erstellt.</p>
        <a href="setup.php?step=1">Los Geht's</a>
        <?php
        break;
    case (1): // Datenbank Zugangsdaten eingeben
        ?>
        <form method="post" action="setup.php?step=2">
            <p>Hier sollten die Zugangsdaten zu Ihrer Datenbank eigentragen werden.</p>
            <div>
                <label for="dbHost">Datenbank-Host</label>
                <input id="dbHost" type="text" name="dbHost" value="localhost">
            </div>
            <div>
                <label for="dbUsername">Benutzername</label>
                <input id="dbUsername" type="text" name="dbUsername">
            </div>
            <div>
                <label for="dbPassword">Passwort</label>
                <input id="dbPassword" type="password" name="dbPassword">
            </div>
            <div>
                <label for="dbName">Datenbank-Name</label>
                <input id="dbName" type="text" name="dbName" value="smallreply">
            </div>
            <div>
                <input type="submit" value="Absenden" name="submit">
            </div>
        </form> 
        <?php
        break;
    case (2): // Datenbankverbindung überprüfen
        $dataSetup['input'] = array(
            'dbHost' => $_POST['dbHost'],
            'dbUsername' => $_POST['dbUsername'],
            'dbPassword' => $_POST['dbPassword'],
            'dbName' => $_POST['dbName']
        );

        // Mit der Datenbank verbinden
        $tempLink = mysqli_connect($dataSetup['input']['dbHost'], $dataSetup['input']['dbUsername'], $dataSetup['input']['dbPassword'], $dataSetup['input']['dbName']);

        // Verbindung überprüfen
        if (!$tempLink) {
            ?>
            <h1>Fehler beim Aufbau einer Datenbankverbindung</h1>
            <p>Das bedeutet, dass der eingegebene Benutzername oder das Passwort nicht korrekt ist. Möglicherweise kann auch der Datenbankserver auf <code><?php echo $dataSetup['input']['dbHost'] ?></code> nicht erreicht werden.</p>
            <ul>
                <li>Sind Benutzername und Passwort korrekt?</li>
                <li>Ist der Datenbankserver unter dem eingegebenen Hostnamen oder IP-Addresse erreichbar?</li>
                <li>Hat der Benutzer die benötigten Rechte für die angegebene Datenbank?</li>
            </ul>
            <a href="setup.php?step=1">Erneut versuchen</a>
            <?php
            break;
        } else {

            // Eingabewerte zur Konfigurationsvorlage hinzufügen
            foreach ($dataSetup['input'] as $key => $value) {
                $search = "'" . $key . "' => ''";
                $replace = "'" . $key . "' => '" . $value . "'";
                $dataSetup['configTemplate'] = str_replace($search, $replace, $dataSetup['configTemplate']);
            }
            $dataSetup['configTemplate'][0] = '<?php /* THIS FILE WAS GENERATED BY THE SMALLREPLY FRONT-END ' . date('d.m.Y H:i:s') . ' */' . PHP_EOL;

            // Eingabewerte in Config.php schreiben
            file_put_contents($dataSetup['confiFile'], $dataSetup['configTemplate']);

            ?>
            <p>Die Verbindung zur Datenbank konnte erfolgreich hergestellt werden</p>
            <p>Die Tabellen können im nächsten Schritt automatisch erstellt werden.</p>
            <a href="setup.php?step=3">Tabellen erstellen</a>
            <a href="setup.php?step=4">Benutzer</a>
            <?php
        }
        break;
    case (5): // Prüfen auf vorhandene Tabellen
        // SQL-Query bereitstellen
        $sqlquery = "SHOW TABLES WHERE `Tables_in_" . $config['dbName'] . "` REGEXP '" . implode('|', $dataSetup['tables']) . "'";
        $result = mysqli_query($config['link'], $sqlquery);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_row($result)) {
                $dataSetup['presentTables'][] = $row[0];
            }
            ?>
            <h1>Es wurden Tabellen gefunden</h1>
            <p>In der von Ihnen eingegebenen Datenenbank <code><?php echo $config['dbName']; ?></code> wurden folgende Tabellen für Smallreply gefunden: <code><?php echo implode(', ', $dataSetup['presentTables']) ?></code></p>
            <p>Beinhalten diese Tabellen Daten für Smallreply welche importiert werden sollen, kann der nächste Schritt <a href="setup.php?step=5">übersprungen</a> werden. Damit Smallreply ohne Probleme funktionieren kann, muss sichergestellt werden, dass die benötigten Tabellen eine korrekte Datenstruktur verfügen!</p>
            <?php
            break;
        } else {
            continue;
        }
    case (6): // Tabellen erstellen
    case (10): // Initial Benutzerdaten eingeben
        ?>
        <form action="setup.php?step=5" method="POST">
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
        <?php
        break;
    case (11): // Initial Benutzer anlegen
        include '/admin/includes/register.inc.php';
        break;
}

// HTML Footer
?>
</body>
</html>