<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>read-booking.php</title>
</head>
<body>
<h1>Read an appointment</h1>
<p>
    Dit zijn alle gegevens uit de
    tabel booking van de database donkey_travel.
</p>
<?php
// tabel uitlezen en netjes afdrukken -------------------------------
require_once "connect.php";

$booking = $conn->prepare("
                                     select   id,
                                     StartDate,
                                     PINCode,
                                     FKusersID,
                                     FKtochtenID,
                                     FKstatussenID,
                                     from     bookings
                                     
                                     ");
$booking->execute();
$data = $booking->fetchAll();

echo "<table>";
foreach ($data as $booking)
    echo "<tr>";
echo "<td>"   .    $booking["id"] . "</td>";
echo "<td>"   .    $booking["StartDate"]         . "</td>";
echo "<td>"   .    $booking["PINCode"]    . "</td>";
echo "<td>"   .    $booking["FKusersID"]    . "</td>";
echo "<td>"   .    $booking["FKtochtenID"]    . "</td>";
echo "<td>"   .    $booking["FKstatussenID"]    . "</td>";
echo "</tr>";
echo "</table>";
echo "<a href='hoofd.html'> terug naar het menu </a>";
?>
</body>
</html>