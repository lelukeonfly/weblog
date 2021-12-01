<?php
    require_once 'includes/konfiguration.php';
    require_once 'includes/funktionen.inc.php';
    session_start();


    if(get_user_login(trim($_POST['benutzername']),trim($_POST['passwort']))){
        logge_ein(trim($_POST['benutzername']));
    }
    
    
    /*
     * Leite zu index.php um. Der Besucher wird entweder das Login-Formular
     * sehen, wenn die Daten falsch waren, oder das Hauptmenu, wenn der Login
     * erfolgreich war. 
     */
    header('Location: index.php');
?>