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
        // Redirect to home page
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
    <title>Tochten | My Donkey Travel</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Tochten</h1>
        </div>
        <div class="content">
            <p>Welkom, <?php echo $_SESSION['name']; ?>!</p>
            <p>You are logged in as <?php echo $_SESSION['email']; ?>.</p>
        </div>
        <div>
            <?php
                // Connect to the database
                require_once "../connect.php";

                // Get the id from the url
                $id = $_GET['id'];

                // Read out all tochten from table "tochten" in PDO
                $sql = $conn->prepare("SELECT * FROM tochten WHERE id = $id");
                $sql->execute();

                // Fetch all tochten from database
                $tocht = $sql->fetch();

                // Edit form
                echo "<form action='tochten_edit.php?id=" . $tocht['id'] . "' method='post'>";
                echo "<label><strong>Omschrijving</strong></label><br>";
                echo "<input type='text' name='omschrijving' value='" . $tocht['omschrijving'] . "'><br><br>";
                echo "<label><strong>Route</strong></label><br>";
                echo "<input type='text' name='route' value='" . $tocht['route'] . "'><br><br>";
                echo "<label><strong>Aantal dagen</strong></label><br>";
                echo "<input type='number' name='aantaldagen' value='" . $tocht['aantaldagen'] . "'><br><br>";
                echo "<input type='submit' value='Bewerken'>";
                echo "<button><a href='tochten.php'>Terug</a></button>";
                echo "</form>";

                // Check if the form is submitted
                if (isset($_POST['omschrijving']))
                {
                    // Get the values from the form
                    $omschrijving = $_POST['omschrijving'];
                    $route = $_POST['route'];
                    $aantaldagen = $_POST['aantaldagen'];

                    // Update the herbergen in the database
                    $sql = $conn->prepare("UPDATE tochten SET omschrijving = '$omschrijving', route = '$route', aantaldagen = '$aantaldagen' WHERE id = $id");
                    $sql->execute();

                    // Redirect to the bookings page
                    header("Location: tochten.php");
                }
            ?>
        </div>
    </div>
</body>
</html>