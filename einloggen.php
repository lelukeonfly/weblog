<?php
    require_once 'includes/konfiguration.php';
    require_once 'includes/funktionen.inc.php';
    session_start();


    if(strcmp(trim($_POST['passwort']),get_username_and_password(trim($_POST['benutzername']))['passwort'])==0?true:false){
        logge_ein(get_username_and_password(trim($_POST['benutzername']))['benutzername']);
    }
    
    
    /*
     * Leite zu index.php um. Der Besucher wird entweder das Login-Formular
     * sehen, wenn die Daten falsch waren, oder das Hauptmenu, wenn der Login
     * erfolgreich war. 
     */
    header('Location: index.php');
?>