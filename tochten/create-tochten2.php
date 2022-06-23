<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>create-tochten2.php</title>
</head>
<body>
<h1>voeg een tocht toe!</h1>
<p>
    Een tocht toevoegen aan de tabel.
</p>
<?php
//tocht uit het formulier halen ------------------------
echo "<pre>".print_r($_POST, true)."</pre>";
$omschrijving       =$_POST["omschrijving"];
$route              =$_POST["route"];
$aantaldagen        =$_POST["aantaldagen"];

// booking invoeren in de tabel------------------------------
require_once "connect.php";
$sql = $conn->prepare("
                                           insert into tochten (`omschrijving`, `route`, `aantaldagen`) 
                                           values
                                           (
                                           :omschrijving, :route, :aantaldagen
                                           )
                                           ");
                                           
$sql->execute([":omschrijving" => $omschrijving,
":route" => $route,
":aantaldagen" => $aantaldagen,
]);
echo "de tocht is toegevoegd!<br />";
echo "<a href='hoofd.html'> terug naar het menu </a>";
?>
</body>
</html>11