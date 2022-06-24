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
            <!-- Delete system for tochten, using a form showing the information from the database and the id in the url using pdo -->
            <?php
                // connect to the database
                require_once "../connect.php";

                // get the id from the url
                $id = $_GET['id'];

                // get the information from the database
                $sql = $conn->prepare("SELECT * FROM tochten WHERE id = $id");
                $sql->execute();

                // Fetch booking from database
                $tocht = $sql->fetch();

                echo "<form action='tochten_delete_2.php?id=" . $tocht['id'] . "' method='post'>";

                // Read the information from the database
                echo "<label><strong>Naam</strong></label><br>";
                echo "<input type='text' name='naam' value='" . $tocht['omschrijving'] . "' disabled><br><br>";
                echo "<label><strong>Adres</strong></label><br>";
                echo "<input type='text' name='adres' value='" . $tocht['route'] . "' disabled><br><br>";
                echo "<label><strong>E-mail</strong></label><br>";
                echo "<input type='text' name='email' value='" . $tocht['aantaldagen'] . "' disabled><br><br>";
            ?>
            <input type="submit" value="Verwijder">
            </form>
            <br>
            <button onclick="location.href='tochten.php'">Terug</button>
        </div>
    </div>
</body>
</html>