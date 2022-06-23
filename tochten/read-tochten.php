<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>read-tochten.php</title>
</head>
<body>
<h1>roon een tocht</h1>
<p>
    Dit zijn alle gegevens uit de
    tabel tochten van de database donkey_travel.
</p>
<?php
// tabel uitlezen en netjes afdrukken -------------------------------
require_once "connect.php";
$tocht = new connect();
$result = $tocht->gettochten();


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
        <td><?php echo $row['Omschrijving']; ?></td>
        <td><?php echo $row['Route']; ?></td>
        <td><?php echo $row['aantaldagen']; ?></td>

        <td>
            <a href="update-tochten1.php?id=<?php echo $row['id']; ?>">
                <button class="btn btn-warning">
                    Bewerken
                </button>
            </a>
            <a href="delete-tochten.php?id=<?php echo $row['id']; ?>">
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