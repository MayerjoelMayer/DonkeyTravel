<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Anjo Eijeriks">
    <meta charset="UTF-8">
    <title>delete-HireDonkey3.php</title>
</head>
<body>
<h1>Delete HireDonkey 3</h1>
<p>
    op DonkeyAppointment gegevens zoeken uit de
    tabel Appointments van de datebase DonkeyTravel
    zodat ze verwijderd kunnen worden.
</p>
<?php
// gegevens uit de formulier halen -------------------------------------------
$appointmentid       = $_POST["appointmentidvak"];
$verwijderen   = $_POST["verwijdervak"];

//autogegevns verwijderen ---------------------------------------------------
if ($verwijderen)
{
    require_once "connect.php";

    $sql = $conn->prepare("
                                      delete from DonkeyAppointment
                                      where appointmentid = :appointmentid
                                    ");
    $sql->execute(["appointmentid" => $appointmentid]);

    echo "De gegevens zijn verwijderd. <br />";
}
else
{
    echo "De gegevens zijn niet verwijderd. <br />";
}

echo "<a href='hoofd.html'>terug naar het menu. </a>";
?>
</body>
</html>