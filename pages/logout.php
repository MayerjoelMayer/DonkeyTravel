<?php

// connect to the database
require_once "connect.php";

// Log out the user
session_start();

    // Check if user is logged in
    if (isset($_SESSION['user_id']))
    {
        // User is logged in
        // Log out the user
        // Unset the user_id session variable
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        // Redirect to login page
        header("Location: login.php");
    }
