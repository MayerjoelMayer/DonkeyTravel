<?php
     // gar-connect.php
    // maakt een connectie met de database 'garage'
   // Anjo Eijeriks
   $servername = "Localhost";
   $dbname = "donkey_travel";
   $username = "root";
   $password = "";

try {
    $conn = new PDO("mysql:host=$servername;
 dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
    echo " Connect is gelukt !<br>";
}
catch (PDOException $e)
{
    echo " Connectie is MISLUKT: " . $e->getMessage();
}
?>

