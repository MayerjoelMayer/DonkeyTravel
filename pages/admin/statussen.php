<?php
    // connect to the database
    require_once "../connect.php";

    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['user_id']))
    {
        // User is not logged in
        // Redirect to login page
        header("Location: ../login.php");
    }
    else if ($_SESSION['rechten'] == 1)
    {
        // User is logged in, but not as an admin
        // Redirect to admin home page
        header("Location: ../home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Admin - Herbergen | Donkey Travel</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Admin</h1>
        </div>
        <div class="content">
            <p>Welcome <?php echo $_SESSION['name']; ?>!</p>
            <p>You are logged in as <?php echo $_SESSION['email']; ?>.</p>

            <button onclick="location.href='bookings.php'">Boekingen</button>
            <button>Beheer</button>
            <br>
            <br>
            <button onclick="location.href='gasten.php'">Gasten</button>
            <button onclick="location.href='herbergen.php'">Herbergen</button>
            <button onclick="location.href='restaurants.php'">Restaurants</button>
            <button onclick="location.href='tochten.php'">Tochten</button>
            <button>Statussen</button>

            <table>
                <tr>
                    <th>Code</th>
                    <th>Status</th>
                    <th>Verwijderbaar</th>
                    <th>PIN toekennen</th>
                    <th><button onclick="location.href='statussen_create.php'">Nieuwe status</button></th>
                </tr>
                <?php
                    // Read out all locations from table "herbergen" in PDO
                    $sql = $conn->prepare("SELECT * FROM statussen");
                    $sql->execute();

                    // Fetch all herbergen from database
                    $statussen = $sql->fetchAll();

                    // Loop through all herbergen
                    foreach ($statussen as $status)
                    {
                        // Print out herberg
                        echo "<tr>";
                        echo "<td>" . $status['statuscode'] . "</td>";
                        echo "<td>" . $status['status'] . "</td>";
                        // Change numbers to boolean
                        if ($status['verwijderbaar'] == 1)
                        { echo "<td>Ja</td>"; } else { echo "<td>Nee</td>";}
                        if ($status['PINtoekennen'] == 1)
                        { echo "<td>Ja</td>"; } else { echo "<td>Nee</td>";}
                        echo "<td><button onclick=\"location.href='statussen_edit.php?id=" . $status['id'] . "'\">Bewerken</button>";
                        echo "<button onclick=\"location.href='statussen_delete.php?id=" . $status['id'] . "'\">Verwijderen</button></td>";
                        echo "</tr>";
                    }
                ?>
            </table>
            <br>
            <button onclick="location.href='../logout.php'">Log uit</button>
        </div>
    </div>
</body>
</html>