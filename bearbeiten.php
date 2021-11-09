<?php
    require_once 'includes/konfiguration.php';
    require_once 'includes/funktionen.inc.php';

    //started session wieder dass man auf session variablen zugreifen kann
    session_start();

    //holt den index von der GET request
    $articleid = filter_input(INPUT_GET, 'index');
    //holt einträge von include/funktionen.inc.php
    $unserialized = hole_eintraege();

    //itereiert durch alle unserialisierten einträge und speichert den ausgewählten eintrag welcher mit dem Artikelindex kennbar ist in neue variablen
    foreach ($unserialized as $e) {
        $titel = htmlspecialchars($unserialized[$articleid]['titel']);
        $inhalt = htmlspecialchars($unserialized[$articleid]['inhalt']);
    }

    //löscht den Ausgewählten Artikel vom unserialisierten Array
    unset($unserialized[$articleid]);
    //schreibt die Artikel wieder ins Dokument
    file_put_contents(PFAD_EINTRAEGE, serialize($unserialized));

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/stylesheet.css" type="text/css" rel="stylesheet" />
    <title>Weblog - Beitrag ändern</title>
</head>

<body>
    <div id="gesamt">
        <div id="kopf">
            <h1>Mein Weblog</h1>
        </div>
        <div id="inhalt">
            <h1>Beitrag ändern:</h1>            
            <!--Formular welches automatisch mit Daten vom Blog-Post gefüllt wird-->
            <form action="bearbeitung_eintragen.php" method="post">
                <p><input type="text" name="titel" id="titel" value="<?=$titel; ?>" /></p>
                <p><textarea name="inhalt" id="eintrag" cols="50" rows="10"><?=$inhalt; ?></textarea></p>
                <p><input type="submit" value="speichern" /></p>
            </form>
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