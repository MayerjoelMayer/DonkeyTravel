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
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Home</h1>
        </div>
        <div class="content">
            <p>Welcome <?php echo $_SESSION['name']; ?>!</p>
            <p><a href="logout.php">Logout</a></p>
        </div>

</body>
</html>