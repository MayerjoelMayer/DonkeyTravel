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
    <title>Home | My Donkey Travel</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Account</h1>
        </div>
        <div class="content">
            <p>Welkom, <?php echo $_SESSION['name']; ?>!</p>
            <p>You are logged in as <?php echo $_SESSION['email']; ?>.</p>

            <button onclick="location.href='bookings.php'">Boekingen</button>
            <button onclick="location.href='account.php'">Account</button>
            <form action="account.php" method="post">
                <input type="hidden" name="id" value="<?php echo $_SESSION['user_id']; ?>"><br>
                <label for="name"><strong>Naam</strong></label><br>
                <input type="text" name="name" placeholder="Naam" value="<?php echo $_SESSION['name']; ?>"><br><br>
                <label for="email"><strong>E-mail</strong></label><br>
                <input type="email" name="email" placeholder="E-mail" value="<?php echo $_SESSION['email']; ?>"><br><br>
                <label for="phone"><strong>Telefoonnummer</strong></label><br>
                <input type="text" name="phone" placeholder="Telefoonnummer" value="<?php echo $_SESSION['phone']; ?>"><br><br>
                <label for="password"><strong>Wachtwoord</strong></label><br>
                <input type="password" name="password" placeholder="Wachtwoord"><br><br>
                <label for="current_password"><strong>Huidig wachtwoord</strong></label><br>
                <input type="password" name="current_password" placeholder="Huidig wachtwoord"><br><br>
                <input type="submit" value="Wijzig gegevens">
            </form>
            <!-- Account deletion form, checkbox before button can be pressed -->
            <form action="account_delete.php" method="post">
                <input type="checkbox" name="delete">
                <input type="submit" value="Verwijder account">
            </form>
            <br>
            <button onclick="location.href='logout.php'">Log uit</button>
        </div>
</body>
</html>

<?php

    // Check if everything in the form is filled in
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['current_password']))
    {
        // Get the user's id
        $id = $_SESSION['user_id'];

        // Get the user's current password with the hash
        $current_password = $_POST['current_password'];
        $current_password_hash = hash('sha256', $current_password);

        // Check if the current password is correct using pdo
        $sql = $conn->prepare("SELECT * FROM users WHERE id = $id");
        $sql->execute();
        $result = $sql->fetch();

        // Check if the current password is correct
        if ($result['password'] == $current_password_hash)
        {
            // Get the new properties
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $password_hash = hash('sha256', $password);

            // Update the user's properties, but if the password is empty, don't update it
            if ($password != "")
            {
                $sql = $conn->prepare("UPDATE users SET name = '$name', email = '$email', phone = '$phone', password = '$password_hash' WHERE id = $id");
            }
            else
            {
                $sql = $conn->prepare("UPDATE users SET name = '$name', email = '$email', phone = '$phone' WHERE id = $id");
            }
            $sql->execute();

            // Redirect to the account page
            header("Location: account.php");
        }
        else
        {
            // Current password is incorrect
            echo "<p>Het huidige wachtwoord is niet correct.</p>";
        }
    }
?>