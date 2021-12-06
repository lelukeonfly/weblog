<?php
    require_once 'includes/funktionen.inc.php';
    session_start();

    $registerdata['vorname'] = $_POST['vorname'];
    $registerdata['nachname'] = $_POST['nachname'];
    $registerdata['benutzername'] = $_POST['benutzername'];
    $registerdata['passwort'] = $_POST['passwort'];

    
    register($registerdata);

    logge_ein($registerdata['vorname']);

    header('Location:index.php');
?>