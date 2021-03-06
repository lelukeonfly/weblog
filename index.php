<?php
    require_once 'includes/funktionen.inc.php';
    session_start();

    // In Blogs werden Einträge immer in umgekehrter Reihenfolge angezeigt
    $unserialized = hole_eintraege(true);
    #var_dump($_SESSION);
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/stylesheet.css" type="text/css" rel="stylesheet" />
    <title>Weblog - Einträge</title>
</head>

<body>

    <div id="gesamt">

        <div id="kopf">
            <h1>Mein Weblog</h1>
        </div>

        <div id="inhalt">

            <?php foreach ($unserialized as $k => $e): ?>
                <h1><?php echo htmlspecialchars($e['titel']); ?></h1>
	            <?php echo nl2br(htmlspecialchars($e['inhalt'])); ?>

	            <p class="eintrag_unten">
	                <span>
                        geschrieben von
                        <?=htmlspecialchars($e['vorname']);?>
                        <?=htmlspecialchars($e['nachname']);?>
                        am <?=date('d.m.Y',strtotime($e['erstellt_am']));?>
                        um <?=date('H:i',strtotime($e['erstellt_am']));?>
	                </span>
                  <?php
                  if (ist_eingeloggt()) {
                  if (strcmp($_SESSION['eingeloggt'], $e['benutzername'])===0) {?>
                  <span>
                    <a href="loeschen.php?index=<?=htmlspecialchars($e['id']);?>">X</a>
                    <a href="bearbeiten.php?index=<?=htmlspecialchars($e['id']);?>">edit</a>
                  </span>
                <?php }} ?>
	            </p>
            <?php endforeach; ?>

        </div>

        <div id="menu">
            <?php
                /**
                 * Zeige das Login-Formular, wenn der Benutzer noch nicht eingeloggt ist,
                 * ansonsten das Hauptmenu.
                 */
                if (ist_eingeloggt()) {
                  require 'includes/hauptmenu.php';
                }
                else {
                	require 'includes/loginformular.php';
                }
            ?>
        </div>

        <div id="fuss">
            Das ist das Ende
        </div>

    </div>

</body>

</html>
