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
            <?php
                // Connect to the database
                require_once "connect.php";

                // Get the id from the url
                $id = $_GET['id'];

                // Read out all tochten from table "tochten" in PDO
                $sql = $conn->prepare("SELECT * FROM bookings WHERE id = $id");
                $sql->execute();

                // Fetch all tochten from database
                $booking = $sql->fetch();

                // Read out all tochten from table "tochten" in PDO
                $sql = $conn->prepare("SELECT * FROM tochten WHERE id = " . $booking['FKtochtenID'] . "");
                $sql->execute();

                // Fetch all tochten from database
                $tocht = $sql->fetch();

                // Edit form
                echo "<form action='bookings_edit.php?id=" . $booking['id'] . "' method='post'>";
                echo "<label><strong>Startdatum</strong></label><br>";
                echo "<input type='date' name='StartDate' value='" . $booking['StartDate'] . "'><br><br>";
                echo "<label><strong>Tocht</strong></label><br>";
                echo "<select name='tochten'>";

                // Read out all tochten from table "tochten" in PDO
                $sql = $conn->prepare("SELECT * FROM tochten");
                $sql->execute();

                // Fetch all tochten from database
                $tochten = $sql->fetchAll();

                // Loop through all tochten
                foreach ($tochten as $tocht)
                {
                    echo '<option value="' . $tocht['id'] . '">' . $tocht['omschrijving'] . '</option>';
                }

                echo "</select><br><br>";
                echo "<input type='submit' value='Opslaan'>";
                echo "<button><a href='bookings.php'>Terug</a></button>";
                echo "</form>";

                // Check if the form is submitted
                if (isset($_POST['StartDate']))
                {
                    // Get the values from the form
                    $StartDate = $_POST['StartDate'];
                    $tochten = $_POST['tochten'];

                    // Update the booking in the database
                    $sql = $conn->prepare("UPDATE bookings SET StartDate = '$StartDate', FKtochtenID = $tochten WHERE id = $id");
                    $sql->execute();

                    // Redirect to the bookings page
                    header("Location: bookings.php");
                }
            ?>
        </div>
    </div>
</body>
</html>