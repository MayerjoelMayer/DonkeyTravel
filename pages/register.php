<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <!--
        Data base layout
        users
    id INT(11)
    name VARCHAR(50)
    email VARCHAR(100)
    phone VARCHAR(20)
    password VARCHAR(100)
    edited TIMESTAMP
    Indexes
    bookings
    id INT(11)
    StartDate DATE
    PINCode INT(11)
    FKusers INT(11)
    Indexes
     -->
    <body>
        <div class="container">
            <div class="header">
                <h1>Registration</h1>
            </div>
            <div class="content">
                <form action="register.php" method="post">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" required>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone" required>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                    <input type="submit" value="Register">
                </form>
            </div>
        </div>
        <a href="login.php">Already have an account?</a>
    </body>


</html>

<?php

    // Make a connection to the database
    require_once "connect.php";

    session_start();

    // Check if user is logged in, and if so, redirect to home page
    if (isset($_SESSION['user_id']))
    {
        // User is logged in
        // Redirect to home page
        header("Location: home.php");
    }

    // Registration backend
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        // hash the password
        $password = hash('sha256', $_POST['password']);

        // Check if the user already exists
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->rowCount() > 0)
        {
            echo "User already exists";
        }
        else
        {
            // Insert the user into the database
            $sql = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
            $result = $conn->query($sql);
            if ($result)
            {
                // redirect to the login page
                header("Location: login.php");
            }
        }
    }
    
?>