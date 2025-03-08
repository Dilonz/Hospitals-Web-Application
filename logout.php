<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the home page of the website
header("Location: index.php"); // Replace 'index.php' with the path to your home page
exit();
?>