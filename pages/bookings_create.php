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
            <form action="bookings_create.php" method="post">
                <label><strong>Startdatum</strong></label><br>
                <input type="date" name="startdate" required><br>
                <label><strong>Tocht</strong></label><br>
                <select id="tochten" name="tochten">
                    <?php
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
                    ?>
                </select><br><br>
                <input type="submit" value="Bevestigen">
                <button><a href="bookings.php">Terug</a></button>
            </form>
        </div>
    </div>
</body>
</html>

<?php

    // Make connection to database
    require_once "connect.php";

    // Insert new booking into database
    if (isset($_POST['startdate']))
    {
        // Check if date is valid
        if (strtotime($_POST['startdate']) > strtotime(date('Y-m-d')))
        {
            // Date is valid
            // Get form data
            $startdate = $_POST['startdate'];
            $tocht = $_POST['tochten'];
            
            // Instert new booking into database
            $sql = $conn->prepare("INSERT INTO bookings (StartDate, FKusersID, FKtochtenID, FKstatussenID)
                VALUES ('" . $startdate . "', " . $_SESSION['user_id'] . ", $tocht, 1)");

            // Execute query
            $sql->execute();
            // Check if query was successful, then redirect to bookings page
            if ($sql->rowCount() > 0)
            {
                // Query was successful
                // Redirect to bookings page
                header("Location: bookings.php");
            }
            else
            {
                // Query was not successful
                // Show error message
                echo "Error: " . $sql->errorInfo()[2];
            }
        }
        else
        {
            // Date is not valid
            // Show error message
            echo "Error: Datum is niet geldig.";
        }
    }
?>