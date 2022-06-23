<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>update-tochten2.php</title>
</head>
<body>
<h1>Update tochten 2</h1>
<p>
    Dit formulier wordt gebruikt om tochtgegevens te wijzegen
    in de tabel tochten van de database donkey_travel.
</p>
<?php
// id uit de formulier halen -----------------------------------
$id = $_POST {"idvak"};
//gegevns uit de tabel halen -----------------------------------
require_once "connect.php";
$tochten = $conn->prepare("
                                             select id,
                                             omschrijving,
                                             route,
                                             aantaldagen
                                             from   tochten
                                             where  id = :id
                                 ");
$tochten->execute(["id" => $id]);
//gegevns in een nieuw formulier laten zien -----------------
echo "<form action='update-tochten3.php' method='post'>";
foreach($tochten as $tocht)
{
    //tochten mag niet gewijzigd worden
    echo " id:" . $tocht["id"];
    echo " <input type='hidden' name='idvak' ";
    echo " value=' " . $tocht["id"] . " '> <br /> ";

    echo " omschrijving: <input type='text' ";
    echo " <name = 'omschrijving' ";
    echo " value=' " . $tocht["omschrijving"]. "' ";
    echo " <br />";

    echo " route: <input type='text' ";
    echo " name = 'route' ";
    echo " value = '" .$tocht["route"]. "'  ";
    echo " > <br />";

    echo " aantaldagen: <input type='int' ";
    echo " name = 'aantaldagen' ";
    echo " value = '" .$tocht["aantaldagen"]. "' ";
    echo " > <br />";
}
echo "<input type='submit'>";
echo "</form>";

//er moet eigenlijk nog gecontroleerd worden op een bestaand id
?>
</body>
</html>