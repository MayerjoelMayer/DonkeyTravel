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

    // get the id from the url
    $id = $_GET['id'];

    // Delete the booking from the database
    $sql = $conn->prepare("DELETE FROM bookings WHERE id = $id");
    $sql->execute();

    // Redirect to the bookings page once deleted
    header("Location: bookings.php");

?>