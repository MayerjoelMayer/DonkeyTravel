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

    function calculateEndDate($booking,$tocht)
    {
        return date('Y-m-d', strtotime($booking['StartDate'] . ' + ' . $tocht['aantaldagen'] . ' days'));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
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

            <button>Boekingen</button>
            <button onclick="location.href='account.php'">Account</button>
            <br><br>
            <table>
                <tr>
                    <th>Startdatum</th>
                    <th>Einddatum</th>
                    <th>PIN code</th>
                    <th>Tocht</th>
                    <th>Status</th>
                    <th><button onclick="location.href='bookings_create.php'">Nieuwe boeking</button></th>
                </tr>
                <?php
                    // Read out all bookings from table "bookings" in PDO
                    $sql = $conn->prepare("SELECT * FROM bookings WHERE FKusersID = " . $_SESSION['user_id']);
                    $sql->execute();

                    // Fetch all bookings from database
                    $bookings = $sql->fetchAll();

                    // Loop through all bookings
                    foreach ($bookings as $booking)
                    {
                        // Read out all tochten from table "tochten" in PDO
                        $sql = $conn->prepare("SELECT * FROM tochten WHERE id = " . $booking['FKtochtenID']);
                        $sql->execute();

                        // Fetch tocht from database
                        $tocht = $sql->fetch();
                        
                        // Read out all statussen from table "status" in PDO
                        $sql = $conn->prepare("SELECT * FROM statussen WHERE id = " . $booking['FKstatussenID']);
                        $sql->execute();

                        // Fetch status from database
                        $status = $sql->fetch();

                        // Print out user
                        echo "<tr>";
                        echo "<td>" . $booking['StartDate'] . "</td>";
                        echo "<td>" . calculateEndDate($booking,$tocht) . "</td>";
                        // Don't show PIN if it is equal to 0
                        if ($booking['PINCode'] == 0)
                        { echo "<td></td>";} else { echo "<td>" . $booking['PINCode'] . "</td>"; }
                        echo "<td>" . $tocht['omschrijving'] . "</td>";
                        echo "<td>" . $status['status'] . "</td>";
                        echo "<td><button onclick=\"location.href='bookings_edit.php?id=" . $booking['id'] . "'\">Bewerken</button>";
                        echo "<button onclick=\"location.href='bookings_delete.php?id=" . $booking['id'] . "'\">Verwijderen</button></td>";
                        echo "</tr>";
                    }
                ?>
            </table>
            <br>
            <button onclick="location.href='logout.php'">Log uit</button>
        </div>
    </div>
</body>
</html>