<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>update-booking2.php</title>
</head>
<body>
<h1>Update booking 2</h1>
<p>
    Dit formulier wordt gebruikt om bookinggegevens te wijzegen
    in de tabel autos van de database garage.
</p>
<?php
// id uit de formulier halen -----------------------------------
$id = $_POST {"idvak"};
//gegevns uit de tabel halen -----------------------------------
require_once "connect.php";
$bookings = $conn->prepare("
                                             select id,
                                             StartDate,
                                             PINCode,
                                             FKusersID,
                                             FKtochtenID,
                                             FKstatussenID
                                             from   bookings
                                             where  id = :id
                                 ");
$bookings->execute(["id" => $id]);
//gegevns in een nieuw formulier laten zien -----------------
echo "<form action='update-booking3.php' method='post'>";
foreach($bookings as $booking)
{
    //booking mag niet gewijzigd worden
    echo " id:" . $booking["id"];
    echo " <input type='hidden' name='idvak' ";
    echo " value=' " . $booking["id"] . " '> <br /> ";

    echo " StartDate: <input type='Date' ";
    echo " <name = 'StartDate' ";
    echo " value=' " . $booking["StartDate"]. "' ";
    echo " <br />";

    echo " PINCode: <input type='int' ";
    echo " name = 'PINCode' ";
    echo " value = '" .$booking["text"]. "'  ";
    echo " > <br />";

    echo " FKusersID: <input type='int' ";
    echo " name = 'FKusersID' ";
    echo " value = '" .$booking["FKusersID"]. "' ";
    echo " > <br />";

    echo " FKtochtenID: <input type='int' ";
    echo " name = 'FKtochtenID' ";
    echo " value = '" .$booking["FKtochtenID"]. "' ";
    echo " > <br />";

    echo " FKstatussenID: <input type='int' ";
    echo " name = 'FKstatussenID' ";
    echo " value = '" .$booking["FKstatussenID"]. "' ";
    echo " > <br />";
}
echo "<input type='submit'>";
echo "</form>";

//er moet eigenlijk nog gecontroleerd worden op een bestaand id
?>
</body>
</html>