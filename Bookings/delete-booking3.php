<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="project">
    <meta charset="UTF-8">
    <title>delete-booking3.php</title>
</head>
<body>
<h1>Delete booking 3</h1>
<p>
    op booking gegevens zoeken uit de
    tabel bookings van de datebase donkey_travel
    zodat ze verwijderd kunnen worden.
</p>
<?php
// gegevens uit de formulier halen -------------------------------------------
$id       = $_POST["idvak"];
$verwijderen   = $_POST["verwijdervak"];

//bookinggegevens verwijderen ---------------------------------------------------
if ($verwijderen)
{
    require_once "connect.php";

    $sql = $conn->prepare("
                                      delete from bookings
                                      where id = :id
                                    ");
    $sql->execute(["id" => $id]);

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