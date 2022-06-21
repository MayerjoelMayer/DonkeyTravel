<?php
    // connect to the database
    require_once "../connect.php";

    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['user_id']))
    {
        // User is not logged in
        // Redirect to login page
        header("Location: `../login.php");
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
    <title>Admin - Restaurants | Donkey Travel</title>
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
            <p><a href="gasten.php">Gasten</a> <a href="herbergen.php">Herbergen</a> <strong>Restaurants</strong> <a href="tochten.php">Tochten</a> <a href="statussen.php">Statussen</a></p>

            <table>
                <tr>
                    <th>Naam</th>
                    <th>Adres</th>
                    <th>E-Mail</th>
                    <th>Telefoonnummer</th>
                    <th>Coordinaten</th>
                </tr>
                <?php
                    // Read out all locations from table "restaurants" in PDO
                    $sql = $conn->prepare("SELECT * FROM restaurants");
                    $sql->execute();

                    // Fetch all herbergen from database
                    $restaurants = $sql->fetchAll();

                    // Loop through all herbergen
                    foreach ($restaurants as $restaurant)
                    {
                        // Print out herberg
                        echo "<tr>";
                        echo "<td>" . $restaurant['naam'] . "</td>";
                        echo "<td>" . $restaurant['adres'] . "</td>";
                        echo "<td>" . $restaurant['email'] . "</td>";
                        echo "<td>" . $restaurant['telefoon'] . "</td>";
                        echo "<td>" . $restaurant['coordinaten'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </table>

            <p><a href="../logout.php">Logout</a></p>
        </div>
    </div>
</body>
</html>