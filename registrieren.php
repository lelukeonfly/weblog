<?php
    require_once 'includes/funktionen.inc.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registrieren</title>
</head>
<body>
    <form action="registriere_php.php" method="post">
        <input type="text" name="vorname" placeholder="Vorname" required="required">
        <input type="text" name="nachname" placeholder="Nachname"required="required">
        <input type="text" name="benutzername" placeholder="Benutzername"required="required">
        <input type="password" name="passwort" placeholder="Passwort"required="required">
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>