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
        </div>
        <div>
            <!-- Delete system for bookings, using a form showing the information from the database and the id in the url using pdo -->
            <?php
                // connect to the database
                require_once "connect.php";

                // get the id from the url
                $id = $_GET['id'];

                // get the information from the database
                $sql = $conn->prepare("SELECT * FROM bookings WHERE id = $id");
                $sql->execute();

                // Fetch booking from database
                $booking = $sql->fetch();

                echo "<form action='bookings_delete_2.php?id=" . $booking['id'] . "' method='post'>";

                // Read out all tochten from table "tochten" in PDO
                $sql = $conn->prepare("SELECT * FROM tochten WHERE id = " . $booking['FKtochtenID'] . "");
                $sql->execute();

                // Fetch tocht from database
                $tocht = $sql->fetch();

                // Read the information from the database
                echo "<label><strong>Startdatum</strong></label><br>";
                echo "<input type='text' name='startdate' value='" . $booking['StartDate'] . "' disabled><br>";
                echo "<label><strong>Einddatum</strong></label><br>";
                echo "<input type='text' name='startdate' value='" . calculateEndDate($booking,$tocht) . "' disabled><br>";
                echo "<label><strong>Tocht</strong></label><br>";
                echo "<input type='text' name='tocht' value='" . $tocht['omschrijving'] . "' disabled><br><br>";
            ?>
            <input type="submit" value="Verwijder">
            </form>
            <button onclick="location.href='bookings.php'">Terug</button>
        </div>
    </div>
</body>
</html>