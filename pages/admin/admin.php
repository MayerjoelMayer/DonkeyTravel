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
    else if ($_SESSION['rechten'] == 1)
    {
        // User is logged in, but not as an admin
        // Redirect to admin home page
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
    <title>Admin | Donkey Travel</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Admin</h1>
        </div>
        <div class="content">
            <p>Welcome <?php echo $_SESSION['name']; ?>!</p>
            <p>You are logged in as <?php echo $_SESSION['email']; ?>.</p>

            <button onclick="location.href='bookings.php'">Boekingen</button>
            <button>Beheer</button>
            <br><br>
            <button onclick="location.href='gasten.php'">Gasten</button>
            <button onclick="location.href='herbergen.php'">Herbergen</button>
            <button onclick="location.href='restaurants.php'">Restaurants</button>
            <button onclick="location.href='tochten.php'">Tochten</button>
            <button onclick="location.href='statussen.php'">Statussen</button>
            
            <br><br>
            <button onclick="location.href='../logout.php'">Log uit</button>
        </div>
    </div>
</body>
</html>