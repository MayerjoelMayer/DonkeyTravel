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
        // Destroy session
        session_destroy();
        // Redirect to login page
        header("Location: login.php");
    }
