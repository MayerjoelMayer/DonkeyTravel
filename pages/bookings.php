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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boekingen | Donkey Travel</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Boekingen</h1>
        </div>
        <div class="content">
            <p>Welcome <?php echo $_SESSION['name']; ?>!</p>
            <p>You are logged in as <?php echo $_SESSION['email']; ?>.</p>

            <p><strong>Boekingen</strong> <a href="admin.php">Beheer</a></p>

            <table>
                <tr>
                    <th>Startdatum</th>
                    <th>Einddatum</th>
                    <th>Status</th>
                    <th>PIN code</th>
                    <th>Klantnaam</th>
                    <th>Tocht</th>
                    <th>E-mail</th>
                    <th>Telefoonnummer</th>
                </tr>
                <?php
                    // Read out all users from table "users" in PDO
                    $sql = $conn->prepare("SELECT * FROM users");
                    $sql->execute();

                    // Fetch all users from database
                    $users = $sql->fetchAll();

                    // Loop through all users
                    foreach ($users as $user)
                    {
                        // Print out user
                        echo "<tr>";
                        echo "<td>" . $user['name'] . "</td>";
                        echo "<td>" . $user['email'] . "</td>";
                        echo "<td>" . $user['phone'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </table>

            <p><a href="logout.php">Logout</a></p>
        </div>
    </div>
</body>
</html>