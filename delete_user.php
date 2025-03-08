<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dilanka";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete user
$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "User deleted successfully";
} else {
    echo "Error deleting user: " . $conn->error;
}

$conn->close();
header("Location: dashboard.php"); // Redirect back to the dashboard
?>