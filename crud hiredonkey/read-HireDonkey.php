<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>read-HireDonkey.php</title>
</head>
<body>
<h1>Read HireDonkey</h1>
<p>
    Dit zijn alle gegevens uit de
    tabel DonkeyAppointment van de database HireDonkey.
</p>
<?php
// tabel uitlezen en netjes afdrukken -------------------------------
require_once "connect.php";

$donkeyappointment = $conn->prepare("
                                     select   appointmentid,
                                              Donkeyid,
                                              Klantid,
                                              KlantNaam,
                                              Date
                                     from     donkeyappoinments
                                     
                                     ");
$donkeyappointment->execute();

echo "<table>";
foreach ($donkeyappointments as $donkeyappointment)
    echo "<tr>";
echo "<td>"   .    $donkeyappointment["appointmentid"] . "</td>";
echo "<td>"   .    $donkeyappointment["Donkeyid"]         . "</td>";
echo "<td>"   .    $donkeyappointment["Klantid"]    . "</td>";
echo "<td>"   .    $donkeyappointment["KlantNaam"]    . "</td>";
echo "<td>"   .    $donkeyappointment["Date"]    . "</td>";
echo "</tr>";
echo "</table>";
echo "<a href='hoofd.html'> terug naar het menu </a>";
?>
</body>
</html>