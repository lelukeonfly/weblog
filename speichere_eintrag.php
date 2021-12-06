<?php
    require_once 'includes/funktionen.inc.php';
    session_start();
    
    /*
     * Wenn der Benutzer nicht eingeloggt ist oder die Seite nicht
     * über POST aufgerufen, also das Formular nicht abgeschickt wurde, 
     * leite auf index.php um. 
     */
    if(empty($_POST['titel'])||empty($_POST['inhalt'])||!ist_eingeloggt()){
        header('Location: index.php');
        exit;
    }
    
    // Erstelle einen neuen Eintrag im Format der anderen Einträge
    $article = array(
        'titel'       => trim($_POST['titel']),
        'inhalt'      => trim($_POST['inhalt']),
        #'autor'       => $_SESSION['eingeloggt'], #zu benutzerid ändern
        #'autor'       => get_benutzer_id($_SESSION['eingeloggt']),
        'autor'       => $_SESSION['id'],
        'erstellt_am' => date("Y-m-d H:i:s")
    );


    schreibe_eintrag($article);
    
    // hole die alten Einträge, hänge den neuen an und speichere
    #$unserialized   = hole_eintraege();
    #$unserialized[] = $article;
    #file_put_contents(PFAD_EINTRAEGE, serialize($unserialized));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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
            	<h1><?php echo htmlspecialchars($article['titel']); ?></h1>
                <p>
                    <?php echo nl2br(htmlspecialchars($article['inhalt'])); ?>
                </p>
                <p>
	                <a href="index.php" class="backlink">Zurück zur Hauptseite</a>
	            </p>
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