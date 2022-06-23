<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="project">
    <meta charset="UTF-8">
    <title>delete-booking2.php</title>
</head>
<body>
<h1>Delete Booking 2</h1>
<p>
    op id gegevens zoeken uit de
    tabel bookings van de database donkey_travel
    zodat ze verwijdered kunnen worden.
</p>
<?php
// id uit het formulier halen --------------------------
$id = $_POST["id"];
// bookinggegevens uit de tabel halen -------------------------
require_once "connect.php";

$bookings = $conn->prepare("
                                      select     id,
                                      FKtochtenID,
                                      FKstatussenID,
                                      FKusersID,
                                      PINCode,
                                      StartDate
                                      from       bookings
                                      where      id = :id          
                                      ");
$bookings->execute(["id" => $id]);

// DonkeyAppointmentgevens laten zien ------------------------------------
echo "<table>";
foreach ($bookings as $booking) {
    echo "<tr>";
    echo "<td>" . $booking["id"] . "</td>";
    echo "<td>" . $nooking["FKtochtenID"] . "</td>";
    echo "<td>" . $booking["FKstatussenID"] . "</td>";
    echo "<td>" . $booking["FKusersID"] . "</td>";
    echo "<td>" . $booking["PINCode"] . "</td>";
    echo "<td>" . $booking["StartDate"] . "</td>";
    echo "</tr>";
}
echo  "</table><br />";

echo "<form action='delete-booking3.php' method='post'>";
// appointmentid mag niet meer gewijzigd worden
echo "<input type='hidden' name='idvak' value=$id>";
// waarde 0 doorgeven als er niet gecheckt wordt
echo "<input type='hidden' name='verwijdervak' value='0'>";
echo "<input type='checkbox' name='verwijdervak' value='1'>";
echo "verwijder deze booking. <br />";
echo "<input type='submit'>";
echo "</form>";
?>
</body>
</html>
