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
    <title>Statussen | My Donkey Travel</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Statussen</h1>
        </div>
        <div class="content">
            <p>Welkom, <?php echo $_SESSION['name']; ?>!</p>
            <p>You are logged in as <?php echo $_SESSION['email']; ?>.</p>
        </div>
        <div>
            <form action="statussen_create.php" method="post">
                <label><strong>Code</strong></label><br>
                <input type="text" name="code" required><br><br>
                <label><strong>Status</strong></label><br>
                <input type="text" name="status" required><br><br>
                <label><strong>Verwijderbaar</strong></label><br>
                <input type="checkbox" name="verwijderbaar" ><br><br>
                <label><strong>PIN toekennen</strong></label><br>
                <input type="checkbox" name="pintoekennen" ><br><br>
                <input type="submit" value="Bevestigen">
                <button><a href="statussen.php">Terug</a></button>
            </form>
        </div>
    </div>
</body>
</html>

<?php

    // Make connection to database
    require_once "../connect.php";

    // Insert form into database
    if (isset($_POST['code']))
    {
        // Get form data
        $code = $_POST['code'];
        $status = $_POST['status'];
        // Check if checkbox is checked
        if (isset($_POST['verwijderbaar']))
        { $verwijderbaar = 1; } else { $verwijderbaar = 0; }
        if (isset($_POST['pintoekennen']))
        { $pintoekennen = 1; } else { $pintoekennen = 0; }

        $sql = $conn->prepare("INSERT INTO statussen (statuscode, status, verwijderbaar, PINtoekennen) VALUES ('$code', '$status', '$verwijderbaar', '$pintoekennen')");
        $sql->execute();

        // Redirect to herbergen page
        header("Location: statussen.php");
    }
?>