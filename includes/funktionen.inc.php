<?php

function hole_eintraege($umgedreht = false) {

    if($umgedreht){
        $orderby = "ASC";
    }else{
        $orderby = "DESC";
    }

    $db_connection = get_db_connection();
    #$query = "SELECT * FROM beitraege ORDER BY erstellt_am $orderby";
    $query = "SELECT * FROM beitraege JOIN benutzer ON beitraege.benutzer_id = benutzer.id ORDER BY erstellt_am $orderby";
    $result = mysqli_query($db_connection, $query);

    if($result){
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    mysqli_close($db_connection);

    return $rows;
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
    $host = "127.0.0.1";
    $user = "weblog";
    $pwd = "weblog";
    $db_connection = new mysqli($host, $user, $pwd, $database);

    return $db_connection;
}

?>
