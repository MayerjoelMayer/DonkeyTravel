<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>update-tochten3.php</title>
</head>
<body>
<h1>Update tochten 3</h1>
<p>
    tocht gegevens wijzigen in de tabel
    tochten van de database donkey_travel.
</p>
<?php
// gegevns uit het formulier halen -----------------------
$id                 = $_POST["id"];
$omschrijving       = $_POST["omschrijving"];
$route              = $_POST["route"];
$aantaldagen        = $_POST["aantaldagen"];
// gegevens updaten ---------------------------------------
require_once "connect.php";

$sql = $conn->prepare
("
                      update tochten set     omschrijving      = :omschrijving,
                                             route             = :route,
                                             aantaldagen       = :aantaldagen
           ");

$sql->execute([
    "id"                  => $id,
    "omschrijving"        => $omschrijving,
    "route"               => $route,
    "aantaldagen"         => $aantaldagen
]);

echo "de tocht is gewijzigd. <br />";
echo "<a href='hoofd.html'> terug naar het menu </a>";
?>
</body>
</html>