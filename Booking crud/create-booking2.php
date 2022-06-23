<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>create-booking2.php</title>
</head>
<body>
<h1>book an appontment!</h1>
<p>
    Een booking plaatsen aan de tabel.
</p>
<?php
//booking uit het formulier halen ------------------------
echo "<pre>".print_r($_POST, true)."</pre>";
$FKtochtenID       =$_POST["FKtochtenID"];
$FKstatussenID        =$_POST["FKstatussenID"];
$FKusersID        =$_POST["FKusersID"];
$PINCode        =$_POST["PINCode"];
$StartDate           =$_POST["StartDate"];

// booking invoeren in de tabel------------------------------
require_once "connect.php";
$sql = $conn->prepare("
                                           insert into bookings (`StartDate`, `PINCode`, `FKusersID`, `FKtochtenID`, `FKstatussenID`) 
                                           values
                                           (
                                           :StartDate, :PINCode, :FKusersID, :FKstatussenID, :FKtochtenID
                                           )
                                           ");
                                           
$sql->execute([":StartDate" => $StartDate,
":PINCode" => $PINCode,
":FKusersID" => $FKusersID,
":FKstatussenID" => $FKstatussenID,
":FKtochtenID" => $FKtochtenID
]);
echo "The appointment is set!<br />";
echo "<a href='hoofd.html'> terug naar het menu </a>";
?>
</body>
</html>11