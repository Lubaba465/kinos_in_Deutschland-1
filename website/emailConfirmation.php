<?php
session_start();
$key = $_SESSION["registration_key"];
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Email Bestätigung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1"/>
</head>

<body>
<p>
    Diese Email-Addresse wurde zur Registrierung bei
    <a href="index.php">https://kinosindeutschland.de</a> genutzt.
    <br/>
    Du kannst diesen link aufrufen, um die Registrierung abzuschließen.
    <a href="./phpLogic/registrationPageLogic.php?key=<?= $key ?>">https://kinosindeutschland.de<?= $key ?></a>
</p>
</body>
</html>
