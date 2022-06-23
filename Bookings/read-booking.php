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
        <th scope="col">StartDate</th>
        <th scope="col">PINCode</th>
        <th scope="col">FKusersID</th>
        <th scope="col">FKtochtenID</th>
        <th scope="col">FKstatussenID</th>
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
            <a href="update-booking.php?id=<?php echo $row['id']; ?>">
                <button class="btn btn-warning">
                    Bewerken
                </button>
            </a>
            <a href="delete-booking1.php?id=<?php echo $row['id']; ?>">
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