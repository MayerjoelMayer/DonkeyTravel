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
    <title>Herbergen | My Donkey Travel</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Herbergen</h1>
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
                $sql = $conn->prepare("SELECT * FROM herbergen WHERE id = $id");
                $sql->execute();

                // Fetch all tochten from database
                $herberg = $sql->fetch();

                // Edit form
                echo "<form action='herberg_edit.php?id=" . $herberg['id'] . "' method='post'>";
                echo "<label><strong>Naam</strong></label><br>";
                echo "<input type='text' name='naam' value='" . $herberg['naam'] . "'><br><br>";
                echo "<label><strong>Adres</strong></label><br>";
                echo "<input type='text' name='adres' value='" . $herberg['adres'] . "'><br><br>";
                echo "<label><strong>E-mail</strong></label><br>";
                echo "<input type='text' name='email' value='" . $herberg['email'] . "'><br><br>";
                echo "<label><strong>Telefoon</strong></label><br>";
                echo "<input type='text' name='telefoon' value='" . $herberg['telefoon'] . "'><br><br>";
                echo "<label><strong>Coordinaten</strong></label><br>";
                echo "<input type='text' name='coordinaten' value='" . $herberg['coordinaten'] . "'><br><br>";
                echo "<input type='submit' value='Bewerken'>";
                echo "</form>";

                // Check if the form is submitted
                if (isset($_POST['naam']))
                {
                    // Get the values from the form
                    $naam = $_POST['naam'];
                    $adres = $_POST['adres'];
                    $email = $_POST['email'];
                    $telefoon = $_POST['telefoon'];
                    $coordinaten = $_POST['coordinaten'];

                    // Update the herbergen in the database
                    $sql = $conn->prepare("UPDATE herbergen SET naam = '$naam', adres = '$adres', email = '$email', telefoon = '$telefoon', coordinaten = '$coordinaten' WHERE id = $id");
                    $sql->execute();

                    // Redirect to the bookings page
                    header("Location: herbergen.php");
                }
            ?>
        </div>
    </div>
</body>
</html>