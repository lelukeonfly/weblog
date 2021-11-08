<?php

function hole_eintraege($umgedreht = false) {
    $eintraege = array();
    if (file_exists(PFAD_EINTRAEGE)) {
        $eintraege = unserialize(file_get_contents(PFAD_EINTRAEGE));
        if ($umgedreht === true) {
            $eintraege = array_reverse($eintraege,true);
        }
    }
    return $eintraege;
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


?>
