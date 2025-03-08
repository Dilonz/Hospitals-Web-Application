<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dilanka";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Remove doctor from database (soft delete or other logic)
$sql = "UPDATE doctors SET status='removed' WHERE id = $id";
if ($conn->query($sql)) {
    echo "Doctor removed successfully.";
} else {
    echo "Error removing doctor: " . $conn->error;
}

$conn->close();
header("Location: index.php");
?>