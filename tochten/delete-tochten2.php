<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="project">
    <meta charset="UTF-8">
    <title>delete-tochten2.php</title>
</head>
<body>
<h1>Delete tochten 2</h1>
<p>
    op id gegevens zoeken uit de
    tabel tochten van de database donkey_travel
    zodat ze verwijdered kunnen worden.
</p>
<?php
// id uit het formulier halen --------------------------
$id = $_POST["id"];
// tochtengegevens uit de tabel halen -------------------------
require_once "connect.php";

$tochten = $conn->prepare("
                                      select     id,
                                      omschrijving,
                                      route,
                                      aantaldagen
                                      from       tochten
                                      where      id = :id          
                                      ");
$tochten->execute(["id" => $id]);

// DonkeyAppointmentgevens laten zien ------------------------------------
echo "<table>";
foreach ($tochten as $tocht) {
    echo "<tr>";
    echo "<td>" . $tocht["id"] . "</td>";
    echo "<td>" . $tocht["omschrijving"] . "</td>";
    echo "<td>" . $tocht["route"] . "</td>";
    echo "<td>" . $tocht["aantaldagen"] . "</td>";
    echo "</tr>";
}
echo  "</table><br />";

echo "<form action='delete-tochten3.php' method='post'>";
// tochid mag niet meer gewijzigd worden
echo "<input type='hidden' name='idvak' value=$id>";
// waarde 0 doorgeven als er niet gecheckt wordt
echo "<input type='hidden' name='verwijdervak' value='0'>";
echo "<input type='checkbox' name='verwijdervak' value='1'>";
echo "verwijder deze tocht. <br />";
echo "<input type='submit'>";
echo "</form>";
?>
</body>
</html>
