<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Donkey Travel</title>
</head>
<body>
    <!-- Login form -->
    <div class="container">
        <div class="header">
            <h1>Login</h1>
        </div>
        <div class="content">
            <form action="login.php" method="post">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
    <a href="register.php">Don't have an account?</a>
</body>
</html>

<?php

    // Make a connection to the database
    require_once "connect.php";

    // Start session
    session_start();

    // Check if user is logged in, and if so, redirect to home page
    if (isset($_SESSION['user_id']))
    {
        // User is logged in
        // Redirect to home page
        header("Location: home.php");
    }

    // Login backend
    if (isset($_POST['email']) && isset($_POST['password']))
    {
        $email = $_POST['email'];
        // hash the password
        $password = hash('sha256', $_POST['password']);

        // Check if the user is in the database
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        //echo $sql;	// for debugging purposes
        $result = $conn->query($sql);

        if ($result->rowCount() > 0)
        {
            // User is in the database
            // Get the user id
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $user_id = $row['id'];

            // Set the session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];

            // Redirect to the dashboard
            header("Location: home.php");
        }
        else
        {
            // User is not in the database
            echo "User does not exist";
        }
    }
