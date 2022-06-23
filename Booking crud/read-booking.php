<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>read-booking.php</title>
</head>
<body>
<h1>Read an appointment</h1>
<p>
    Dit zijn alle gegevens uit de
    tabel booking van de database donkey_travel.
</p>
<?php
// tabel uitlezen en netjes afdrukken -------------------------------
require_once "connect.php";
$Booking = new connect();
$result = $Booking->getBooking();


echo "<table>";

foreach ($result as $row){
    ?>
    echo "<tr>";
    <table class="table table-striped table-dark ">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Omschrijving</th>
        <th scope="col">Route</th>
        <th scope="col">Aantal dagen</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['StartDate']; ?></td>
        <td><?php echo $row['PINCode']; ?></td>
        <td><?php echo $row['FKusersID']; ?></td>
        <td><?php echo $row['FKtochtenID']; ?></td>
        <td><?php echo $row['FKstatussenID']; ?></td>
        <td>
            <a href="../Pages/Tocht_Edit.php?id=<?php echo $row['id']; ?>">
                <button class="btn btn-warning">
                    Bewerken
                </button>
            </a>
            <a href="../Pages/Tocht_Delete.php?id=<?php echo $row['id']; ?>">
                <button class="btn btn-danger">
                    Verwijderen
                </button>
            </a>
        </td>
    </tr>
    </tbody>
</table>
<?php
}
?>
</body>
</html>