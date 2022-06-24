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
            <form action="herberg_create.php" method="post">
                <label><strong>Naam</strong></label><br>
                <input type="text" name="name" required><br><br>
                <label><strong>Adres</strong></label><br>
                <input type="text" name="adres" required><br><br>
                <label><strong>E-mail</strong></label><br>
                <input type="email" name="email" required><br><br>
                <label><strong>Telefoonnummer</strong></label><br>
                <input type="text" name="phone" required><br><br>
                <label><strong>Coordinaten</strong></label><br>
                <input type="text" name="coordinates" required><br><br>
                <input type="submit" value="Bevestigen">
                <button><a href="herbergen.php">Terug</a></button>
            </form>
        </div>
    </div>
</body>
</html>

<?php

    // Make connection to database
    require_once "../connect.php";

    // Insert form into database
    if (isset($_POST['name']))
    {
        $name = $_POST['name'];
        $adres = $_POST['adres'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $coordinates = $_POST['coordinates'];

        $sql = $conn->prepare("INSERT INTO herbergen (naam, adres, email, telefoon, coordinaten) VALUES ('$name', '$adres', '$email', '$phone', '$coordinates')");
        $sql->execute();

        // Redirect to herbergen page
        header("Location: herbergen.php");
    }
?>