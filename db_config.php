<?php
$servername = "localhost";
$username = "root"; // Change if using a different MySQL user
$password = ""; // Change if using a password
$dbname = "dilanka"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
