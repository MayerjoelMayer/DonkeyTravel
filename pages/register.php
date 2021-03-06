<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register | Donkey Travel</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <!-- Register form -->
    <body>
        <div class="container">
            <div class="header">
                <h1>Registration</h1>
            </div>
            <div class="content">
                <form action="register.php" method="post">
                    <label for="name"><strong>Name</strong></label><br>
                    <input type="text" name="name" id="name" required><br><br>
                    <label for="email"><strong>E-mail</strong></label><br>
                    <input type="email" name="email" id="email" required><br><br>
                    <label for="phone"><strong>Phone</strong></label><br>
                    <input type="text" name="phone" id="phone" required><br><br>
                    <label for="password"><strong>Password</strong></label><br>
                    <input type="password" name="password" id="password" required><br><br>
                    <label for="password2"><strong>Confirm password</strong></label>	<br>
                    <input type="password" name="password2" id="password2" required><br><br>
                    <input type="submit" value="Register">
                </form>
            </div>
        </div>
        <br>
        <button onclick="location.href='login.php'">Already have an account?</button>
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
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['password2']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        // hash the passwords
        $password = hash('sha256', $_POST['password']);
        $password2 = hash('sha256', $_POST['password2']);

        // Check if passwords match
        if ($password != $password2)
        {
            // Redirect to register page with the error message displayed to the user with an echo
            echo "Wachtwoorden komen niet overeen";
            
        }
        else
        {
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
                $sql = "INSERT INTO users (name, email, phone, password, rechten_id) VALUES ('$name', '$email', '$phone', '$password', '1')";
                $result = $conn->query($sql);
                if ($result)
                {
                    // redirect to the login page
                    header("Location: login.php");
                }
            }
        }
    }
    
?>