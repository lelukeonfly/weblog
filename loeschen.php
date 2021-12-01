<?php
require_once 'includes/funktionen.inc.php';
require_once 'includes/konfiguration.php';
session_start();

#UEBERPRUEFEN OB EINGELOGTER BENUTZER DERSELBE IST DER BEITRAG GESCHRIEBEN HAT
loeschen($_GET['index']);

header("Location:index.php");
?>
