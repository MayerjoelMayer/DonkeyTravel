<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="project">
    <meta charset="UTF-8">
    <title>delete-tochten3.php</title>
</head>
<body>
<h1>Delete tochten 3</h1>
<p>
    op tocht gegevens zoeken uit de
    tabel tochten van de datebase donkey_travel
    zodat ze verwijderd kunnen worden.
</p>
<?php
// gegevens uit de formulier halen -------------------------------------------
$id       = $_POST["idvak"];
$verwijderen   = $_POST["verwijdervak"];

//gegevens verwijderen ---------------------------------------------------
if ($verwijderen)
{
    require_once "connect.php";

    $sql = $conn->prepare("
                                      delete from tochten
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