<?php
    // connect to the database
    require_once "connect.php";

    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['user_id']))
    {
        // User is not logged in
        // Redirect to login page
        header("Location: login.php");
    }
    else if ($_SESSION['rechten'] == 2)
    {
        // User is logged in, but as an admin
        // Redirect to admin home page
        header("Location: admin/home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boekingen | My Donkey Travel</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Boekingen</h1>
        </div>
        <div class="content">
            <p>Welkom, <?php echo $_SESSION['name']; ?>!</p>
            <p>You are logged in as <?php echo $_SESSION['email']; ?>.</p>

            <p><strong>Boekingen</strong> <a href="admin.php">Beheer</a></p>

            <table>
                <tr>
                    <th>Startdatum</th>
                    <th>Einddatum</th>
                    <th>PIN code</th>
                    <th>Tocht</th>
                    <th>Status</th>
                </tr>
                <?php
                    // Read out all bookings from table "bookings" in PDO
                    $sql = $conn->prepare("SELECT * FROM bookings");
                    $sql->execute();

                    // Fetch all bookings from database
                    $bookings = $sql->fetchAll();

                    // Loop through all bookings
                    foreach ($bookings as $booking)
                    {
                        // Print out user
                        echo "<tr>";
                        echo "<td>" . $booking['StartDate'] . "</td>";
                        echo "<td>" . $booking['FKtochtenID'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </table>

            <p><a href="logout.php">Logout</a></p>
        </div>
    </div>
</body>
</html>