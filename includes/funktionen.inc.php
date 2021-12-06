<?php

function hole_eintraege($umgedreht = false) {

    if($umgedreht){
        $orderby = "ASC";
    }else{
        $orderby = "DESC";
    }

    $db_connection = get_db_connection();
    $query = "SELECT bt.id, bt.titel, bt.inhalt, bt.erstellt_am, b.vorname, b.nachname, b.benutzername FROM beitraege bt JOIN benutzer b ON bt.benutzer_id = b.id ORDER BY erstellt_am $orderby";
    $statement = $db_connection->query($query);
    $daten = $statement->fetchAll();

    return $daten;
}

function ist_eingeloggt() {
    $erg = false;
    if (isset($_SESSION['eingeloggt'])) {
        if (!empty($_SESSION['eingeloggt']))
            $erg = true;
    }
    return $erg;
}

function logge_ein($benutzername) {
    $_SESSION['eingeloggt'] = $benutzername;
    $_SESSION['id'] = get_benutzer_id($benutzername);
}

function logge_aus() {
    unset($_SESSION['eingeloggt']);
    unset($_SESSION['id']);
}


function darf_loeschen($artikel_benutzer_id)
{
  return $_SESSION['id']==$artikel_benutzer_id?true:false;
}

function get_db_connection()
{
    $database = "weblog";
    $host = "localhost";
    $user = "weblog";
    $pwd = "weblog";
    $port = "3306";
    $db_connection = new PDO("mysql:host=$host;dbname=$database;port=$port",$user,$pwd);
    
    return $db_connection;
}

function get_user_login($username,$passwort){
    $db_connection = get_db_connection();

    #$query = "SELECT benutzer.benutzername, benutzer.passwort FROM benutzer WHERE benutzer.benutzername = '$username'";
    #SELECT COUNT(benutzer.benutzername) FROM benutzer WHERE benutzer.benutzername = '$username' AND benutzer.passwort = '$passwort'
    $query = "SELECT COUNT(benutzer.benutzername) FROM benutzer WHERE benutzer.benutzername = '$username' AND benutzer.passwort = '$passwort'";
    $statement = $db_connection->query($query);
    $daten = $statement->fetch();
    return (bool)$daten;
}

function schreibe_eintrag($eintrag_array){
    $db_connection = get_db_connection();
    $query = "INSERT INTO beitraege(titel,inhalt,erstellt_am,benutzer_id) VALUES ('".$eintrag_array["titel"]."','".$eintrag_array["inhalt"]."','".$eintrag_array["erstellt_am"]."',".$eintrag_array["autor"].")";
    $db_connection->query($query);
}

function get_benutzer_id($username){
    $db_connection = get_db_connection();

    $query = "SELECT benutzer.id FROM benutzer WHERE benutzer.benutzername = '$username'";
    $statement = $db_connection->query($query);
    $daten = $statement->fetch();
    return $daten['id'];
}

function loeschen($beitrag_id)
{
    $db_connection = get_db_connection();
    $query = "DELETE FROM beitraege WHERE id=$beitrag_id";
    $db_connection->query($query);
}

function bearbeiten($bearbetien_array){
    $db_connection = get_db_connection();
    #UPDATE `beitraege` SET `titel` = 'asdfjhljghaeljagfhagrhjuögrejögfrjkoöadföpi', `inhalt` = 'agnam,flkasdflashdflkjashdfklagsdoifgaosidlfgasljdghfklashdfasdfasdf' WHERE `beitraege`.`id` = 8; 
    #change autor to beitrag id in bearbeitung_eintragen.php
    $query = "UPDATE beitraege SET titel = '".$bearbetien_array['titel']."', inhalt = '".$bearbetien_array['inhalt']."', erstellt_am = '".$bearbetien_array['erstellt_am']."' WHERE beitraege.id = ".$bearbetien_array['autor'].";";
    $db_connection->query($query);
}


function register($register_array)
{
    $db_connection = get_db_connection();
    $query = "INSERT INTO benutzer(vorname, nachname, passwort, benutzername) VALUES ('".$register_array['vorname']."','".$register_array['nachname']."','".$register_array['passwort']."','".$register_array['benutzername']."')";
    $db_connection->query($query);
}

?>
