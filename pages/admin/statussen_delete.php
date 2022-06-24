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
            <!-- Delete system for herbergen, using a form showing the information from the database and the id in the url using pdo -->
            <?php
                // connect to the database
                require_once "../connect.php";

                // get the id from the url
                $id = $_GET['id'];

                // get the information from the database
                $sql = $conn->prepare("SELECT * FROM statussen WHERE id = $id");
                $sql->execute();

                // Fetch booking from database
                $status = $sql->fetch();

                echo "<form action='statussen_delete_2.php?id=" . $status['id'] . "' method='post'>";

                // Read the information from the database
                echo "<label><strong>Code</strong></label><br>";
                echo "<input type='text' name='statuscode' value='" . $status['statuscode'] . "' disabled><br><br>";
                echo "<label><strong>Status</strong></label><br>";
                echo "<input type='text' name='status' value='" . $status['status'] . "' disabled><br><br>";
                echo "<label><strong>Verwijderbaar</strong></label><br>";
                echo "<input type='text' name='verwijderbaar' value='" . $status['verwijderbaar'] . "' disabled><br><br>";
                echo "<label><strong>PIN toekennen</strong></label><br>";
                echo "<input type='text' name='pintoekennen' value='" . $status['PINtoekennen'] . "' disabled><br><br>";
            ?>
            <input type="submit" value="Verwijder">
            </form>
            <button onclick="location.href='statussen.php'">Terug</button>
        </div>
    </div>
</body>
</html>