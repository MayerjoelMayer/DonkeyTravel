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

            <p><a href="bookings.php">Boekingen</a> <strong>Beheer</strong></p>
            <p><a href="gasten.php">Gasten</a> <strong>Herbergen</strong> <a href="restaurants.php">Restaurants</a> <a href="tochten.php">Tochten</a> <a href="statussen.php">Statussen</a></p>

            <table>
                <tr>
                    <th>Naam</th>
                    <th>Adres</th>
                    <th>E-Mail</th>
                    <th>Telefoonnummer</th>
                    <th>Coordinaten</th>
                </tr>
                <?php
                    // Read out all locations from table "herbergen" in PDO
                    $sql = $conn->prepare("SELECT * FROM herbergen");
                    $sql->execute();

                    // Fetch all herbergen from database
                    $herbergen = $sql->fetchAll();

                    // Loop through all herbergen
                    foreach ($herbergen as $herberg)
                    {
                        // Print out herberg
                        echo "<tr>";
                        echo "<td>" . $herberg['naam'] . "</td>";
                        echo "<td>" . $herberg['adres'] . "</td>";
                        echo "<td>" . $herberg['email'] . "</td>";
                        echo "<td>" . $herberg['telefoon'] . "</td>";
                        echo "<td>" . $herberg['coordinaten'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </table>

            <p><a href="../logout.php">Logout</a></p>
        </div>
    </div>
</body>
</html>