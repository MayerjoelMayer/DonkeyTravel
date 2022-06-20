<?php
    // connect to the database
    require_once "../connect.php";

    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['user_id']))
    {
        // User is not logged in
        // Redirect to login page
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gasten | Donkey Travel</title>
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
            <p><strong>Gasten</strong> <a href="admin/herbergen.php">Herbergen</a> <a href="admin/restaurants.php">Restaurants</a> <a href="admin/tochten.php">Tochten</a> <a href="admin/statussen.php">Statussen</a></p>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Telefoonnummer</th>
                </tr>
                <?php
                    // Read out all users from table "users" in PDO
                    $stmt = $pdo->prepare("SELECT * FROM users");
                    $stmt->execute();

                    // Fetch all users from database
                    $users = $stmt->fetchAll();

                    // Loop through all users
                    foreach ($users as $user)
                    {
                        // Print out user
                        echo "<tr>";
                        echo "<td>" . $user['id'] . "</td>";
                        echo "<td>" . $user['name'] . "</td>";
                        echo "<td>" . $user['email'] . "</td>";
                        echo "<td>" . $user['phone'] . "</td>";
                        echo "</tr>";
                    }

                    // Close connection
                    $pdo = null;
                ?>
            </table>

            <p><a href="logout.php">Logout</a></p>
        </div>
    </div>
</body>
</html>