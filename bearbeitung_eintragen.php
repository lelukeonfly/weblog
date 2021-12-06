<?php
    require_once 'includes/konfiguration.php';
    require_once 'includes/funktionen.inc.php';

    //started session wieder dass man auf session variablen zugreifen kann
    session_start();

    //es wird überprüft ob der benutzer eingeloggt ist, ansonsten kann er es nicht speichern
    if (!ist_eingeloggt()) {
        //zurück zur startseite
        header('Location: index.php');
    }

    //die Daten werden in ihre originalform gebracht und in ein assoziatives Array (article) gespeichert
    $article['titel'] = trim(filter_input(INPUT_POST, 'titel'));
    $article['inhalt'] = trim(filter_input(INPUT_POST, 'inhalt'));
    $article['erstellt_am'] = date("Y-m-d H:i:s");
    //der index von dem artikel wird vom $_GET ausgelesen
    $article['autor'] = $_GET['index'];
    bearbeiten($article);

    #hole einträge nachdem geupdated wurde so wird geupdated angezeigt
    $unserialized = hole_eintraege(true);

    //variablen werden von unserialisierten array ausgelesen und die Änderungen werden ausgegeben
    foreach ($unserialized as $articleid => $eintrag) {
        $titel = htmlspecialchars($eintrag['titel']);
        $inhalt = nl2br(htmlspecialchars($eintrag['inhalt']));
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/stylesheet.css" type="text/css" rel="stylesheet" />
    <title>Weblog - Eintrag speichern</title>
</head>

<body>
    <div id="gesamt">
        <div id="kopf">
            <h1>Mein Weblog</h1>
        </div>
        <div id="inhalt">
            <h3>Folgender Eintrag wurde erfolgreich gespeichert:</h3>
			<div class="zitat">
                <h1><?=$titel; ?></h1>
                <p><?=$inhalt; ?></p>
                <p><a href="index.php" class="backlink">Zurück zur Hauptseite</a></p>
			</div>
        </div>
        <div id="menu">
            <?php require 'includes/hauptmenu.php'; ?>
        </div>
        <div id="fuss">
            Das ist das Ende
        </div>
    </div>
</body>
</html>