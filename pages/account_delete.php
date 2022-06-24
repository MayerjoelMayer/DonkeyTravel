<?php

// Make a connection to the database
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

// Ask user to confirm deletion, otherwise redirect back to account page
if (isset($_POST['delete']))
{
    // User confirmed deletion

    // First delete all bookings related to this user
    $sql = $conn->prepare("DELETE FROM bookings WHERE FKusersID = " . $_SESSION['user_id']);
    $sql->execute();

    // Delete user from database
    $sql = $conn->prepare("DELETE FROM users WHERE id = " . $_SESSION['user_id']);
    $sql->execute();

    // Logout user
    session_destroy();

    // Redirect to login page
    header("Location: login.php");
}
else
{
    // User did not confirm deletion
    // Redirect to account page and telling user to confirm deletion
    header("Location: account.php?delete=false");
}

