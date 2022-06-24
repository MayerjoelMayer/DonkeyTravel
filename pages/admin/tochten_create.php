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
            <form action="tochten_create.php" method="post">
                <label><strong>Omschrijving</strong></label><br>
                <input type="text" name="omschrijving" required><br><br>
                <label><strong>Route</strong></label><br>
                <input type="text" name="route" required><br><br>
                <label><strong>Aantal Dagen</strong></label><br>
                <input type="number" name="aantaldagen" required><br><br>
                <input type="submit" value="Bevestigen">
                <button><a href="tochten.php">Terug</a></button>
            </form>
        </div>
    </div>
</body>
</html>

<?php

    // Make connection to database
    require_once "../connect.php";

    // Insert form into database
    if (isset($_POST['omschrijving']))
    {
        $omschrijving = $_POST['omschrijving'];
        $route = $_POST['route'];
        $aantaldagen = $_POST['aantaldagen'];

        $sql = $conn->prepare("INSERT INTO tochten (omschrijving, route, aantaldagen) VALUES ('$omschrijving', '$route', '$aantaldagen')");
        $sql->execute();

        // Redirect to herbergen page
        header("Location: tochten.php");
    }
?>