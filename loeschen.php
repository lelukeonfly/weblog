<?php

require_once 'includes/konfiguration.php';
require_once 'includes/funktionen.inc.php';
session_start();
$eintraege = hole_eintraege(true);

$eintrag_loeschen = false;


foreach ($eintraege as $k => $e) {
  $benutzer_hat_rechte = darf_loeschen($_SESSION['eingeloggt'],$e['autor']);
#  $ueberpruefe_zeitstempel = darf_loeschen($_GET['timestamp'],$e['erstellt_am']);

#echo "benutzer hat rechte -> ";
#  echo $benutzer_hat_rechte;
#  echo "<br>";
#echo "zeitstempel gleich -> ";
#  echo $ueberpruefe_zeitstempel;
#  echo "<br>";

  // if ($benutzer_hat_rechte && $ueberpruefe_zeitstempel) {
  if($benutzer_hat_rechte){
    $eintrag_loeschen = $k;
  }
}

if ($eintrag_loeschen===false) {}
  else {
unset($eintraege[$eintrag_loeschen]);
}

file_put_contents(PFAD_EINTRAEGE, serialize($eintraege));


header("Location:index.php");

?>
