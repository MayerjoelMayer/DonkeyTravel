<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Anjo Eijeriks">
    <meta charset="UTF-8">
    <title>delete-HireDonkey2.php</title>
</head>
<body>
<h1>Delete HireDonkey 2</h1>
<p>
    op appointmentid gegevens zoeken uit de
    tabel DonkeyAppointments van de database DonkeyTravel
    zodat ze verwijdered kunnen worden.
</p>
<?php
// appointmentid uit het formulier halen --------------------------
$appointmentid = $_POST["appointmentidvak"];
// appointmentgegevens uit de tabel halen -------------------------
require_once "connect.php";

$autos = $conn->prepare("
                                      select     appointmentid,
                                                 Donkeyid,
                                                 Klantid,
                                                 KlantNaam,
                                                 Date
                                      from       DonkeyAppointment
                                      where      appointmentid = :appointmentid          
                                      ");
$DonkeyAppointments->execute(["appointmentid" => $appointmentid]);

// DonkeyAppointmentgevens laten zien ------------------------------------
echo "<table>";
foreach ($DonkeyAppointments as $DonkeyAppointment) {
    echo "<tr>";
    echo "<td>" . $DonkeyAppointment["appointmentid"] . "</td>";
    echo "<td>" . $DonkeyAppointment["Donkeyid"] . "</td>";
    echo "<td>" . $DonkeyAppointment["Klantid"] . "</td>";
    echo "<td>" . $DonkeyAppointment["KlantNaam"] . "</td>";
    echo "<td>" . $DonkeyAppointment["Date"] . "</td>";
    echo "</tr>";
}
echo  "</table><br />";

echo "<form action='delete-HireDonkey3.php' method='post'>";
// appointmentid mag niet meer gewijzigd worden
echo "<input type='hidden' name='appointmentidvak' value=$appointmentid>";
// waarde 0 doorgeven als er niet gecheckt wordt
echo "<input type='hidden' name='verwijdervak' value='0'>";
echo "<input type='checkbox' name='verwijdervak' value='1'>";
echo "verwijder deze DonkeyAppointment. <br />";
echo "<input type='submit'>";
echo "</form>";
?>
</body>
</html>
