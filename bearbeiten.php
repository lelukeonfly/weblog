<?php
    require_once 'includes/konfiguration.php';
    require_once 'includes/funktionen.inc.php';

    //started session wieder dass man auf session variablen zugreifen kann
    session_start();

    //holt den index von der GET request
    $articleid = filter_input(INPUT_GET, 'index');
    //holt einträge von include/funktionen.inc.php
    $unserialized = hole_eintraege();
    #var_dump($unserialized);

    //itereiert durch alle unserialisierten einträge und überprüft, wo die GET id dieselbe ist wie bei den Datenbankeinträgen id und schreibt somit titel und inhalt in fleder
    foreach ($unserialized as $e) {
        if($e['id']==$articleid){
            $titel = htmlspecialchars($e['titel']);
            $inhalt = htmlspecialchars($e['inhalt']);
        }
    }

    //TODO: ARTIKEL ÄNDERN
    

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