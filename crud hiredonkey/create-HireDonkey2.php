<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>create-HireDonkey2.php</title>
</head>
<body>
<h1>Hire a Donkey!</h1>
<p>
    Een DonkeyAppointment plaatsen aan de tabel.
</p>
<?php
//DonkeyAppointment uit het formulier halen ------------------------
$appointmentid  =$_POST["appointmentid"];
$Donkeyid       =$_POST["Donkeyid"];
$Klantid        =$_POST["Klantid"];
$KlantNaam      =$_POST["KlantNaam"];
$Date           =$_POST["Date"];
// DonkeyAppointment invoeren in de tabel------------------------------
require_once "connect.php";
$sql = $conn->prepare("
                                           insert into DonkeyTravel values
                                           (
                                           :appointmentid, :Donkeyid, :Klantid, :Klantnaam,
                                           :Date
                                           )
                                           ");
//manier 1 (of manier 2 gebruiken)-------------------------------
#$sql->bindparam(":Donkeyid",         $Donkeyid);
#$sql->bindparam(":Klantid",       $Klantid);
#$sql->bindparam(":KlantNaam",      $KlantNaam);
#$sql->bindparam(":Date",   $Date);


echo "The appointment is set!<br />";
echo "<a href='hoofd.html'> terug naar het menu </a>";
?>
</body>
</html>