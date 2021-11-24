<?php

function hole_eintraege($umgedreht = false) {

    if($umgedreht){
        $orderby = "ASC";
    }else{
        $orderby = "DESC";
    }

    $db_connection = get_db_connection();
    $query = "SELECT beitraege.id, beitraege.titel, beitraege.inhalt, beitraege.erstellt_am, benutzer.vorname, benutzer.nachname, benutzer.benutzername FROM beitraege JOIN benutzer ON beitraege.benutzer_id = benutzer.id ORDER BY erstellt_am $orderby";
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
}


function darf_loeschen($benutzer, $artikel_benutzer)
{
  return strcmp($benutzer,$artikel_benutzer)==0?true:false;
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

function get_username_and_password($username){
    $db_connection = get_db_connection();

    $query = "SELECT benutzer.benutzername, benutzer.passwort FROM benutzer WHERE benutzer.benutzername = '$username'";
    $statement = $db_connection->query($query);
    $daten = $statement->fetch();
    return $daten;
}

function schreibe_eintrag($eintrag_array){
    $db_connection = get_db_connection();
    $query = "INSERT INTO beitraege(titel,inhalt,erstellt_am,benutzer_id) VALUES (".$eintrag_array["titel"].",".$eintrag_array["inhalt"].",".$eintrag_array["erstellt_am"].",".$eintrag_array["autor"].")";
    $db_connection->query($query);
}

function get_benutzer_id($username){
    $db_connection = get_db_connection();

    $query = "SELECT benutzer.id FROM benutzer WHERE benutzer.benutzername = '$username'";
    $statement = $db_connection->query($query);
    $daten = $statement->fetch();
    return $daten;
}

?>
