<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>update-booking3.php</title>
</head>
<body>
<h1>Update booking 3</h1>
<p>
    bookingsgegevens wijzigen in de tabel
    bookings van de database donkey_travel.
</p>
<?php
// bookingsgegevns uit het formulier halen -----------------------
$id                   = $_POST["id"];
$StartDate            = $_POST["StartDate"];
$PINCode              = $_POST["PINCode"];
$FKusersID            = $_POST["FKusersID"];
$FKtochtenID          = $_POST["FKtochtenID"];
// updaten bookingsgegevens ---------------------------------------
require_once "connect.php";

$sql = $conn->prepare
("
                      update bookings set    StartDate      = :StartDate,
                                             PINCode        = :PINCode,
                                             FKusersID      = :FKusersID,
                                             FKtochtenID    = :FKtochtenID
                                             where  id      = :id
           ");

$sql->execute([
    "id"                  => $id,
    "StartDate"           => $StartDate,
    "PINCode"             => $PINCode,
    "FKusersID"           => $FKusersID,
    "FKtochtenID"         => $FKtochtenID
]);

echo "de booking is gewijzigd. <br />";
echo "<a href='hoofd.html'> terug naar het menu </a>";
?>
</body>
</html>