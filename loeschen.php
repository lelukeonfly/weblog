<?php
require_once 'includes/funktionen.inc.php';
require_once 'includes/konfiguration.php';
session_start();

if(file_exists(PFAD_EINTRAEGE)){
  $unserialized = unserialize(file_get_contents(PFAD_EINTRAEGE));
}

$articleid = filter_input(INPUT_GET, 'index');
unset($unserialized[$articleid]);
file_put_contents(PFAD_EINTRAEGE, serialize($unserialized));
header("Location:index.php");
?>
